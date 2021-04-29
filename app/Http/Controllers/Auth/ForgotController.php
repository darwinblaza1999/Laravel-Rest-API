<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\Forgot;
use App\Http\Requests\ForgotRequest;
use App\Models\User;

class ForgotController extends Controller
{
    public function forgot(ForgotRequest $request)
    {
        $email = $request->input('email');

        if(User::where('email', $email)->doesntExist()){
            return response([
                'message' => 'User doesn\'t exists'
            ], 404);
        }

        //$token = Str::random(10);

        try{
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);

            //send email
            return response([
                'message' => 'Check your Email'
            ]);
        }catch(\Exception $e)
        {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
