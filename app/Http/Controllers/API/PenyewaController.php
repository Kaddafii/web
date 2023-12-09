<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyewa;
use Illuminate\Support\Facades\Hash; // Tambahkan use statement untuk Hash
use Validator;

class PenyewaController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'noHP' => 'required',
            'alamat' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']); // Gunakan Hash::make() untuk mengenkripsi password
        $penyewa = Penyewa::create($input);

        
        return response()->json([
            'success' => true,
            'message' => 'Penyewa berhasil terdaftar',
            'data' => $penyewa
        ]);
    }
}