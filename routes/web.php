<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TripsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersTableController;
use App\Http\Controllers\customAuth;
use App\Http\Controllers\TripsTableController;
use App\Http\Controllers\ReservationsTableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Register web routes for the application. These routes are loaded by
| the RouteServiceProvider and assigned to the "web" middleware group.
|
*/

// Authentication Routes
Route::get('/login', [customAuth::class, 'login'])->name('login'); // Show login form
Route::post('/login-user', [customAuth::class, 'loginUser'])->name('login-user'); // Process login

Route::get('/registration', [customAuth::class, 'register'])->name('registration'); // Show registration form
Route::post('/register-user', [customAuth::class, 'registerUser'])->name('register-user');

// logout
Route::get('/logout', [customAuth::class, 'logout'])->name('logout');


// Protected Routes using auth middleware
Route::group(['middleware' => ['auth']], function () {
    // Trips Routes
    Route::get('/create-trip', [TripsController::class, 'create']);
    Route::post('/store-trip', [TripsController::class, 'store'])->name('store-trip');
});
// Home Page
Route::get('/home', [customAuth::class, 'homePage'])->name('home');

// Trips Routes (outside auth middleware)
Route::get('/create-trip', [TripsController::class, 'create'])->name('create-trip');
Route::post('/store-trip', [TripsController::class, 'store'])->name('store-trip');
Route::get('/edit-trip/{id}', [TripsController::class, 'edit'])->name('edit-trip');
Route::put('/update-trip/{id}', [TripsController::class, 'update'])->name('update-trip');
Route::post('/find-closest-trips', [TripsController::class, 'findClosestTrips'])->name('find-closest-trips');
Route::post('/search-trip', [TripsController::class, 'search'])->name('search-trip');

// Dashboard Routes - only admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/trips', [TripsTableController::class, 'index'])->name('dashboard.trips');
    Route::get('/dashboard/reservations', [ReservationsTableController::class, 'index'])->name('dashboard.reservations');
    Route::get('/dashboard/users', [UsersTableController::class, 'index'])->name('dashboard.users');
    Route::delete('/dashboard/users/{userId}/delete', [UsersTableController::class, 'deleteUser'])->name('dashboard.users.delete');
});

// User Profile Route
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.showProfile');

// Root URL Redirect to Home
Route::redirect('/', '/home');

// Reservation Routes
Route::post('/reserver/{tripId}', [ReservationController::class, 'reserver'])->middleware('auth')->name('reserver');

// update user
Route::patch('/update-user/{userId}', [UsersTableController::class, 'updateUser'])->name('update-user');
