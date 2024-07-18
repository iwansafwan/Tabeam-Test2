<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TreasurerController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Route::get('/admin', [AdminController::class, 'index']);
    // other admin routes
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::post('/admin/users/{user}/assign-role', [AdminController::class, 'assignRole'])->name('admin.users.assign-role');
});

Route::middleware(['auth', 'role:Treasurer'])->group(function () {
    Route::get('/treasurer', [TreasurerController::class, 'index']);
    // other treasurer routes
});

Route::middleware(['auth', 'role:Donator'])->group(function () {
    Route::get('/donator', [DonatorController::class, 'index']);
    // other donator routes
});

require __DIR__ . '/auth.php';
