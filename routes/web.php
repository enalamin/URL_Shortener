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
    return redirect('/url');
});
/*
Route::view('/{any}', 'dashboard')
    ->where('any', '.*');
    */
Route::get('/url', function () {
    return view('layouts.app');
})->where('any', '.*');

Route::get('/{code}', 'App\Http\Controllers\Api\ShortUrlController@rdireturl');