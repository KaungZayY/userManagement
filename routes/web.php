<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users/all',[UserController::class,'index'])->name('users.list');
    Route::get('/users/add',[UserController::class,'create'])->name('users.create');
    Route::post('/users/add',[UserController::class,'store']);
    Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('user.edit');
    Route::post('/users/{user}/edit',[UserController::class,'update'])->name('user.update');
    Route::delete('/users/{user}/delete',[UserController::class,'destroy'])->name('user.delete');

    Route::get('/roles/all',[RoleController::class,'index'])->name('roles.list');
    Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
    Route::post('/roles/create',[RoleController::class,'store']);
    Route::get('/roles/{role}/edit',[RoleController::class,'edit'])->name('role.edit');
    Route::post('/roles/{role}/edit',[RoleController::class,'update'])->name('role.update');
    Route::delete('/roles/{role}/delete',[RoleController::class,'destroy'])->name('role.delete');
});

require __DIR__ . '/auth.php';
