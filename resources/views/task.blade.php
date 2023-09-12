<!-- resources/views/task.blade.php -->

<!-- task.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Завдання: {{ $task->title }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
@extends('layouts.app')
<div class="container mt-5">
    <h1>{{ $task->title }}</h1>
    <p><strong>Статус:</strong> {{ $task->status }}</p>
    <p><strong>Пріоритет:</strong> {{ $task->priority }}</p>
    <p><strong>Опис:</strong> {{ $task->description }}</p>

    <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-primary">Редагувати</a>
    <form method="POST" action="{{ route('task.destroy', ['id' => $task->id]) }}" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Видалити</button>
    </form>
    <a href="{{ route('home') }}" class="btn btn-secondary">Повернутися до списку завдань</a>
</div>
</body>
</html>

