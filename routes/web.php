<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return "Hello World";
// });

Route::get('/', [HomeController::class, 'homePage'])->name('homePage');
Route::get('/test', [HomeController::class, 'index'])->name('home');


// User all routes
Route::post('/user-registration', [UserController::class, 'userRegistration'])->name('UserRegistration');
Route::post('/user-login', [UserController::class, 'userLogin'])->name('user.login');
Route::get('/user-logout', [UserController::class, 'userLogout'])->name('user.logout');
