<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\DTO\UserDto;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   public function __construct(private CreateUserAction $action){}

    public function register(UserRequest $request){
         $createUser = $this->action->createUser($request->validated());
         $dto = new UserDto($createUser['user']->name,$createUser['user']->email,$createUser['user']->id);
         return response()->json([
            'success' => true,
            'message'=> 'create successfoly',
            'user' => $dto,
            'token' => $createUser['token']
         ],201);
    }

    public function login(Request $request){

         $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
         ]);

         if(!Auth::attempt($validate)){
            return response()->json([
                'status' => false,
                'message' => 'email or password inccorect'
            ],401);
         }

         $user = User::where('email',$request->email)->first();

         $token = $user->createToken('token')->plainTextToken;

         return response()->json([
            'status' => true,
            'message' => 'login successfully',
            'data' => $user
         ],201);
    }
}
