<?php

use App\Http\Controllers\user\UserController;
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

Route::get('/users',[UserController::class,'index'])->name('user.index');
Route::get('/users/{user}',[UserController::class,'show'])->name('user.show');
Route::post('users',[UserController::class,'store'])->name('user.store');
Route::put('/users/{user}',[UserController::class,'update'])->name('user.update');
Route::delete('/users/{user}',[UserController::class,'delete'])->name('user.delete');
