<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
     /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')]))
        {

            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')-> accessToken;
            return response()->json(['return', $user, $success]);
        }
        else
        {
            return response()->json(['return','Invalid Username or Password']);
        }

    }
    public function user()
    {
        return Auth::User();
    }
}
