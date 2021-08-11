<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('App\\Http\\Controllers')->group(function(){
    Route::post('product/upload', 'ProductController@upload');
    Route::post('user/upload', 'UserController@upload');
    //Route::post('user', 'UserController@create');

    //Route::post('register', 'RegisterController@register');

    //Route ::post('forgot', 'ForgotController@forgot');

    Route::apiResources([
        'product' => 'ProductController',
    ]);
    Route::apiResources([
        'users' => 'UserController',
    ]);

});

Route::namespace('App\\Http\\Controllers\\Auth')->group(function(){
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
    Route::post('forgot', 'ForgotController@forgot');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('user', 'RegisterController@user');
    });
});
