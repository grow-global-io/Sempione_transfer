<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\TodayMenuController;
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
    // items create
    Route::post('/items', [ItemController::class, 'store'])->name('items.create');
    // items get
    Route::get('/items', [ItemController::class, 'index'])->name('items.list');
    // items update
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    // items delete
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.delete');
    // Todays menu curd operation
    Route::get('/todaymenu', [TodayMenuController::class, 'index'])->name('today_menus.list');
    Route::post('/todaymenu', [TodayMenuController::class, 'store'])->name('today_menus.create');
    Route::put('/todaymenu/{todaymenu}', [TodayMenuController::class, 'update'])->name('today_menus.update');
    Route::delete('/todaymenu/{todaymenu}', [TodayMenuController::class, 'destroy'])->name('today_menus.delete');

    // block useer
    Route::put('/users/{user}', [UserController::class, 'block'])->name('users.update');
    // user delete
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.delete');
    Route::put('/changepw', [UserController::class, 'changePassword'])->name('users.changePassword');
    Route::post('register', [RegisterController::class, 'register'])->name('users.create');
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/buy/{todayMenu}', [OrderController::class, 'buy'])->name('items.buy');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.list');
    // change password
});
// Route::put('/users/{user}', [UserController::class, 'block'])->name('users.block');


Route::post('login', [LoginController::class, 'login']);
