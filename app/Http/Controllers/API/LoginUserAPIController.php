<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginUserAPIController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
        ]);

        // Coba otentikasi pengguna
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();

            // Buat token akses pribadi
            $token = $user->createToken('api-token')->plainTextToken;

            // Kembalikan respons sukses dengan data pengguna dan token
            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'Login berhasil',
            ], 200);
        }

        // Jika otentikasi gagal, kembalikan respons error
        return response()->json([
            'message' => 'Kredensial tidak valid',
        ], 401);
    }
}
