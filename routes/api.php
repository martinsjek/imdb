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

Route::prefix('movies')->group(function () {
    Route::get('/top', 'App\Http\Controllers\Api\MovieController@getTopMovies');
    Route::get('/{movie}', 'App\Http\Controllers\Api\MovieController@getMovie');
    Route::post('/{movie}/post-comment', 'App\Http\Controllers\Api\MovieController@postComment');
});
