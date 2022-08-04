<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Validator;
use Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' =>  Hash::make($fields['password'])
        ]);
        $token = $user->createToken('MyApp',['user'])->accessToken;;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
}
