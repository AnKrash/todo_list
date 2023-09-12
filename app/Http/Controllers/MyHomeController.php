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

// Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
        // Filter by priority range
        if ($request->has('priority_from')) {
            $query->where('priority', '>=', (int)$request->input('priority_from'));
        }
        if ($request->has('priority_to')) {
            $query->where('priority', '>=', (int)$request->input('priority_from'));
        }
// Full-text search by title
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        // Sorting
        if ($request->has('sort')) {
            $sortField = $request->input('sort');
            $query->orderBy($sortField);
        }
        $tasks = $query->get();
        return view('myhome', ['tasks' => $tasks]);

    }
//    public function create()
//    {
//        return view('create');
//    }
}
