<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class  RegisterUserAPIController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // $token = $request->user->createToken("auth-token");
        // Pastikan pengguna berhasil dibuat sebelum membuat token
        if ($user) {
            // Buat token akses pribadi
            $token = $user->createToken('api-token')->plainTextToken;

            // Kembalikan respons sukses dengan data pengguna dan token
            return response()->json([
                'message' => 'Pendaftaran berhasil',
                'user' => $user,
                'token' => $token,
            ], 201);
        } else {
            // Tangani kasus pembuatan pengguna gagal
            return response()->json([
                'message' => 'Pendaftaran gagal',
            ], 500);
        }

        // // Kembalikan respons berupa JSON
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'User registered successfully',
        //     'data' => [
        //         'user' => $user,
        //         'access_token' => $token,
        //         'token_type' => 'Bearer'
        //     ],
        // ], 201);
    }
}
