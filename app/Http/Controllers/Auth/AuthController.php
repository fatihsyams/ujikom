<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        request()->validate([
            'name' => ['required'],
            'email' => ['email', 'required', 'unique:users,email'],
            'no_handphone' => ['string', 'required', 'min:6'],
            'password' => ['required', 'min:6'],
            'address' => ['required']
        ]);

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'no_handphone' => request('no_handphone'),
            'password' => bcrypt(request('password')),
            'address' => request('address'),
        ]);

        return response()->json([
            'message' => 'Anda Berhasil Registrasi'
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

    
        if(!$token = Auth::attempt($request->only('email', 'password'))) {
            return response(null, 401);
        }

        return response()->json([
            'token' => $token,
            'message' => 'Berhasil Login'
        ]);
    }
}
