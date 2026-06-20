<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(__DIR__.'/web/main.php');
Route::prefix('/')->group(__DIR__.'/web/auth.php');

Route::prefix('/')->middleware('auth')->group(function () {
    Route::prefix('/')->group(__DIR__.'/web/admin.php');
    Route::prefix('/')->group(__DIR__.'/web/user.php');
    Route::prefix('/')->group(__DIR__.'/web/event.php');
    Route::prefix('/')->group(__DIR__.'/web/event-type.php');
    Route::prefix('/')->group(__DIR__.'/web/location.php');
});
