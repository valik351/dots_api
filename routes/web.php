<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::group(['prefix' => 'problems', 'as' => 'problems::'], function () {
        Route::get('/', ['uses' => 'ProblemController@index', 'as' => 'list']);

        Route::get('add', ['uses' => 'ProblemController@showForm', 'as' => 'add']);
        Route::post('add', 'ProblemController@edit');

        Route::get('edit/{id}', ['uses' => 'ProblemController@showForm', 'as' => 'edit']);
        Route::post('edit/{id}', 'ProblemController@edit');

        Route::get('delete/{id}', 'ProblemController@delete');
        Route::get('restore/{id}', 'ProblemController@restore');
    });

    Route::group(['prefix' => 'testing-servers', 'as' => 'testing_servers::'], function () {
        Route::get('/', ['uses' => 'TestingServerController@index', 'as' => 'list']);

        Route::get('add', ['uses' => 'TestingServerController@showForm', 'as' => 'add']);
        Route::post('add', 'TestingServerController@edit');

        Route::get('edit/{id}', ['uses' => 'TestingServerController@showForm', 'as' => 'edit']);
        Route::post('edit/{id}', 'TestingServerController@edit');

        Route::get('delete/{id}', 'TestingServerController@delete');
        Route::get('restore/{id}', 'TestingServerController@restore');
    });

    Route::group(['prefix' => 'programming-languages', 'as' => 'programming_languages::'], function () {
        Route::get('/', ['uses' => 'ProgrammingLanguageController@index', 'as' => 'list']);

        Route::get('add', ['uses' => 'ProgrammingLanguageController@showForm', 'as' => 'add']);
        Route::post('add', 'ProgrammingLanguageController@edit');

        Route::get('edit/{id}', ['uses' => 'ProgrammingLanguageController@showForm', 'as' => 'edit']);
        Route::post('edit/{id}', 'ProgrammingLanguageController@edit');

        Route::get('delete/{id}', 'ProgrammingLanguageController@delete');
        Route::get('restore/{id}', 'ProgrammingLanguageController@restore');
    });
});