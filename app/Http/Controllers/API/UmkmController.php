<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\User;
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
    public function create(Request $request)
    {
        $user = auth()->user();
        if ($user->umkm) {
            return response()->json([
                'status' => false,
                'message' => 'Anda sudah memiliki UMKM. Hanya bisa memiliki satu UMKM.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'alamat' => 'string',
            'entity' => 'string',
            'assets' => 'numeric',
            'q1' => 'string',
            'q2' => 'string',
            'q3' => 'string',
            'q4' => 'string',
            'omzet1' => 'numeric',
            'omzet2' => 'numeric',
            'omzet3' => 'numeric',
            'omzet4' => 'numeric',
            'net_profit1' => 'numeric',
            'net_profit2' => 'numeric',
            'net_profit3' => 'numeric',
            'net_profit4' => 'numeric',
            'market_share' => 'numeric',
            'area' => 'string',
            'sertifikasi' => 'string',
            'pendanaan' => 'numeric',
            'peruntukan' => 'string',
            'rencana' => 'string',
            'deskripsi' => 'string',
            'product_images.*' => 'file|image|max:2048',
            'location_images.*' => 'file|image|max:2048',
            'nib_images.*' => 'file|image|max:2048',
            'certification_images.*' => 'file|image|max:2048',
            'npwp_images.*' => 'file|image|max:2048',
            'logo_images.*' => 'file|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
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

            // Create Laporan Keuangan
            if ($request->has('q1')) {
                LaporanKeuangan::create([
                    'umkm_id' => $umkm->id,
                    'quarter' => $request->q1,
                    'omzet' => $request->omzet1,
                    'net_profit' => $request->net_profit1,
                    'periode' => 'Periode 1'
                ]);    
            }
            if ($request->has('q2')) {
                LaporanKeuangan::create([
                    'umkm_id' => $umkm->id,
                    'quarter' => $request->q2,
                    'omzet' => $request->omzet2,
                    'net_profit' => $request->net_profit2,
                    'periode' => 'Periode 2'
                ]);    
            }
            if ($request->has('q3')) {
                LaporanKeuangan::create([
                    'umkm_id' => $umkm->id,
                    'quarter' => $request->q3,
                    'omzet' => $request->omzet3,
                    'net_profit' => $request->net_profit3,
                    'periode' => 'Periode 3'
                ]);    
            }
            if ($request->has('q4')) {
                LaporanKeuangan::create([
                    'umkm_id' => $umkm->id,
                    'quarter' => $request->q4,
                    'omzet' => $request->omzet4,
                    'net_profit' => $request->net_profit4,
                    'periode' => 'Periode 4'
                ]);    
            }

            // Handle Images
            if ($request->hasFile('product_images')) {
                foreach ($request->file('product_images') as $image) {
                    $imagePath = $image->store('product_images', 'public');
                    ProductImage::create([
                        'umkm_id' => $umkm->id,
                        'image' => $imagePath,
                    ]);
                }  
            }
            
            if ($request->hasFile('location_images')) {
                foreach ($request->file('location_images') as $image) {
                    $imagePath = $image->store('location_images', 'public');
                    LocationImage::create([
                        'umkm_id' => $umkm->id,
                        'image' => $imagePath,
                    ]);
                }  
            }
            
            if ($request->hasFile('nib_images')) {
                foreach ($request->file('nib_images') as $image) {
                    $imagePath = $image->store('nib_images', 'public');
                    NIBImage::create([
                        'umkm_id' => $umkm->id,
                        'image' => $imagePath,
                    ]);
                }  
            }
            
            if ($request->hasFile('certification_images')) {
                foreach ($request->file('certification_images') as $image) {
                    $imagePath = $image->store('certification_images', 'public');
                    CertificationImage::create([
                        'umkm_id' => $umkm->id,
                        'image' => $imagePath,
                    ]);
                }  
            }
            
            if ($request->hasFile('npwp_images')) {
                foreach ($request->file('npwp_images') as $image) {
                    $imagePath = $image->store('npwp_images', 'public');
                    NPWPImage::create([
                        'umkm_id' => $umkm->id,
                        'image' => $imagePath,
                    ]);
                }  
            }
            
            if ($request->hasFile('logo_images')) {
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
                'message' => 'UMKM berhasil dibuat beserta gambar.',
                'data' => $umkm->load(['images', 'locationImages', 'nibImages', 
                    'certificationImages', 'npwpImages', 'logoImages', 'ProductImages'])
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating UMKM: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'q1'=>'',
            'q2'=>'',
            'q3'=>'',
            'q4'=>'',
            'omzet1'=>'|integer',
            'omzet2'=>'|integer',
            'omzet3'=>'|integer',
            'omzet4'=>'|integer',
            'net_profit1'=>'|integer',
            'net_profit2'=>'|integer',
            'net_profit3'=>'|integer',
            'net_profit4'=>'|integer',    
            'alamat' => 'sometimes|',
            'assets'=>'|integer',
            'market_share'=>'|integer',
            'area'=>'',
            'sertifikasi'=>'',
            'pendanaan'=>'|integer',
            'peruntukan'=>'',
            'rencana'=>'',
            'product_images.*' => '|file|image|max:2048',
            'location_images.*' => '|file|image|max:2048',
            'logo_images.*' => '|file|image|max:2048',
            'deskripsi' => 'sometimes|',
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
            $keuangan= LaporanKeuangan::where('umkm_id', $umkm->id)->where('periode', 'Periode 1')->first();
            $keuangan->update([
                'quarter' => $request->q1,
                'omzet' => $request->omzet1,
                'net_profit' => $request->net_profit1,
            ]);
        }else if ($request->has('q2')) {
            $keuangan= LaporanKeuangan::where('umkm_id', $umkm->id)->where('periode', 'Periode 2')->first();
            $keuangan->update([
                'quarter' => $request->q2,
                'omzet' => $request->omzet2,
                'net_profit' => $request->net_profit2,
            ]);
        }else if ($request->has('q3')) {
            $keuangan= LaporanKeuangan::where('umkm_id', $umkm->id)->where('periode', 'Periode 3')->first();
            $keuangan->update([
                'quarter' => $request->q3,
                'omzet' => $request->omzet3,
                'net_profit' => $request->net_profit3,
            ]);
        }else if ($request->has('q4')) {
            $keuangan= LaporanKeuangan::where('umkm_id', $umkm->id)->where('periode', 'Periode 4')->first();
            $keuangan->update([
                'quarter' => $request->q4,
                'omzet' => $request->omzet4,
                'net_profit' => $request->net_profit4,
            ]);
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

    public function find($id){
        $umkm = Umkm::with('user:id,category')->findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $umkm
        ]);
    }

    public function getAllUmkm(){
        
        $umkm = Umkm::with('user:id,category')->has('user')->get();
        return response()->json([
            'status' => true,
            'data' => $umkm
            
        ]);
    }
    
    public function getUmkmData(Request $request)
    {
        $user = auth()->user();
        $umkm = $user->umkm;
        
        $umkm = Umkm::where('user_id', auth()->id())->first();
        
        if (!$umkm) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access'
            ], 401);
        }
    
        return response()->json([
            'status' => true,
            'data' => $umkm
        ]);
    }
}
