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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/posts", "App\Http\Controllers\Api\PostController@index");
Route::post("/posts", "App\Http\Controllers\Api\PostController@store");
Route::get("/posts/{post}", "App\Http\Controllers\Api\PostController@show");

Route::post("/contacts", "App\Http\Controllers\Api\ContactController@store");