<?php

use App\Http\Controllers\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/register', [UserRegisterController::class, 'register']);
});