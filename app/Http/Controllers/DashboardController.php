<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function index(Request $request){

        $users = User::all();

        return response()->json([
            'users' => $users,
        ]);

    }

    public function currentUser(Request $request) {

        $user = Auth::user();

        return response()->json([
            'data' => [
                'name' => $user->name,
                'id' => $user->id,
                'messages' => [],
            ]
        ]);

    }
}
