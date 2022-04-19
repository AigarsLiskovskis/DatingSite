<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
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
Route::get('/', function () {
    return view('layout.layout');
});

Route::get('home', [HomeController::class, 'home'])->middleware('guest')->name('login');

Route::get('main', [MainController::class, 'index'])->middleware('auth');
Route::post('main', [MainController::class, 'update'])->middleware('auth');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::post('login', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('user', [UserController::class, 'show'])->middleware('auth');
Route::post('user', [UserController::class, 'update'])->middleware('auth');

Route::get('user/{picture}', [UserController::class, 'changePicture'])->middleware('auth');

Route::get('gallery/{personsId}', [GalleryController::class, 'index'])->middleware('auth');

Route::get('matching', [MatchController::class, 'matching'])->middleware('auth');


Route::get('/forgot-password', [PasswordResetController::class, 'forgotPassword'])
    ->middleware('guest')->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendLink'])
    ->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'receiveLink'])
    ->middleware('guest')->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
    ->middleware('guest')->name('password.update');

