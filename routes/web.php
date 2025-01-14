<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {
  Route::get('/',  'home')->name('home');
  Route::get('/about',  'about')->name('about');
  Route::get('/projects',  'projects')->name('projects');
  Route::get('/events',  'events')->name('events');
  Route::get('/event_detail',  'event_detail')->name('event_detail');
  Route::get('/contact',  'contact')->name('contact');
});