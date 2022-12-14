<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ShopcartController;
use App\Http\Controllers\API\AuthentificationController;
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

//Public routes
Route::controller(AuthentificationController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login')->name('auth');
});



//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthentificationController::class, 'logout'])->name("users.logout");

    Route::apiResource('items', ItemController::class);
    Route::get('items/getUserItems/{user_id}', [ItemController::class, 'getUserItems'])->name('items.get-user-items');

    Route::apiResource('images', ImageController::class);
    Route::get('images/getItemImages/{item_id}', [ImageController::class, 'getItemImages'])->name('images.get-item-images');

    //Route::apiResource('users', UserController::class);
    Route::post('shopcarts', [ShopcartController::class, 'storeShopCart'])->name('storeShopCart');
    Route::get('shopcarts/getAllItemsInShopCart/{user_id}', [ShopcartController::class, 'getAllItemsInShopCart'])->name('shopcarts.get-all-items-in-shop-cart');

    Route::get('shopcarts/{id}', [ShopcartController::class, 'getShopCart'])->name('shopcarts.get-shop-cart');
    Route::post('shopcarts/addItem', [ShopcartController::class, 'addItem'])->name('shopcats.add-item');
    Route::post('shopcarts/removeItem', [ShopcartController::class, 'removeItem'])->name('shopcarts.remove-item');
    Route::post('shopcarts/emptyShopCart', [ShopcartController::class, 'emptyShopCart'])->name('shopcarts.empty-shop-cart');
});
