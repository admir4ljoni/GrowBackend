<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UmkmController extends Controller
{
    public function create(Request $request){
        $user=Auth::user();

        if ($user->umkm) {
            return response()->json([
                'status' => false,
                'message' => 'Anda sudah memiliki UMKM. Hanya bisa memiliki satu UMKM.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'alamat'=>'required',
            'entity'=>'required',
            'images.*'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi'=>'required',
        ]);

        $umkm = UMKM::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'entity' => $request->entity,
            'user_id' => $user->id,
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('umkm_images', 'public');
                Image::create([
                    'umkm_id' => $umkm->id,
                    'image' => $imagePath,
                ]);
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'UMKM berhasil dibuat beserta gambar.',
            'data' => $umkm->load('images') 
        ], 201);
    }    
}
