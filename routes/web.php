<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CurrencyController;
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
Route::resource('/', 'App\Http\Controllers\CurrencyController');
Route::get('/test', function () {
    return view('test', ['value' => '']);
});

Route::resource('record', 'App\Http\Controllers\CurrencyController');

Route::post("record",[CurrencyController::class, 'convertCurrency']);
