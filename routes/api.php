<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\In\BankController;
use App\Http\Controllers\In\TransactionController;
use App\Http\Controllers\In\UserController;
use Illuminate\Support\Facades\Route;

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

    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::get('/banks', [BankController::class, 'banks']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('in')->group(function () {
            Route::prefix('user')->group(function () {
                Route::post('/pin/add', [AuthController::class, 'addPin']);
                Route::get('/profile', [UserController::class, 'profile']);

                Route::prefix('transactions')->group(function () {
                    Route::get('/', [TransactionController::class, 'transactions']);
                });

                Route::prefix('payment')->group(function () {
                    Route::post('/receive', [TransactionController::class, 'receivePayment']);
                    Route::post('/receive/credit', [TransactionController::class, 'creditTransaction']);
                });
            });
            Route::prefix('account')->group(function () {
                Route::post('/verify', [BankController::class, 'verifyAccount']);
                Route::post('/transfer', [BankController::class, 'transfer']);
            });
        });
        Route::post('/logout', [AuthController::class, 'logout']);
    });