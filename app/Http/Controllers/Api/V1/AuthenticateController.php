<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;

class AuthenticateController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', [
            'except' => ['authenticate']
        ]);
    }

    public function index(){
        $users = User::all();

        return $users;
    }
    
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'error' => 'invalid_credentials'
                ], 401);
            }
        } catch(JWTException $e){
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }
}
