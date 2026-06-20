<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::controller(EventController::class)->group(function () {
    Route::get('/eventsAdmin', 'eventsAdmin')->name('eventsAdmin');
    Route::get('/createEvent', 'createEvent')->name('createEvent');
    Route::post('/createEventSubmit', 'createEventSubmit')->name('createEventSubmit');
    Route::get('/editEvent/{id}', 'editEvent')->name('editEvent');
    Route::post('/editEventSubmit', 'editEventSubmit')->name('editEventSubmit');
    Route::get('/disableEvent/{id}', 'disableEvent')->name('disableEvent');
    Route::get('/enableEvent/{id}', 'enableEvent')->name('enableEvent');
});
