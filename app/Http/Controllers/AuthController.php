<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Mengecek apakah user ada dan passwordnya benar
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau Password salah'
            ], 401); // 401: Unauthorized
        }

        // Jika benar, buatkan Token Kunci (namanya bebas, kita kasih nama 'gudang-token')
        $token = $user->createToken('gudang-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil Login',
            'token' => $token // Ini yang akan dipakai oleh Postman/Frontend nanti
        ]);
    }
}
