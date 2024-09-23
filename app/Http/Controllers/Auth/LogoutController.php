<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
        public function logout(Request $request)
    {
         // Cek apakah user sudah terautentikasi
    if ($request->user()) {
        // Hapus token akses yang sedang digunakan
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    } else {
        return response()->json(['message' => 'User not authenticated'], 401);
    }
    }

}
