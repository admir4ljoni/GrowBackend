<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\UmkmImage;
use App\Models\ProductImage;
use App\Models\LocationImage;
use App\Models\NIBImage;
use App\Models\CertificationImage;
use App\Models\LogoImage;
use App\Models\NPWPImage;
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
            'assets'=>'required|integer',
            'market_share'=>'required|integer',
            'sertifikasi'=>'required',
            'Pendanaan'=>'required|integer',
            'peruntukan'=>'required',
            'Rencana'=>'required',
            'images.*' => 'required|file|image|max:2048',
            'product_images.*' => 'required|file|image|max:2048',
            'location_images.*' => 'required|file|image|max:2048',
            'nib_images.*' => 'required|file|image|max:2048',
            'certification_images.*' => 'required|file|image|max:2048',
            'npwp_images.*' => 'required|file|image|max:2048',
            'logo_images.*' => 'required|file|image|max:2048',
            'deskripsi'=>'required',
        ]);

        $umkm = Umkm::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'entity' => $request->entity,
            'user_id' => $user->id,
            'assets' => $request->assets,
            'market_share' => $request->market_share,
            'sertifikasi' => $request->sertifikasi,
            'Pendanaan' => $request->Pendanaan,
            'peruntukan' => $request->peruntukan,
            'Rencana' => $request->Rencana
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
        if ($request->has('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $imagePath = $image->store('product_images', 'public');
                ProductImage::create([
                    'umkm_id' => $umkm->id,
                    'image' => $imagePath,
                ]);
            }  
        }
        if ($request->has('location_images')) {
            foreach ($request->file('location_images') as $image) {
                $imagePath = $image->store('location_images', 'public');
                LocationImage::create([
                    'umkm_id' => $umkm->id,
                    'image' => $imagePath,
                ]);
            }  
        }
        if ($request->has('nib_images')) {
            foreach ($request->file('nib_images') as $image) {
                $imagePath = $image->store('nib_images', 'public');
                NIBImage::create([
                    'umkm_id' => $umkm->id,
                    'image' => $imagePath,
                ]);
            }  
        }
        if ($request->has('npwp_images')) {
            foreach ($request->file('npwp_images') as $image) {
                $imagePath = $image->store('npwp_images', 'public');
                NPWPImage::create([
                    'umkm_id' => $umkm->id,
                    'image' => $imagePath,
                ]);
            }  
        }
        if ($request->has('logo_images')) {
            foreach ($request->file('logo_images') as $image) {
                $imagePath = $image->store('logo_images', 'public');
                LogoImage::create([
                    'umkm_id' => $umkm->id,
                    'image' => $imagePath,
                ]);
            }  
        }
        if ($request->has('certification_images')) {
            foreach ($request->file('certification_images') as $image) {
                $imagePath = $image->store('certification_images', 'public');
                CertificationImage::create([
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
            'alamat' => 'sometimes|required',
            'assets'=>'required|integer',
            'market_share'=>'required|integer',
            'sertifikasi'=>'required',
            'Pendanaan'=>'required|integer',
            'peruntukan'=>'required',
            'Rencana'=>'required',
            'images' => 'sometimes|array',
            'images.*' => 'required|file|image|max:2048',
            'product_images.*' => 'required|file|image|max:2048',
            'location_images.*' => 'required|file|image|max:2048',
            'logo_images.*' => 'required|file|image|max:2048',
            'deskripsi' => 'sometimes|required',
            'delete_image_id' => 'sometimes|array', 
            'delete_image_id.*' => 'exists:umkm_images,id',
            'delete_product_image_id' => 'sometimes|array', 
            'delete_product_image_id.*' => 'exists:umkm_images,id',
            'delete_logo_image_id' => 'sometimes|array', 
            'delete_logo_image_id.*' => 'exists:umkm_images,id',
            'delete_location_image_id' => 'sometimes|array', 
            'delete_location_image_id.*' => 'exists:umkm_images,id',
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

        $umkm->update($request->only([ 'alamat', 'deskripsi', 'assets', 'market_share', 'sertifikasi', 'Pendanaan', 'peruntukan', 'Rencana' ]));

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
        if ($request->has('delete_product_image_id')) {
            foreach ($request->delete_product_image_id as $imageId) {
                $image=ProductImage::where('id', $request->delete_product_image_id)
                ->where('umkm_id', $umkm->id)->first();

                if ($image) {
                    Storage::disk('public')->delete($image->image); 
                    $image->delete();
                }
                $image->delete();
            }
        }
        if ($request->has('delete_logo_image_id')) {
            foreach ($request->delete_logo_image_id as $imageId) {
                $image=LogoImage::where('id', $request->delete_logo_image_id)
                ->where('umkm_id', $umkm->id)->first();

                if ($image) {
                    Storage::disk('public')->delete($image->image); 
                    $image->delete();
                }
                $image->delete();
            }
        }
        if ($request->has('delete_location_image_id')) {
            foreach ($request->delete_location_image_id as $imageId) {
                $image=LocationImage::where('id', $request->delete_location_image_id)
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
        if ($request->has('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $imagePath = $image->store('product_images', 'public');
                ProductImage::create([
                    'umkm_id' => $umkm->id,
                    'image' => $imagePath,
                ]);
            }  
        }
        if ($request->has('location_images')) {
            foreach ($request->file('location_images') as $image) {
                $imagePath = $image->store('location_images', 'public');
                LocationImage::create([
                    'umkm_id' => $umkm->id,
                    'image' => $imagePath,
                ]);
            }  
        }
        if ($request->has('logo_images')) {
            foreach ($request->file('logo_images') as $image) {
                $imagePath = $image->store('logo_images', 'public');
                LogoImage::create([
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
