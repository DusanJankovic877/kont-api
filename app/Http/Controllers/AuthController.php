<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login(AuthRequest $request){
        $validated = $request->validated();

        $credentials =[ 'email' => $validated['email'], 'password' => $validated['password']];

        $token = $this->guard()->attempt($credentials);
        if(!$token) {
            return response()->json(['message' => 'Unautorized'], 401);
        }
        return ['token' => $this->respondWithToken($token) , 'user' => auth()->user(), 'message' => 'Login success'];
    }
    protected function guard(){
        return Auth::guard();
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
