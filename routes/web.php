<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\Logado;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {
  Route::get('/', 'home')->name('home');
  Route::get('/about', 'about')->name('about');
  Route::get('/projects', 'projects')->name('projects');
  Route::get('/project_detail/{tipo}', 'project_detail')->name('project_detail');
  Route::get('/events', 'events')->name('events');
  Route::get('/event_detail', 'event_detail')->name('event_detail');
  Route::get('/contact', 'contact')->name('contact');
});

Route::controller(AuthController::class)->group(function () {
  Route::get('/login', 'login')->name('login');
  Route::post('/loginSubmit', 'loginSubmit')->name('loginSubmit');
  Route::get('/forgot_password', 'forgot_password')->name('forgot_password');
});

Route::middleware(Logado::class)->group(function () {
  Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
  Route::controller(MainController::class)->group(function () {
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/users', 'users')->name('users');
  });
});