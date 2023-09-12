<?php

use App\Http\Controllers\MyHomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::put('/tasks/{id}/mark-completed', [TaskController::class,'markCompleted']);

//Route::get('/task/create', [MyHomeController::class, 'create'])->name('task.create');
// Маршрути для завдань (Task)
//Route::prefix('tasks')->group(function () {
//    Route::post('/', 'TaskController@create'); // Створення нового завдання
//    Route::put('/{task}', 'TaskController@edit'); // Редагування завдання
//    Route::delete('/{task}', 'TaskController@delete'); // Видалення завдання
//    Route::put('/{task}/done', 'TaskController@markAsDone'); // Позначення завдання як виконаного
//    Route::get('/', 'TaskController@getTasks'); // Отримання списку завдань з можливістю фільтрації, сортування та пошуку
//});

// Маршрути для підзавдань (Subtask)
//Route::prefix('subtasks')->group(function () {
//    Route::post('/{task_id}', 'SubtaskController@create'); // Створення нового підзавдання та пов'язання його з завданням
//    Route::put('/{subtask}', 'SubtaskController@edit'); // Редагування підзавдання
//    Route::delete('/{subtask}', 'SubtaskController@delete'); // Видалення підзавдання
//});
