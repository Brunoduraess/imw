<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/loginSubmit', 'loginSubmit')->name('loginSubmit');
    Route::get('/forgot_password', 'forgotPassword')->name('forgot_password');
    Route::post('/forgot_password_submit', 'forgotPasswordSubmit')->name('forgot_password_submit');
    Route::get('/send_confirm', 'sendConfirm')->name('send_confirm');
    Route::get('/update_password/{token}', 'updatePassword')->name('password.reset');
    Route::post('/update_password_submit/{token}', 'updatePasswordSubmit')->name('update_password_submit');
});
