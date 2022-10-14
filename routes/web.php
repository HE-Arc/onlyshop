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

/*Route::get('/', function () {
    return view('app');
});

Route::get('/login', function () {
    return view('login');
});


Route::get('/item/{id}', function () {
    return view('edit');
});

Route::get('/myitems', function () {
    return view('myitems');
});*/

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
