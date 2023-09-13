<?php

use App\Http\Controllers\MyHomeController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [MyHomeController::class, 'index'])->name('myhome');
Route::get('/myhome/filter', [MyHomeController::class, 'filter'])->name('task.filter');

Route::group(['prefix' => 'task'], function () {
    Route::get('/show/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/update/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/delete/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::get('/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/store', [TaskController::class, 'store'])->name('task.store');
});
Route::get('/show/{id}', [SubtaskController::class, 'show'])->name('subtask.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\MyHomeController::class, 'index'])->name('home');
