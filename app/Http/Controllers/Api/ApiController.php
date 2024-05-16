<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        try{
            $validateUser= Validator::make($request->all(),
                [
                    'name' => 'required',
                    'email'=> 'required|email|unique:users,email',
                    'password'=> 'required',
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message'=> 'validation error',
                    'errors'=>$validateUser->errors()
                ], 401);
            }

            $user= User::create(
                [
                    'name' => $request->name,
                    'email'=> $request->email,
                    'password'=> $request->password,
                ]);

            return response()->json([
                'status'=> true,
                'message'=>'User created.',
                'token'=>$user->createToken('API TOKEN')->plainTextToken
            ], 200);
        }catch(\Throwable $throwable){
            return response()->json([
                'status'=>false,
                'message'=>$throwable->getMessage()
            ],500);
        }
    }

    public function login(Request $request)
    {
        try{
            $validateUser= Validator::make($request->all(),
                [
                    'email'=> 'required|email',
                    'password'=> 'required',
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message'=> 'validation error',
                    'errors'=>$validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message'=> 'Email and password not found.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status'=> true,
                'message'=>'Login done.',
                'token'=>$user->createToken('API TOKEN')->plainTextToken
            ], 200);

        }catch(\Throwable $throwable){
            return response()->json([
                'status'=>false,
                'message'=>$throwable->getMessage()
            ],500);
        }
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status'=>true,
            'message' => "You're now logged out"
        ], 200);
    }

}
