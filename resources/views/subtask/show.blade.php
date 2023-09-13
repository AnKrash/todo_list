<!DOCTYPE html>
<html>
<head>
    <title>Subtask Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Subtask Details</h1>

    <p><strong>Title:</strong> {{ $subtask->title }}</p>
    <p><strong>Description:</strong> {{ $subtask->description }}</p>
    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Back to Task List</a>
</div>
</body>
</html>


