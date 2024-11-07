<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'img_profile' => 'file|image|max:2048',
            'img_ktp' => 'file|image|max:2048',
            'role' => 'required|string',
            'alamat' => 'required|string',
            'category' => 'required|string',
        ],[
            'name.required' => 'Name harus diisi',
            'password.required' => 'Password harus diisi',
            'email.required' => 'Email harus diisi',
            'phone.required' => 'Phone harus diisi',
            'img_profile.required' => 'Img_profile harus diisi',
            'img_ktp.required' => 'Img_ktp harus diisi',
            'role.required' => 'Role harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'category.required' => 'Category harus diisi',
            'name.max' => 'Name maksimal 255 karakter',
            'password.min' => 'Password minimal 8 karakter',
            'email.email' => 'Format email tidak valid',
            'phone.max' => 'Phone maximal 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'phone.unique' => 'Phone sudah terdaftar',
             
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422); 
        }
        $otp = rand(1000, 9999);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'img_profile' => $request->hasFile('img_profile') ? $request->file('img_profile')->store('img_profile', 'public') : null,
            'img_ktp' => $request->hasFile('img_ktp') ? $request->file('img_ktp')->store('img_ktp', 'public') : null,
            'role' => $request->role,
            'alamat' => $request->alamat,
            'is_verified' => false,
            'otp' => $otp,
            'category' => $request->category
        ]);
        if($user->save()){
            
            Mail::to($user->email)->send(new OTPMail($otp,));
            return response()->json([
                'message' => 'User registered successfully. Please verify OTP sent to your email.',
                
            ],201);
        }
        else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ], [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'password.required' => 'Password harus diisi',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                ], 400);
            }
    
            // Check if email exists
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email tidak terdaftar',
                ], 404);
            }
    
            // Attempt authentication
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password yang Anda masukkan salah',
                ], 401);
            }
    
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;
    
            return response()->json([
                'status' => true,
                'message' => 'Login berhasil',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
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
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;
            $user->is_verified = true;
            $user->otp = null;  // Hapus OTP setelah verifikasi
            $user->save();
    
            return response()->json(['message' => 'User verified successfully.', 'accessToken' => $token, 'token_type' => 'Bearer',]);
        } else {
            return response()->json(['error' => 'Invalid OTP or email.'], 400);
        }
    }
    
    public function checkEmail(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ], [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }
    
            $exists = User::where('email', $request->email)->exists();
    
            return response()->json([
                'status' => true,
                'exists' => $exists,
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
