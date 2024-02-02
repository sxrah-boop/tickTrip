<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\customAuth;
use  App\Http\Controllers\ProfileController;
use  App\Http\Controllers\TripsController;
use App\Http\Controllers\ReservationController;
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


Route::get('/registration',[customAuth::class,'register'])->name('registration'); //Show registration form
Route::post('/register-user',[customAuth::class,'registerUser'])->name('register-user');

// the protected routes using auth
Route::group(['middleware' => ['auth']], function () {
    Route::get('/create-trip',[TripsController::class,'create']);
    Route::post('/store-trip',[TripsController::class,'store'])->name('store-trip');
});

Route::get('/create-trip',[TripsController::class,'create']);
Route::post('/store-trip',[TripsController::class,'store'])->name('store-trip');

Route::get('/edit-trip/{id}', [TripsController::class, 'edit'])->name('edit-trip');
Route::put('/update-trip/{id}', [TripsController::class, 'update'])->name('update-trip');



Route::get('/home', [customAuth::class, 'homePage'])->name('home');

// Display the user's profile
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.showProfile');

// Redirect the root URL to the '/home' route
Route::redirect('/', '/home');

//reservation

Route::post('/reserver/{tripId}', [ReservationController::class, 'reserver'])->middleware('auth')->name('reserver');


