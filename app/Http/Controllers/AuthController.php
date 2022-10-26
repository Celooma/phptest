<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{




    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];


        if(Auth::attempt($credentials)) {
            $response['success'] = true;
            $response['message'] = "";
            $response['token'] = $request->user()->createToken('logintoken')->plainTextToken;
            $response['isAdmin'] = Auth::user()->isAdmin;
            $response['name'] = Auth::user()->name;

        } else {
            $response['success'] = false;
            $response['message'] = "Wrong email or password";
        }

        return response()->json($response);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(array('success'=> true));
    }
}
