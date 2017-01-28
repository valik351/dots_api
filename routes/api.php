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

Route::get('clients/auth/', 'ClientController@getToken')->middleware('auth.api_custom:null,App\Client,basic');
Route::get('testing-servers/auth/', 'TestingServerController@getToken')->middleware('auth.api_custom:null,App\TestingServer,basic');

Route::group(['prefix' => 'problems', 'middleware' => 'auth.api_custom:null,App\TestingServer,bearer'], function () {
    Route::get('{id}/tests-archive.tar.gz', 'ProblemController@getArchive');
});