<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return "Hello World";
// });

Route::get('/', [HomeController::class, 'homePage'])->name('homePage');
Route::get('/test', [HomeController::class, 'index'])->name('home');
