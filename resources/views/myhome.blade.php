<!DOCTYPE html>
<html>
<head>
    <title>Список завдань і підзавдань</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Список завдань і підзавдань</h1>
{{--    <form method="GET" action="{{ route('task.filter') }}" class="mb-3">--}}
{{--        @csrf--}}
{{--        <div class="form-row">--}}
{{--            <div class="col">--}}
{{--                <input type="text" name="title" class="form-control" placeholder="Пошук за заголовком"--}}
{{--                       value="{{ request('title') }}">--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <select name="status" class="form-control">--}}
{{--                    <option value="">Усі статуси</option>--}}
{{--                    <option value="todo" {{ request('status') === 'todo' ? 'selected' : '' }}>To Do</option>--}}
{{--                    <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>Done</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <input type="number" name="priority_from" class="form-control" placeholder="Пріоритет від"--}}
{{--                       value="{{ request('priority_from') }}">--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <input type="number" name="priority_to" class="form-control" placeholder="Пріоритет до"--}}
{{--                       value="{{ request('priority_to') }}">--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <select name="sort" class="form-control">--}}
{{--                    <option value="">Сортування</option>--}}
{{--                    <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>За часом--}}
{{--                        створення--}}
{{--                    </option>--}}
{{--                    <option value="completedAt" {{ request('sort') === 'completedAt' ? 'selected' : '' }}>За часом--}}
{{--                        виконання--}}
{{--                    </option>--}}
{{--                    <option value="priority" {{ request('sort') === 'priority' ? 'selected' : '' }}>За пріоритетом--}}
{{--                    </option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <button type="submit" class="btn btn-primary">Фільтрувати</button>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </form>--}}
    <form method="GET" action="{{ route('task.filter') }}" class="mb-3">
        @csrf
        <div class="form-row">
            <div class="col">
                <input type="text" name="title" class="form-control" placeholder="Пошук за заголовком"
                       value="{{ request('title') }}">
            </div>
            <div class="col">
                <select name="status" class="form-control">
                    <option value="">Усі статуси</option>
                    <option value="todo" {{ request('status') === 'todo' ? 'selected' : '' }}>To Do</option>
                    <option value="done" {{ request('status') === 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>
            <div class="col">
                <input type="number" name="priority_from" class="form-control" placeholder="Пріоритет від"
                       value="{{ request('priority_from') }}">
            </div>
            <div class="col">
                <input type="number" name="priority_to" class="form-control" placeholder="Пріоритет до"
                       value="{{ request('priority_to') }}">
            </div>
            <div class="col">
                <select name="sort" class="form-control">
                    <option value="">Сортування</option>
                    <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>За часом
                        створення
                    </option>
                    <option value="completedAt" {{ request('sort') === 'completedAt' ? 'selected' : '' }}>За часом
                        виконання
                    </option>
                    <option value="priority" {{ request('sort') === 'priority' ? 'selected' : '' }}>За пріоритетом
                    </option>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Пошук</button>
            </div> <!-- Add this submit button -->
        </div>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>Заголовок</th>
            <th>Статус</th>
            <th>Пріоритет</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->priority }}</td>
                <td>
                    <a href="{{ route('task.show', ['id' => $task->id]) }}" class="btn btn-info">Переглянути</a>
                    <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-primary">Редагувати</a>
                    <form method="POST" action="{{ route('task.destroy', ['id' => $task->id]) }}"
                          style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="col">
        <a href="{{ route('task.create')}}" class="btn btn-success">Створити нове завдання</a>
    </div>
</div>
</body>
</html>

