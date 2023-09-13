<!DOCTYPE html>
<html>
<head>
    <title>Оновлення завдання</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Оновлення завдання</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('task.update', ['id' => $task->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Опис</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" class="form-control" required>
                <option value="todo" {{ $task->status === 'todo' ? 'selected' : '' }}>To Do</option>
                <option value="done" {{ $task->status === 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>

        <div class="form-group">
            <label for="priority">Пріоритет</label>
            <input type="number" name="priority" class="form-control" value="{{ $task->priority }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Оновити</button>
    </form>

    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Повернутися до списку завдань</a>
</div>
</body>
</html>

