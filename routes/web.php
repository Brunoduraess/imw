<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Logado;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {
  Route::get('/', 'home')->name('home');
  Route::get('/about', 'about')->name('about');
  Route::get('/projects', 'projects')->name('projects');
  Route::get('/project_detail/{tipo}', 'project_detail')->name('project_detail');
  Route::get('/events', 'events')->name('events');
  Route::get('/event_detail/{id}', 'event_detail')->name('event_detail');
  Route::get('/contact', 'contact')->name('contact');
  Route::post('/contactSubmit', 'contactSubmit')->name('contactSubmit');
  Route::get('/confirm', 'confirm')->name('confirm');
});

Route::controller(AuthController::class)->group(function () {
  Route::get('/login', 'login')->name('login');
  Route::post('/loginSubmit', 'loginSubmit')->name('loginSubmit');
  Route::get('/forgot_password', 'forgot_password')->name('forgot_password');
});

Route::middleware(Logado::class)->group(function () {
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
  Route::get('/menu', [AdminController::class, 'menu'])->name('menu');

  Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'users')->name('users');
    Route::get('/newUser', 'newUser')->name('newUser');
    Route::post('/createUser', 'createUser')->name('createUser');
    Route::get('/editUser/{id}', 'editUser')->name('editUser');
    Route::post('/saveUserEdit', 'saveUserEdit')->name('saveUserEdit');
    Route::get('/disableUser/{id}', 'disableUser')->name('disableUser');
    Route::get('/enableUser/{id}', 'enableUser')->name('enableUser');
  });

  Route::controller(EventController::class)->group(function () {
    Route::get('/eventsAdmin', 'eventsAdmin')->name('eventsAdmin');
    Route::get('/createEvent', 'createEvent')->name('createEvent');
    Route::post('/createEventSubmit', 'createEventSubmit')->name('createEventSubmit');
    Route::get('/editEvent/{id}', 'editEvent')->name('editEvent');
    Route::post('/editEventSubmit', 'editEventSubmit')->name('editEventSubmit');
    Route::get('/disableEvent/{id}', 'disableEvent')->name('disableEvent');
    Route::get('/enableEvent/{id}', 'enableEvent')->name('enableEvent');
  });

  Route::controller(EventTypeController::class)->group(function () {
    Route::get('/eventsType', 'eventsType')->name('eventsType');
    Route::get('/createEventType', 'createEventType')->name('createEventType');
    Route::post('/createEventTypeSubmit', 'createEventTypeSubmit')->name('createEventTypeSubmit');
    Route::get('/editEventType/{id}', 'editEventType')->name('editEventType');
    Route::post('/editEventTypeSubmit', 'editEventTypeSubmit')->name('editEventTypeSubmit');
  });

  Route::controller(LocationController::class)->group(function () {
    Route::get('/locations', 'locations')->name('locations');
    Route::get('/createLocation', 'createLocation')->name('createLocation');
    Route::post('/createLocationSubmit', 'createLocationSubmit')->name('createLocationSubmit');
    Route::get('/editLocation/{id}', 'editLocation')->name('editLocation');
    Route::post('/editLocationSubmit', 'editLocationSubmit')->name('editLocationSubmit');
  });

});