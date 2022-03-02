<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProducteurController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Producteur;
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
Route::middleware('auth:sanctum')->get('/producteur', function (Request $request) {
    return $request->producteur();
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('user/{id}', [ProductController::class, 'user']);

Route::post('register', [UserController::class, 'register']);
Route::post('registerProducteur', [ProducteurController::class, 'register']);

Route::post('login', [UserController::class, 'login']);
Route::post('loginProducteur', [ProducteurController::class, 'login']);
// Route::get('user/{email}', [UserController::class, 'getUser']);

Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function () {
    // PRODUCTEURS
    Route::put('update/{id}', [ProducteurController::class, 'update']);

    // PRODUCTS
    Route::post('addProduct', [ProductController::class, 'add']);
    Route::delete('deleteProduct/{id}', [ProductController::class, 'delete']);

    // BASKETS
    Route::post('addBasket', [BasketController::class, 'store']);
    Route::delete('deleteBasket/{id}', [BasketController::class, 'delete']);
});
Route::get('products', [ProductController::class, 'allProducts']);
// Route::get('producteur/{id}', [ProducteurController::class, 'user']);

Route::get('locations', [LocationController::class, 'getAll']);
// Route::get('user', 'UserController@index');
// Route::group(['prefix' => 'user'], function () {
//     Route::post('update/{$id}', 'UserController@update');
//     Route::delete('delete/{id}', 'UserController@delete');
// });
Route::get('categories', [CategoryController::class, 'allCategories']);
Route::get('producteurs', [ProducteurController::class, 'allProducteurs']);
// Route::get('producteur', [ProducteurController::class, 'user']);
Route::get('baskets', [BasketController::class, 'allBaskets']);

Route::post('/images', [ImageController::class, 'store']);