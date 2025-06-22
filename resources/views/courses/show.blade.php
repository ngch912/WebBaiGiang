<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

@include('components.header')

<div class="container mt-5">
    <h2>{{ $course->name }}</h2>
    <p><strong>Giảng viên: </strong>{{ $course->teacher->username }}</p>
    <p><strong>Mô tả: </strong>{{ $course->description }}</p>

    <div class="course-actions mt-4">
        <h3>Các bài giảng trong khóa học</h3>
        <ul>
            @foreach($course->lectures as $lecture)
                <li>{{ $lecture->title }}: <a href="{{ route('lectures.show', $lecture->id) }}">Xem bài giảng</a></li>
            @endforeach
        </ul>
    </div>

    <div class="student-actions mt-4">
        <h3>Thành viên trong khóa học</h3>
        <ul>
            @foreach($course->students as $student)
                <li>{{ $student->username }} ({{ $student->email }})</li>
            @endforeach
        </ul>
    </div>
</div>

@include('components.footer')

</body>
</html>
