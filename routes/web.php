<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource("types", App\Http\Controllers\TypeController::class);
Route::resource("events", App\Http\Controllers\EventController::class);
Route::get("events/calendar/{year}/{month}", [App\Http\Controllers\EventController::class, 'calendar'])->name("events.calendar");
