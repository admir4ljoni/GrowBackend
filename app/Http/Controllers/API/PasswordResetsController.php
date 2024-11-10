<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\OTPMail;

class PasswordResetsController extends Controller
{
    public function submitEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ],[
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get user first
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        session(['otp_email' => $user->email]);

        $otp = rand(1000, 9999);

        User::where('email', $request->email)->update([
            'otp' => $otp,
            'is_verified' => false,
        ]);

        Mail::to($request->email)->send(new OTPMail($otp));

        return response()->json(['message' => 'We have sent an OTP to your email.']);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ],[
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password_confirmation.required' => 'Konfirmasi password harus diisi',
            'password.confirmed' => 'Konfirmasi password tidak sama',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        return response()->json(['message' => 'Your password has been changed!']);
    }

    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'otp' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)
                    ->where('otp', $request->otp)
                    ->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid OTP or email.'], 400);
        }

        $user->is_verified = true;
        $user->otp = null;
        $user->save();

        return response()->json(['message' => 'OTP verified successfully. You can now reset your password.']);
    }

    public function resendOTP(Request $request)
    {
        $email = $request->email ?? session('otp_email');

        // Periksa apakah email disediakan dari request atau session
        if (!$email) {
            return response()->json(['error' => 'No email found for OTP resend. Please provide an email or request OTP again.'], 400);
        }

        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Jika user sudah terverifikasi, tetapi sedang dalam proses reset password, kirim OTP untuk reset password
        if ($user->is_verified && $request->type === 'reset-password') {
            $otp = rand(1000, 9999);
            $user->otp = $otp;
            $user->save();

            Mail::to($user->email)->send(new OTPMail($otp, $user->name));

            return response()->json(['message' => 'OTP for password reset has been sent to your email.'], 200);
        }

        // Jika user belum terverifikasi, kirim OTP untuk verifikasi akun
        if (!$user->is_verified) {
            $otp = rand(1000, 9999);
            $user->otp = $otp;
            $user->save();

            Mail::to($user->email)->send(new OTPMail($otp, $user->name));

            return response()->json(['message' => 'OTP for account verification has been sent to your email.'], 200);
        }

        return response()->json(['message' => 'No action needed. User is already verified and not in reset password process.'], 400);
    }
}
