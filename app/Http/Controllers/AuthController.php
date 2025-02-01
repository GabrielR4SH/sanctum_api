<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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

    public function login(Request $request){
        $data = $request->validate([
            'email' => ['required','email','exists:users'],
            'password' => ['required','min:6']
        ]);

        $user = User::where('email',$data['email'])->first();
        if(!$user || !Hash::check($data['password'],$user->password)){
            return response([
                'message' => 'Not correct',
            ],401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function userProfile() {
        $userData = Auth::user(); // Pegando o usuário autenticado
    
        if (!$userData) {
            return response()->json([
                'status'  => false,
                'message' => 'Usuário não autenticado'
            ], 401);
        }
    
        return response()->json([
            'status'  => true,
            'message' => 'Perfil do Usuário',
            'data'    => $userData
        ], 200);
    }

    public function userResource($id) 
    {
        $authenticatedUser = Auth::user(); // Obtém o usuário autenticado
        $user = User::findOrFail($id); // Obtém o usuário pelo ID fornecido

        return response()->json([
            'status'  => true,
            'message' => 'Perfil do Usuário usando API Resource',
            'data'    => new UserResource($user),
            'authenticated_user_id' => $authenticatedUser ? $authenticatedUser->id : null
        ], 200);
    }

    public function userCollection()
    {
        $authenticatedUser = Auth::user(); // Obtém o usuário autenticado
        $users = User::all(); // Busca todos os usuários

        return response()->json([
            'status'  => true,
            'message' => 'Lista de usuários usando API Collection',
            'data'    => new UserCollection($users),
            'authenticated_user_id' => $authenticatedUser ? $authenticatedUser->id : null
        ], 200);
    }
    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $request->user()->tokens()->delete(); // Revoga todos os tokens do usuário
            return response()->json([
                'status'  => true,
                'message' => 'Logout realizado com sucesso',
            ], 200);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Usuário não autenticado',
        ], 401);
    }

}
