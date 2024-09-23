<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
{
    $validator = Validator::make($request->all(),[
        'name' => 'required|string|max:255',
        'nik' => 'required|string|max:16|unique:pelamars',
        'email' => 'required|string|email|max:255|unique:pelamars',
        'password' => 'required|string|min:8|confirmed',
    ], [
            'nik.unique'   => 'The NIK has already been taken. Please use another NIK.',  // Custom message for NIK uniqueness
            'email.unique' => 'The email has already been taken. Please use another email address.',  // Custom message for email uniqueness
            'email.email'  => 'Please provide a valid email address.',  // Custom message for invalid email format
            'password.confirmed' => 'Password confirmation does not match.',  // Custom message for password confirmation
        ]);



         // If validation fails, return a response with the errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors()  // Return all validation errors
            ], 422);
        }

    $pelamar = Pelamar::create([
        'name' => $request->name,
        'nik' => $request->nik,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'pelamar',
    ]);

    $token = $pelamar->createToken('auth_token')->plainTextToken;


    
    if($pelamar) {
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
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
