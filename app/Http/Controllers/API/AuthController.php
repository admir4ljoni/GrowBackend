<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:255|unique:users',
            'phone'=>'required|string|max:255|unique:users',
            'img_profile' => 'required|string|max:255',
            'img_ktp' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'alamat' => 'required|string',

        ]);
        $otp = rand(100000, 999999);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'img_profile' => $request->img_profile,
            'img_ktp' => $request->img_ktp,
            'role' => $request->role,
            'alamat' => $request->alamat,
            'is_verified' => false,
            'otp' => $otp,
        ]);
        if($user->save()){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;
            Mail::to($user->email)->send(new OTPMail($otp));
            return response()->json([
                'message' => 'User registered successfully. Please verify OTP sent to your email.',
                'accessToken'=> $token,
            ],201);
        }
        else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
        {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        $user = User::where('email', $request->email)->first();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'accessToken' =>$token,
            'token_type' => 'Bearer',
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout Success'
        ],200);
    }

    public function verifyOTP(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'otp' => 'required|integer',
        ]);
    
        $user = User::where('email', $request->email)->where('otp', $request->otp)->first();
    
        if($user){
            $user->is_verified = true;
            $user->otp = null;  // Hapus OTP setelah verifikasi
            $user->save();
    
            return response()->json(['message' => 'User verified successfully.']);
        } else {
            return response()->json(['error' => 'Invalid OTP or email.'], 400);
        }
    }
    
}
