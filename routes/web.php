<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ScheduleController;

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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //user
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);   
    Route::get('/user/delete/{id}', [UserController::class, 'destroy']);

    //schedule
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::get('/schedule/create', [ScheduleController::class, 'create']);
    Route::post('/schedule/store', [ScheduleController::class, 'store']);
    Route::get('/schedule/edit/{id}', [ScheduleController::class, 'edit']);
    Route::post('/schedule/update/{id}', [ScheduleController::class, 'update']);
    Route::get('/schedule/delete/{id}', [ScheduleController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});