<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fan;
use Validator;
use Illuminate\Http\Request;

class FanController extends Controller
{
    public function index()
    {
        $fan = Fan::with('klub')->latest()->get();
        return response()->json([
      
            'success'=> true,
            'message'=> 'Daftar Fan',
            'data'=> $fan,
        ],200);
   
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_fan' =>'required',
            'klub' =>'required|array',
        ]);
        if($validate->fails()){
            return response()->json([
                'success' =>false,
                'message' =>'validasi gagal',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $fan = New Fan;
            $fan->nama_fan = $request->nama_fan;
            $fan->save();
            // lampirkan banyak klub
            $fan->klub()->attach($request->klub);
            return response()->json([
                'success' =>true,
                'message' =>'data fan berhasil dibuat',
                'data' => $fan,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' =>false,
                'message' =>'terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try{
            $fan = fan::findOrFail($id);
            return response()->json([
                'success' =>true,
                'message' =>'Detail fan',
                'data' => $fan,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' =>false,
                'message' =>'data tidak ditemukan!',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama_fan' =>'required',
        ]);
        if($validate->fails()){
            return response()->json([
                'success' =>false,
                'message' =>'validasi gagal',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $fan = Fan::findOrFail($id);
            $fan->nama_fan = $request->nama_fan;
            $fan->save();
            return response()->json([
                'success' =>true,
                'message' =>'data fan berhasil dirubah',
                'data' => $fan,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' =>false,
                'message' =>'terjadi kesalahan',
                'errors' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try{
            $fan = Fan::findOrFail($id);
            $fan->delete();
            $fan->klub()->detach();
            return response()->json([
                'success' =>true,
                'message' =>'berhasil dihapus',
                'Data '=> $fan,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' =>false,
                'message' =>'Terjadi kesalahan!',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }


}
  
 