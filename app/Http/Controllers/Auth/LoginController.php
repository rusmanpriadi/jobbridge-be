<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'nik' => 'required',
        'password' => 'required',
    ]);

    $pelamar = Pelamar::where('nik', $request->nik)->first();

    if (!$pelamar || !Hash::check($request->password, $pelamar->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $pelamar->createToken('auth_token')->plainTextToken;

   if($pelamar) {
            return response()->json([
                'success' => true,
                'message' => 'User login successfully',
                'status'  => 201,
                'data'    => $pelamar,  
                'token'   => $token
            ], 201);
        }

        //return JSON process insert failed 
        return response()->json([
            'success' => false,
            'message' => 'User registration failed',
            'status'  => 409,
        ], 409);
}
}
