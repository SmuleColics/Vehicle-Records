<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});

// ======================== AUTHENTICATION SIDE ========================

//show register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

//register backend
Route::post('/register', [AuthController::class, 'register']);

//show login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

//Login backend
Route::post('/login', [AuthController::class, 'login']);

// ======================== ADMIN SIDE ========================

//show Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('dashboard');

// ======================== USERS ========================

//show Admin Users
Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('users');

// add Users
Route::post('/admin/users', [AdminController::class, 'addUser'])->name('addUser');

// edit Users
Route::post('/admin/users/{id}', [AdminController::class, 'editUser'])->name('editUser');
// edit Users

Route::get('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');

// ======================== VEHICLES ========================

//show Admin Vehicle Records
Route::get('/admin/vehicles', [AdminController::class, 'showVehicles'])->name('vehicles');

//add Vehicle
Route::post('/admin/vehicles', [AdminController::class, 'addVehicle'])->name('addVehicle');

//edit Vehicle
Route::post('/admin/vehicles/{id}', [AdminController::class, 'editVehicle'])->name('editVehicle');

//delete Vehicle
Route::get('/admin/vehicles/{id}', [AdminController::class, 'deleteVehicle'])->name('deleteVehicle');

// ======================== PROFILE ========================

//show Admin Profile
Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('profile');

//update Profile
Route::post('/admin/profile', [AdminController::class, 'updateProfile'])->name('updateProfile');

//update Profile Picture
Route::post('/admin/profile/picture', [AdminController::class, 'updateProfilePicture'])->name('updateProfilePicture');

//logout
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');