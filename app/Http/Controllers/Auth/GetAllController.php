<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;

class GetAllController extends Controller
{
     public function getAll()
    {
        // Mengambil semua data pelamar
        $pelamars = Pelamar::all();

        // Mengembalikan data dalam format JSON
        return response()->json($pelamars, 200);
    }
}
