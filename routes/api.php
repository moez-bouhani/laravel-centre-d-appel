<?php

use Illuminate\Http\Request;

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


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::patch('update', 'AuthController@update');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::get('showSinglUser/{id}', 'userController@showSinglUser');
Route::post('/user/update/{id}', 'userController@update_client');
Route::post('/user/photo/{id}', 'userController@update_photo');
Route::post('/password/{id}','ClientController@getPassword');
Route::post('/editPassword/{id}','userController@editPassword');

//numero
Route::post('/numero', 'NumeroController@store');
Route::get('/numero', 'NumeroController@index');
Route::get('numero{id}', 'NumeroController@show');
Route::post('/numero/{id}','NumeroController@update');
Route::post('/update/statut/{id}','NumeroController@updatestatut');
Route::delete('/numero/{id}','NumeroController@destroy');
//Posts
Route::post('/add/poste/{id}', 'PosteController@store');
Route::get('showAllEmp', 'NumeroController@showAllEmp');
Route::get('showEmpById/{id}', 'NumeroController@showEmpById');
Route::get('show/numerosByUserid/{id}', 'NumeroController@numerosByUserid');


