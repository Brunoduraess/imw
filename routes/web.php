<?php

use App\Http\Controllers\mainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [mainController::class, 'home'])->name('home');
Route::get('/about', [mainController::class, 'about'])->name('about');
Route::get('/projects', [mainController::class, 'projects'])->name('projects');
Route::get('/events', [mainController::class, 'events'])->name('events');
Route::get('/contact', [mainController::class, 'contact'])->name('contact');