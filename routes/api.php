<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\BoardController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\AssignmentController;
use App\Http\Controllers\API\WalletController;
use App\Http\Controllers\API\EmailController;
use App\Http\Controllers\API\DashboardController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/ziggy', [CalculatorController::class, 'ziggy'])->name('ziggy.routes');

Route::group(['prefix' => 'v2'], function () {

    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
   
    Route::middleware('auth:sanctum')->group( function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('boards.index');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        
        Route::get('/boards', [BoardController::class, 'index'])->name('boards.index');
        Route::post('/boards/add', [BoardController::class, 'store'])->name('boards.add');
        Route::post('/boards/update/{id}', [BoardController::class, 'update'])->name('boards.update');
        Route::post('/boards/delete/{id}', [BoardController::class, 'destroy'])->name('boards.delete');

        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::post('/tasks/add', [TaskController::class, 'store'])->name('tasks.store');
        Route::post('/tasks/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
        Route::post('/tasks/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
        
        Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
        Route::post('/assignments/add', [AssignmentController::class, 'store'])->name('assignments.add');
        Route::post('/assignments/update/{id}', [AssignmentController::class, 'update'])->name('assignments.update');
        Route::post('/assignments/delete/{id}', [AssignmentController::class, 'destroy'])->name('assignments.delete');
  
        Route::get('/wallets', [WalletController::class, 'index'])->name('wallets.index');
        Route::post('/wallets/add', [WalletController::class, 'store'])->name('wallets.add');
        Route::post('/wallets/update/{id}', [WalletController::class, 'update'])->name('wallets.update');
        Route::post('/wallets/delete/{id}', [WalletController::class, 'destroy'])->name('wallets.delete');

        Route::get('/emails', [EmailController::class, 'index'])->name('emails.index');
        Route::post('/emails/send', [EmailController::class, 'store'])->name('emails.send');
        Route::post('/emails/readed/{id}', [EmailController::class, 'readed'])->name('emails.readed');
        Route::post('/emails/archieved/{id}', [EmailController::class, 'archieved'])->name('emails.archieved');
        Route::post('/emails/delete/{id}', [EmailController::class, 'destroy'])->name('emails.delete');
        
    });
});




