<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Policies\TaskPolicy;


class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

//    /**
//     * Показує форму створення нового завдання.
//     *
//     * @return \Illuminate\View\View
//     */

    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $task = Task::find($id); // Retrieve the task by ID

        if (!$task) {
            abort(404); // Handle the case when the task is not found
        }

        return view('task', ['task' => $task]); // Return the 'task' view with the task data
    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Models\Task  $task
//     * @return \Illuminate\Http\Response
//     */
    public function edit(Request $request, $id)
    {
        $task = Task::findOrFail($id); // Отримуємо завдання за ідентифікатором
        return view('update', compact('task')); // Передаємо змінну $task у шаблон
    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Models\Task  $task
//     * @return \Illuminate\Http\Response
//     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
//        $this->authorize('update', $task);
        // Перевірка та валідація даних з форми оновлення
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:todo,done',
            'priority' => 'required|integer|between:1,5',
            // Додайте інші поля, які потрібно оновити
        ]);

        // Оновлення властивостей завдання
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'priority' => $request->input('priority'),
            // Оновлення інших полів за необхідності
        ]);

        // Повертаємо користувача на сторінку завдання з повідомленням
        return Redirect::route('task.show', ['id' => $id])->with('success', 'Завдання було оновлено успішно');
    }
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Models\Task  $task
//     * @return \Illuminate\Http\Response
//     */
    public function destroy(Request $request, $id)
    {
        $task = Task::findOrFail($id);
//        $this->authorize('delete', $task); // Використовуємо політику для перевірки прав доступу

        if ($task->status === 'done') {
            // Видаляти вже виконане завдання не дозволено
            return redirect()->back()->with('error', 'Видалення вже виконаного завдання заборонено.');
        }

        // Видалення підзавдань, якщо потрібно
        $task->subtasks()->delete();

        // Видалення завдання
        $task->delete();

        // Повертаємо користувача на головну сторінку з повідомленням
        return Redirect::route('home')->with('success', 'Завдання було видалено успішно');
    }
    public function markAsDone(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        // Authorize the user before marking the task as done
        $this->authorize('markAsDone', $task);

        // Check if the task already has unfinished subtasks
        if ($task->hasUnfinishedSubtasks()) {
            return redirect()->back()->with('error', 'Cannot mark task as done; it has unfinished subtasks.');
        }

        // Update the task status to 'done'
        $task->update(['status' => 'done']);

        return redirect()->route('task.show', ['id' => $id])->with('success', 'Task marked as done successfully.');
    }

//    public function markCompleted(Request $request, $id)
//    {
//        // Find the task by ID
//        $task = Task::findOrFail($id);
//
//        // Check if the user is authorized to mark the task as completed
//        if ($task->user_id !== auth()->user()->id) {
//            return response()->json(['error' => 'You are not authorized to mark this task as completed.'], 403);
//        }
//
//        // Mark the task as completed
//        $task->status = 'done';
//        $task->completedAt = now();
//        $task->save();
//
//        // Return a success response
//        return response()->json(['message' => 'Task marked as completed.'], 200);
//    }

}
