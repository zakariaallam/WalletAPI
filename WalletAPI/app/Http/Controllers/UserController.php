<?php

namespace App\Http\Controllers;

use App\Models\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        
         $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed|max:255',
         ]);

         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
         ]);

         $token = $user->createToken('token')->plainTextToken;

         return response()->json([
            'success' => true,
            'message'=> 'create successfoly',
            'token' => $token
         ],201);
    }

    public function login(Request $request){

         $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
         ]);

         if(!Auth::attempt($validate)){
            return response()->json([
                'status' => 'error',
                'message' => 'email or password inccorect'
            ],401);
         }

         $user = User::where('email',$request->email)->first();

         $token = $user->createToken('token')->plainTextToken;

         return response()->json([
            'status' => ' success',
            'message' => 'login successfully',
            'data' => $user
         ],201);
    }
}
