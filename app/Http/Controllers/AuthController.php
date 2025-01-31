<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name' => ['required','string'],
            'email' => ['required','email','unique:users'],
            'password' => ['required','min:6']
        ]);
        
        $user = User::create($data);
        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token
        ];
    }

}
