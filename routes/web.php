<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', function () {
    return auth('admin')->user();
});

Route::middleware('guest:web,admin')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'storeUser'])->name('register.user');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth:web,admin'])->group(function () {
    Route::get('/user', [AuthController::class, 'getAuthUser']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
