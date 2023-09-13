<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class MyHomeController extends Controller
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

    public function index()
    {
        $tasks = Task::with('subtasks')->get();
        return view('myhome', ['tasks' => $tasks]);
    }

    public function filter(Request $request)
    {
        $query = Task::with('subtasks');

        // Фільтрувати за статусом
        if ($request->has('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        // Фільтрувати за діапазоном пріоритетів
        if ($request->has('priority_from')) {
            $query->where('priority', '>=', (int)$request->input('priority_from'));
        }
        if ($request->has('priority_to')) {
            $query->where('priority', '>=', (int)$request->input('priority_to'));
        }
        // Повнотекстовий пошук за назвою
//        if ($request->has('title')) {
//            $query->where('title', 'like', '%' . $request->input('title') . '%');
//        }
        if ($request->has('title')) {
            $title = $request->input('title');
            $query->where('title', 'like', '%' . $title . '%');
        }
        // Сортування
        if ($request->has('sort')) {
            $sortField = $request->input('sort');
            $sortDirection = $request->has('sort_direction') ? $request->input('sort_direction') : 'asc';

            $query->orderBy($sortField, $sortDirection);
        }
        $tasks = $query->get();
        return view('myhome', ['tasks' => $tasks]);

    }

}
