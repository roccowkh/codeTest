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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/codeTest', function () {
    return 'code test';
});

Route::get('/test', function () {
    return view('test', ['value' => '']);
});

Route::post('/test', [PostController::class, 'convertCurrency']);

Route::get('/form', function () {
	return view('form');
});

Route::resource('record', 'App\Http\Controllers\CurrencyController');

Route::post("record",[CurrencyController::class, 'convertCurrency']);
