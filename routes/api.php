<?php

use Illuminate\Http\Request;
use App\User;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



    Route::get('users', 'UserController@index');
    Route::get('users/{user}', 'UserController@show');
    Route::post('users', 'UserController@store');
    Route::post('users/{user}', 'UserController@update');
    Route::delete('users/{user}', 'UserController@delete');
    
    Route::post('banks', 'BankAccountController@store');
    Route::delete('banks/{bankAccount}', 'BankAccountController@delete');
    Route::get('banks/{user}', 'BankAccountController@show');
    Route::get('banks/showsingleaccount/{bankAccount}', 'BankAccountController@showSingleAccount');
    Route::post('banks/{bankAccount}', 'BankAccountController@update');
    





Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
