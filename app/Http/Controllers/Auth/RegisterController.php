<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\Register;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try
        {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('MyApp')-> accessToken;
            $success['name'] = $user->name;

        return response()->json(['return',$user]);

        } catch(\Exeption $ex)
        {
            return response()->json(['return', $ex->getMessage]);
        }
    }

    public function user()
    {
        return Auth::User();
    }
}
