<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/', function () {
    return view('auth.register');
});


// Route::get('/', function () {
//     if (Auth::check()) {
//         return view('auth.login');
//     } else {
//         return view('auth.register');
//     }
// });
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');




// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Route::get('/login',function(){
//     return view('auth.login');
// })->name('login');




Route::get('/login', [RegisteredUserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisteredUserController::class, 'login']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
