<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'name'=>'required|string|max:255',
            'alamat'=>'required',
            'entity'=>'required',
             'images.*' => 'required|file|image|max:2048',
            'deskripsi'=>'required',
        ]);

        $umkm = Umkm::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'entity' => $request->entity,
            'user_id' => $user->id,
        ]);
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('umkm_images', 'public');
                UmkmImage::create([
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

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required',
            'alamat' => 'sometimes|required',
            'entity' => 'sometimes|required',
            'images' => 'sometimes|array',
            'images.*' => 'required|file|image|max:2048',
            'deskripsi' => 'sometimes|required',
            'delete_image_id' => 'sometimes|array', 
            'delete_image_id.*' => 'exists:umkm_images,id'
        ]);
        

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = auth()->user();
        $umkm = Umkm::where('user_id', $user->id)->first();
        if (!$umkm) {
            return response()->json([
                'status' => false,
                'message' => 'UMKM tidak ditemukan atau Anda tidak memiliki akses.'
            ], 404);
        }

        $umkm->update($request->only(['name', 'alamat', 'entity', 'deskripsi']));

        if ($request->has('delete_image_id')) {
            foreach ($request->delete_image_id as $imageId) {
                $image=UmkmImage::where('id', $request->delete_image_id)
                ->where('umkm_id', $umkm->id)->first();

                if ($image) {
                    Storage::disk('public')->delete($image->image); 
                    $image->delete();
                }
                $image->delete();
            }
        }

        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('umkm_images', 'public');
                UmkmImage::create([
                    'umkm_id' => $umkm->id,
                    'image' => $imagePath,
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'UMKM berhasil diperbarui.',
            'data' => $umkm->load('images')
        ], 200);
    }

    public function getUmkm(){
        $umkm = Umkm::all();
        return response()->json([
            'status' => true,
            'data' => $umkm
        ]);
    }

    public function delete(){
        $user = auth()->user();
        $umkm = Umkm::where('user_id', $user->id)->first();
        if (!$umkm) {
            return response()->json([
                'status' => false,
                'message' => 'UMKM tidak ditemukan atau Anda tidak memiliki akses.'
            ], 404);
        }

        $image=UmkmImage::where('umkm_id', $umkm->id)->get();
        foreach ($image as $img) {
            Storage::disk('public')->delete($img->image); 
            $img->delete();
        }
        $umkm->delete();
        return response()->json([
            'status' => true,
            'message' => 'UMKM berhasil dihapus.'
        ], 200);

        
    }
}
