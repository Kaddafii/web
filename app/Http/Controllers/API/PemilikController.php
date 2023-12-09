<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use Validator;
use Illuminate\Support\Facades\Auth;

class PemilikController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'noHP' => 'required',
            'alamat' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ada kesalahan',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = Pemilik::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['email'] = $user->email;

        return response()->json([
            'success' => true,
            'message' => 'Pemilik berhasil terdaftar',
            'data' => $success
        ]);
    }

    public function loginPemilik(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $token = $auth->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login sukses',
                'data' => [
                    'token' => $token,
                    'email' => $auth->email,
                ]
            ]);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cek email dan password',
                'data' => null
            ]);
        }
    }
}