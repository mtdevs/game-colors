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

Route::group(['prefix' => 'api/palettes'], function () {
    Route::get('/', 'Api\Palettes@index');
    Route::post('/', 'Api\Palettes@store')->middleware('auth');
    Route::get('/{palette}', 'Api\Palettes@show');
    Route::put('/{palette}', 'Api\Palettes@likePalette');
});
