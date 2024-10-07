<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
use App\Mail\OTPMail;


class PasswordResetsController extends Controller
{
    

    public function submitEmail(Request $request){

        $request->validate([
            'email' => 'required|string|email|exists:users',
        ]);
        session(['otp_email' => $user->email]);

        $token=Str::random(64);
        $otp = rand(1000, 9999);

        User::where('email', $request->email)->update(['otp' => $otp, 'is_verified' => false, ]);
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token,
            'created_at' => Carbon::now()
          ]);
        Mail::to($request->email)->send(new OTPMail($otp,));

        return response()->json(['message' => 'We have e-mailed your password reset link!']);

    }

    public function resetPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        
        $updatePassword=DB::table('password_resets')
            ->where([
                'email' => $request->email, 
            ])
            ->first();

        if(!$updatePassword){
            return response()->json(['error' => 'Invalid token!']);
        }

        $user=User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return response()->json(['message' => 'Your password has been changed!']);
    }   
    
    public function verifyOTP(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'otp' => 'required|integer',
        ]);
        $user = User::where('email', $request->email)->where('otp', $request->otp)->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid OTP or email.'], 400);
        }

        $user->is_verified = true; 
        $user->otp = null;
        $user->save();


        // ubah return menuju form reset password
        return response()->json(['message' => 'OTP verified successfully. You can now reset your password.']);
    
    }
    
    public function resendOTP(Request $request)
    {
    
        $email = session('otp_email');

    
        if (!$email) {
            return response()->json(['error' => 'No email found for OTP resend. Please register or request OTP again.'], 400);
        }

    
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

    
        if ($user->is_verified) {
            return response()->json(['message' => 'User is already verified.'], 400);
        }

   
        $otp = rand(1000, 9999);
        $user->otp = $otp;
        $user->save();
        session(['otp_email'])->delete();

        
        Mail::to($user->email)->send(new OTPMail($otp));

        return response()->json([
            'message' => 'OTP has been resent to your email.',
        ], 200);
    }

    
}
