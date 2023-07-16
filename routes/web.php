<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('showLoginForm');
    }
});

Route::get('/dashboard', function() {
    if (Auth::check()) {
        return view('dashboard');
    } else {
        return redirect()->route('showLoginForm');
    }
})->name('dashboard');

// register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('showRegisterForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
