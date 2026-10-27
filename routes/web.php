<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

//landing page
Route::view('/', 'landing')->name('home');

// ======================== AUTHENTICATION SIDE ========================

//show register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

//register backend
Route::post('/register', [AuthController::class, 'register']);

//show login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

//Login backend
Route::post('/login', [AuthController::class, 'login']);

//one-click demo login (admin or client)
Route::post('/demo/{role}', [AuthController::class, 'demoLogin'])->whereIn('role', ['admin', 'client'])->name('demoLogin');

//logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//profile pictures stored in the database
Route::get('/avatar/{id}', [ProfileController::class, 'showProfilePicture'])->name('avatar');

Route::middleware('loggedin')->group(function () {

    // ======================== ADMIN SIDE ========================

    Route::middleware('admin')->group(function () {

        //show Admin Dashboard
        Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('dashboard');

        //show Admin Users
        Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('users');

        // add Users
        Route::post('/admin/users', [AdminController::class, 'addUser'])->name('addUser');

        // edit Users
        Route::post('/admin/users/{id}', [AdminController::class, 'editUser'])->name('editUser');

        // delete Users
        Route::get('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
    });

    // ======================== CLIENT PORTAL ========================

    //show Client Dashboard
    Route::get('/portal', [ClientController::class, 'showDashboard'])->name('portal');

    // ======================== VEHICLES (admins see all, clients see their own) ========================

    //show Vehicle Records
    Route::get('/vehicles', [VehicleController::class, 'showVehicles'])->name('vehicles');

    //add Vehicle
    Route::post('/vehicles', [VehicleController::class, 'addVehicle'])->name('addVehicle');

    //edit Vehicle
    Route::post('/vehicles/{id}', [VehicleController::class, 'editVehicle'])->name('editVehicle');

    //delete Vehicle
    Route::get('/vehicles/{id}', [VehicleController::class, 'deleteVehicle'])->name('deleteVehicle');

    // ======================== PROFILE ========================

    //show Profile
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');

    //update Profile
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

    //update Profile Picture
    Route::post('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('updateProfilePicture');
});

//old admin links from before the client portal existed
Route::redirect('/admin/vehicles', '/vehicles');
Route::redirect('/admin/profile', '/profile');
