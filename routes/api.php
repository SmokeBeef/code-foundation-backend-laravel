<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("/users/login", [AuthController::class, "login"]);

Route::middleware("jwt")->group(function () {

    // auth
    Route::get("/auth/refreshtoken", [AuthController::class, "refreshToken"]);
    Route::delete("/auth/logout", [AuthController::class, "logout"]);

    Route::get("users", [UserController::class, "index"]);
    
    // book
    Route::post('/books', [BookController::class, "store"]);
    Route::get('/books', [BookController::class, "index"]);
    Route::patch('/books/{id}', [BookController::class, "update"]);
    Route::delete('/books/{id}', [BookController::class, "destroy"]);
});