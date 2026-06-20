<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::controller(LocationController::class)->group(function () {
    Route::get('/locations', 'locations')->name('locations');
    Route::get('/createLocation', 'createLocation')->name('createLocation');
    Route::post('/createLocationSubmit', 'createLocationSubmit')->name('createLocationSubmit');
    Route::get('/editLocation/{id}', 'editLocation')->name('editLocation');
    Route::post('/editLocationSubmit', 'editLocationSubmit')->name('editLocationSubmit');
});
