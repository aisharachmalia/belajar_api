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
        $fan = Fan::latest()->get();
        $res = [
            'success'=> true,
            'message'=> 'Daftar Fan',
            'data'=> $fan,
        ];
        return response()->json($res, 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_liga' =>'required|unique:ligas',
            'negara' => 'required',
        ]);
        if($validate->fails()){
            return response()->json([
                'success' =>false,
                'message' =>'validasi gagal',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $liga = New Liga;
            $liga->nama_liga = $request->nama_liga;
            $liga->negara = $request->negara;
            $liga->save();
            return response()->json([
                'success' =>true,
                'message' =>'data liga berhasil dibuat',
                'data' => $liga,
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
            $liga = Liga::findOrFail($id);
            return response()->json([
                'success' =>true,
                'message' =>'Detail Liga',
                'data' => $liga,
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
            'nama_liga' =>'required',
            'negara' => 'required',
        ]);
        if($validate->fails()){
            return response()->json([
                'success' =>false,
                'message' =>'validasi gagal',
                'errors' => $validate->errors(),
            ], 422);
        }

        try {
            $liga = Liga::findOrFail($id);
            $liga->nama_liga = $request->nama_liga;
            $liga->negara = $request->negara;
            $liga->save();
            return response()->json([
                'success' =>true,
                'message' =>'data liga berhasil dirubah',
                'data' => $liga,
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
            $liga = Liga::findOrFail($id);
            $liga->delete();
            return response()->json([
                'success' =>true,
                'message' =>'Data '. $liga->nama_liga . 'berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' =>false,
                'message' =>'data tidak ditemukan!',
                'errors' => $e->getMessage(),
            ], 404);
        }
    }


}
  
 