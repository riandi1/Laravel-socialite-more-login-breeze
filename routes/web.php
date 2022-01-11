<?php

use App\Http\Controllers\SocialiteController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = User::all();
    return view('dashboard',compact('user'));
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';

Route::get('/auth/github/redirect',[SocialiteController::class,'RedirectGithub'])->name('github');

Route::get('/auth/github/callback',[SocialiteController::class,'CallbackGithub']);

Route::get('/auth/google/redirect',[SocialiteController::class,'RedirectGoogle'])->name('google');

Route::get('/auth/google/callback', [SocialiteController::class,'CallbackGoogle']);

