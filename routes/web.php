<?php

use App\Http\Controllers\LifeExpectancyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/get-country-data',[DashboardController::class, 'countryData']);
Route::get('/countries',[DashboardController::class,'getCountries'])->name('countries');
Route::post('/import', LifeExpectancyController::class)->name('data.store');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


