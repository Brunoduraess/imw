<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'users')->name('users');
    Route::get('/newUser', 'newUser')->name('newUser');
    Route::post('/createUser', 'createUser')->name('createUser');
    Route::get('/editUser/{id}', 'editUser')->name('editUser');
    Route::post('/saveUserEdit', 'saveUserEdit')->name('saveUserEdit');
    Route::get('/disableUser/{id}', 'disableUser')->name('disableUser');
    Route::get('/enableUser/{id}', 'enableUser')->name('enableUser');
});
