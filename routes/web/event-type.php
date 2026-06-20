<?php

use App\Http\Controllers\EventTypeController;
use Illuminate\Support\Facades\Route;

Route::controller(EventTypeController::class)->group(function () {
    Route::get('/eventsType', 'eventsType')->name('eventsType');
    Route::get('/createEventType', 'createEventType')->name('createEventType');
    Route::post('/createEventTypeSubmit', 'createEventTypeSubmit')->name('createEventTypeSubmit');
    Route::get('/editEventType/{id}', 'editEventType')->name('editEventType');
    Route::post('/editEventTypeSubmit', 'editEventTypeSubmit')->name('editEventTypeSubmit');
});
