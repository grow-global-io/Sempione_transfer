<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\Users\UserController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    LoginController,
    RegisterController
};
use App\Http\Resources\UserResource;

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


Route::middleware(['auth:sanctum', 'permission'])->group(function () {
    // Route::get('/user', function (Request $request) {
    //     return new UserResource($request->user());
    // });
    // Route::get('/details/{role}',[UserController::class,'details']);
    // add more routes here that require the 'auth:sanctum' middleware
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::post('/items', [ItemController::class, 'store'])->name('items.create');
    // items get
    Route::get('/items', [ItemController::class, 'index'])->name('items.list');
    // items update
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    // items delete
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.delete');
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/buy/{item}', [OrderController::class, 'buy'])->name('items.buy');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.list');
});


Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);
