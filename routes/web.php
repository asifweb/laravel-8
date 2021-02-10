<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

// Route::get('/auth/redirect', function () {
//     return Socialite::driver('facebook')->redirect();
// })->name('facebook_login');

Route::get('/auth/facebook/redirect', [FacebookController::class, 'redirectToFacebook'])->name('facebook_login');
Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

Route::get('/auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google_login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
