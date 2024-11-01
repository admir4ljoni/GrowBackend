<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller 
{
    public function getUserData(Request $request)
    {
        // get data tiap user nntinya untuk nntinya diupdate
        $user = auth()->user();
        
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }
        return response()->json([
            'status' => true,
            'data' => $user
        ]);

        
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:255',
            'phone'=>'required|string|max:255',
            'img_profile'=>'required|string|max:255',
            'alamat'=>'required|string',
        ],[
            'name.required' => 'Name harus diisi',
            'phone.required' => 'Phone harus diisi', 
            'img_profile.required' => 'Img_profile harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'name.max' => 'Name maksimal 255 karakter',
            'phone.max' => 'Phone maximal 255 karakter',
            'phone.unique' => 'Phone sudah terdaftar'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 400);
        }
        
        $user = auth()->user();
        if ($user) {
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->img_profile = $request->img_profile;
            $user->alamat = $request->alamat;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User updated successfully.',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }
    }

    public function getAllUser(){   //get semua user
        $user = User::all();
        return response()->json($user);
    }
}