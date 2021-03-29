<?php

namespace App\Http\Controllers;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;
class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'logout']]);
    }
    public function login(AuthRequest $request){
        $validated = $request->validated();
        $credentials =[ 'email' => $validated['email'], 'password' => $validated['password']];
        $token = auth()->attempt($credentials);
        if(!$token) {
            return response()->json(['message' => 'Unautorized'], 401);
        }
        return ['token' => $this->respondWithToken($token) , 'user' => auth()->user(), 'message' => 'Uspešno ste se prijavili'];
    }
    public function isValidToken(Request $request)
    {
        return response()->json(['valid' => auth()->check()]);
    }
    public function logout(Request $request)
    {
        $token = JWTAuth::getToken();
        $tokenParts = explode(".", $token);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtPayload = json_decode($tokenPayload);
        $current_timestamp = Carbon::now()->timestamp;
        $tokenTimeStamp =  $jwtPayload->exp;
        if($current_timestamp > $tokenTimeStamp){

            $token = auth()->refresh(false , true);
            auth()->logout();
            return 'Uspešno se te odjavili';
        }
            auth()->logout();
            return 'Uspešno se te odjavili';

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL(1)
        ]);
    }
}
