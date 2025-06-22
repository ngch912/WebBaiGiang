<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Khóa Học</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

@include('components.header')

<div class="container mt-5">
    <h2>Danh Sách Khóa Học</h2>
    <ul class="list-group">
        @foreach($courses as $course)
            <li class="list-group-item">
                <a href="{{ route('courses.show', $course->id) }}">{{ $course->name }}</a>
                - {{ $course->teacher->username }}
            </li>
        @endforeach
    </ul>
</div>

@include('components.footer')

</body>
</html>
