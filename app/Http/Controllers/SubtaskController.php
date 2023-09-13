<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the details of a subtask by its identifier.
     *
     * @param int $id The subtask identifier.
     * @return View
     */
    public function show($id)
    {
        $subtask = Subtask::find($id); // Отримати підзавдання за ідентифікатором

        if (!$subtask) {
            abort(404); // Обробити випадок, коли підзавдання не знайдено
        }

        return view('subtask.show', ['subtask' => $subtask]); // Повернути перегляд «subtask.show» з даними підзавдання
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Subtask $subtask
     * @return \Illuminate\Http\Response
     */
    public function edit(Subtask $subtask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subtask $subtask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subtask $subtask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Subtask $subtask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subtask $subtask)
    {
        //
    }
}
