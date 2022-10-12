<?php

use Illuminate\Support\Facades\Route;

/*
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.2.0
this file is used for : web routes.

generated by laravel
updated by : Miguel Moreira
*/

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

Route::get('/', function ()
{
    return view('app');
});

Route::resources(
    [
        'users' => 'App\Http\Controllers\UserController',
        'shopcarts' => 'App\Http\Controllers\ShopCartController',
        'images' => 'App\Http\Controllers\ImageController',
        'items' => 'App\Http\Controllers\ItemController',
    ]);
