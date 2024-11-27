<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/redirect', [UserController::class, 'redirect'])->name('redirect')->middleware('guest');
Route::get('/callback', [UserController::class, 'callback'])->name('callback')->middleware('guest');

Route::get('/', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'registerStore'])->name('register.store');
Route::post('/login', [UserController::class, 'loginCheck'])->name('login.check');
Route::resource('users', UserController::class);

Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('produk', ProdukController::class);
});