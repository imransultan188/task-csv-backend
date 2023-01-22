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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/industries', 'App\Http\Controllers\IndustryController@index');
Route::get('/industries/{id}', 'App\Http\Controllers\IndustryController@show');
Route::post('/industries', 'App\Http\Controllers\IndustryController@store');
Route::delete('/industries/{id}', 'App\Http\Controllers\IndustryController@destroy');

Route::post('/industries/upload', 'App\Http\Controllers\IndustryController@uploadCSV');


