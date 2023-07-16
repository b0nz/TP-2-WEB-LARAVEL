<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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
        return view('dashboard.index');
    } else {
        return redirect()->route('showLoginForm');
    }
})->name('dashboard');
Route::get('/dashboard/users', [DashboardController::class, 'getUsers'])->name('dashboard.users');
Route::get('/dashboard/users/{user}/reset-password', [DashboardController::class, 'showUserResetPasswordForm'])->name('dashboard.users.reset_password');
Route::put('/dashboard/users/{user}/reset-password', [DashboardController::class, 'updatePassword'])->name('dashboard.users.reset_password');

// register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('showRegisterForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
