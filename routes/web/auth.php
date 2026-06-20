<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/loginSubmit', 'loginSubmit')->name('loginSubmit');
    Route::get('/forgot_password', 'forgot_password')->name('forgot_password');
    Route::post('/forgot_password_submit', 'forgot_password_submit')->name('forgot_password_submit');
    Route::get('/send_confirm', 'send_confirm')->name('send_confirm');
    Route::get('/update_password/{token}', 'update_password')->name('password.reset');
    Route::post('/update_password_submit/{token}', 'update_password_submit')->name('update_password_submit');
});
