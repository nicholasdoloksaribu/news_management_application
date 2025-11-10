<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'your Email or password wrong',
            ],401);
        }

        $token = $user->createToken('My Personal Token')->accessToken;

        return response()->json([
            'message'=> 'login success',
            'token'=>$token,
            'user'=> [
                'id'=> $user->id,
                'name'=> $user->name,
                'role'=> $user->role
            ]
        ]);
    }

}
