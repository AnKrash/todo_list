<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use App\Policies\TaskPolicy;
use Illuminate\View\View;


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
     * @return Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // Валидация данных из формы создания задачи
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:todo,done',
            'priority' => 'required|integer|between:1,5',
            // Добавьте другие поля, которые вы хотите создать
        ]);

        // Создайте новую задачу в базе данных на основе данных из формы
        $task = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'priority' => $request->input('priority'),
            // Добавьте другие поля, которые вы хотите создать
        ]);

        // Перенаправьте пользователя на страницу с подробностями созданной задачи
        return redirect()->route('task.show', ['id' => $task->id])->with('success', 'Завдання створено успішно');
    }


    /**
     * Display the details of a task including its subtasks.
     *
     * @param int $id The task identifier.
     * @return View
     */
    public function show($id)
    {
        $task = Task::with('subtasks')->find($id); // завантажувати підзадачі
        if (!$task) {
            abort(404); // Розглянемо випадок, коли завдання не знайдено
        }
        return view('task', ['task' => $task]); // Повернути перегляд «завдання» з даними про завдання та його підзавдання
    }

    /**
     * Display the edit form for a task.
     *
     * @param Request $request The HTTP request.
     * @param int $id The task identifier.
     * @return View
     */
    public function edit(Request $request, $id)
    {
        $task = Task::findOrFail($id); // Отримуємо завдання за ідентифікатором
        return view('update', compact('task')); // Передаємо змінну $task у шаблон
    }

    /**
     * Update an existing task.
     *
     * @param Request $request The HTTP request.
     * @param int $id The task identifier.
     * @return RedirectResponse
     */
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
        ]);
        // Оновлення властивостей завдання
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'priority' => $request->input('priority'),
        ]);
        // Повертаємо користувача на сторінку завдання з повідомленням
        return Redirect::route('task.show', ['id' => $id])->with('success', 'Завдання було оновлено успішно');
    }

    /**
     * Delete a task.
     *
     * @param Request $request The HTTP request.
     * @param int $id The task identifier.
     * @return RedirectResponse
     */
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

        // Авторизуйте користувача, перш ніж позначати завдання як виконане
        $this->authorize('markAsDone', $task);

        // Перевірте, чи завдання вже має незавершені підзавдання
        if ($task->hasUnfinishedSubtasks()) {
            return redirect()->back()->with('error', 'Cannot mark task as done; it has unfinished subtasks.');
        }

        // Оновіть статус завдання на "виконано"
        $task->update(['status' => 'done']);

        return redirect()->route('task.show', ['id' => $id])->with('success', 'Task marked as done successfully.');
    }
}

