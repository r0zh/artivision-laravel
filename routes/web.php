<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

Route::view('upload', 'upload')
    ->middleware(['auth', 'verified'])
    ->name('upload');

Route::view('gallery', 'gallery')
    ->middleware('auth')
    ->name('gallery');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('comunity', 'comunity')
    ->middleware(['auth'])
    ->name('comunity');

Route::get('/private_images/{user}/{file}', [App\Http\Controllers\ImageController::class, 'getImage']);

Route::view('/admin', 'admin')->middleware('permission:admin')->name('admin');

require __DIR__ . '/auth.php';
