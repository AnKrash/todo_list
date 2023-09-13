<!DOCTYPE html>
<html>
<head>
    <title>Завдання: {{ $task->title }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>{{ $task->title }}</h1>
        <p><strong>Статус:</strong> {{ $task->status }}</p>
        <p><strong>Пріоритет:</strong> {{ $task->priority }}</p>
        <p><strong>Опис:</strong> {{ $task->description }}</p>

        <h2>Підзавдання:</h2>
        <ul>
            @foreach ($task->subtasks as $subtask)
                <li>
                    {{ $subtask->title }} - {{ $subtask->status }}
                    <a href="{{ route('subtask.show', ['id' => $subtask->id]) }}" class="btn btn-info btn-sm">Переглянути</a>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-primary">Редагувати</a>
        <form method="POST" action="{{ route('task.destroy', ['id' => $task->id]) }}" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Видалити</button>
        </form>
        <a href="{{ route('home') }}" class="btn btn-secondary">Повернутися до списку завдань</a>
    </div>
@endsection

