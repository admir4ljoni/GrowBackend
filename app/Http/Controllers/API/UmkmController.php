<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\ProductImage;
use App\Models\LocationImage;
use App\Models\NIBImage;
use App\Models\CertificationImage;
use App\Models\LogoImage;
use App\Models\NPWPImage;
use App\Models\LaporanKeuangan;
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
            'q1'=>'required',
            'q2'=>'required',
            'q3'=>'required',
            'q4'=>'required',
            'omzet1'=>'required|integer',
            'omzet2'=>'required|integer',
            'omzet3'=>'required|integer',
            'omzet4'=>'required|integer',
            'net_profit1'=>'required|integer',
            'net_profit2'=>'required|integer',
            'net_profit3'=>'required|integer',
            'net_profit4'=>'required|integer',
            'market_share'=>'required|integer',
            'area'=>'required',
            'sertifikasi'=>'required',
            'pendanaan'=>'required|integer',
            'peruntukan'=>'required',
            'rencana'=>'required',
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
            'area' => $request->area,
            'sertifikasi' => $request->sertifikasi,
            'pendanaan' => $request->pendanaan,
            'peruntukan' => $request->peruntukan,
            'rencana' => $request->rencana
        ]);

        if ($request->has('q1')) {
            LaporanKeuangan::create([
                'umkm_id' => $umkm->id,
                'q1' => $request->q1,
                'omzet1' => $request->omzet1,
                'net_profit1' => $request->net_profit1,
                'periode' => 'Periode 1'
            ]);    
        }
        if ($request->has('q2')) {
            LaporanKeuangan::create([
                'umkm_id' => $umkm->id,
                'q2' => $request->q2,
                'omzet2' => $request->omzet2,
                'net_profit2' => $request->net_profit2,
                'periode' => 'Periode 2'
            ]);    
        }
        if ($request->has('q3')) {
            LaporanKeuangan::create([
                'umkm_id' => $umkm->id,
                'q3' => $request->q1,
                'omzet1' => $request->omzet3,
                'net_profit3' => $request->net_profit1,
                'periode' => 'Periode 3'
            ]);    
        }
        if ($request->has('q4')) {
            LaporanKeuangan::create([
                'umkm_id' => $umkm->id,
                'q4' => $request->q1,
                'omzet1' => $request->omzet4,
                'net_profit4' => $request->net_profit1,
                'periode' => 'Periode 4'
            ]);    
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
            'q1'=>'required',
            'q2'=>'required',
            'q3'=>'required',
            'q4'=>'required',
            'omzet1'=>'required|integer',
            'omzet2'=>'required|integer',
            'omzet3'=>'required|integer',
            'omzet4'=>'required|integer',
            'net_profit1'=>'required|integer',
            'net_profit2'=>'required|integer',
            'net_profit3'=>'required|integer',
            'net_profit4'=>'required|integer',    
            'alamat' => 'sometimes|required',
            'assets'=>'required|integer',
            'market_share'=>'required|integer',
            'area'=>'required',
            'sertifikasi'=>'required',
            'pendanaan'=>'required|integer',
            'peruntukan'=>'required',
            'rencana'=>'required',
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

        $umkm->update($request->only([ 'alamat', 'deskripsi', 'assets', 'market_share', 'sertifikasi', 'pendanaan', 'peruntukan', 'rencana' ]));


        if ($request->has('q1')) {
            $kuangan= LaporanKeuangan::where('umkm_id', $umkm->id)->first();
            $kuangan->update($request->only([ 'q1','omzet1','net_profit1']));
        }else if ($request->has('q2')) {
            $kuangan= LaporanKeuangan::where('umkm_id', $umkm->id)->first();
            $kuangan->update($request->only([ 'q2','omzet2','net_profit2']));
        }else if ($request->has('q3')) {
            $kuangan= LaporanKeuangan::where('umkm_id', $umkm->id)->first();
            $kuangan->update($request->only([ 'q3','omzet3','net_profit3']));
        }else if ($request->has('q4')) {
            $kuangan= LaporanKeuangan::where('umkm_id', $umkm->id)->first();
            $kuangan->update($request->only([ 'q4','omzet4','net_profit4']));
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

    public function getAllUmkm(){
        $umkm = Umkm::all();
        return response()->json([
            'status' => true,
            'data' => $umkm
        ]);
    }
}
