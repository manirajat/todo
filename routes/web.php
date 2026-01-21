<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
Route::resource('projects', ProjectController::class)->except(['index']);
Route::resource('tasks', TaskController::class)->only(['store', 'update', 'destroy']);
