<?php

use App\Http\Controllers\MyHomeController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [MyHomeController::class, 'index'])->name('myhome');
Route::get('/myhome/filter', [MyHomeController::class, 'filter'])->name('task.filter');

Route::get('/task/{id}', [TaskController::class, 'show'])->name('task.show');
Route::get('/task/{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
Route::put('/task/{id}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/task/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
//Route::get('/task/create', function () {
//    return view('welcome');

//Route::get('/task/create', 'TaskController@create')->name('task.create');



Auth::routes();

Route::get('/home', [App\Http\Controllers\MyHomeController::class, 'index'])->name('home');

//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
