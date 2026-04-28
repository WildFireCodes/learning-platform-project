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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/','\App\Http\Controllers\DashboardController@index');

Route::get('/user/{user}/statistics','\App\Http\Controllers\StatisticController@index')->name('user.statistics.index')->middleware('auth');
Route::resource('/user', App\Http\Controllers\UserController::class)->middleware('auth')->middleware('can:isTeacher');;
Route::resource('/exercise', App\Http\Controllers\ExerciseController::class)->middleware('auth');
Route::resource('user.exercise', \App\Http\Controllers\UserExerciseController::class)->middleware(['auth.basic']);

require __DIR__.'/auth.php';
