<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::namespace('App\Http\Controllers')->
prefix('tas')->group(function () {
    Route::get('/', 'api\ApiTaskController@index');
    Route::get('{id}', 'api\ApiTaskController@getById');
    Route::post('/', 'api\ApiTaskController@create');
    Route::get('{id}/edit', 'api\ApiTaskController@edit');
    Route::put('{id}', 'api\ApiTaskController@update');
    Route::delete('{id}', 'api\ApiTaskController@delete');
});
