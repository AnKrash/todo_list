<!DOCTYPE html>
<html>
<head>
    <title>Створення нового завдання</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Створення нового завдання</h1>

    <form method="POST" action="{{ route('task.store') }}">
        @csrf

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Опис</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" class="form-control" required>
                <option value="todo">To Do</option>
                <option value="done">Done</option>
            </select>
        </div>

        <div class="form-group">
            <label for="priority">Пріоритет</label>
            <input type="number" name="priority" class="form-control" required>
        </div>

        <!-- Додайте інші поля, які потрібно створити -->

        <button type="submit" class="btn btn-primary">Створити</button>
    </form>

    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Повернутися до списку завдань</a>
</div>
</body>
</html>
