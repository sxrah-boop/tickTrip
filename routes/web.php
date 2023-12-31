<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\customAuth;

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
    return view('welcome');
});
Route::get('/login', [customAuth::class, 'login'])->name('login'); // Show login form
Route::post('/login-user', [customAuth::class, 'loginUser'])->name('login-user'); // Process login


Route::get('/registration',[customAuth::class,'register']);
Route::post('/register-user',[customAuth::class,'registerUser'])->name('register-user');

Route::get('/home', [customAuth::class, 'homePage'])->name('home');

// Redirect the root URL to the '/home' route
Route::redirect('/', '/home');
