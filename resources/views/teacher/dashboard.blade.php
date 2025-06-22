<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Giảng Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        footer {
            background-color: #2c3e50; color: white;
            text-align: center; padding: 20px; margin-top: 30px; width: 100%;
        }
        main {
            padding: 40px;
            width: 100%;
            max-width: 1200px;
        }
        .course-list {
            margin-top: 30px;
        }
        .course-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .course-list th, .course-list td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .course-list th {
            background-color: #34495e;
            color: white;
        }
        .course-list tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-create-course {
            background-color: #2980b9;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-create-course:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>

@include('components.header')

<main>


    <!-- Nút tạo khóa học mới -->
    <a href="{{ route('teacher.courses.create') }}" class="btn-create-course">Tạo Khóa Học Mới</a>

    <!-- Danh sách khóa học của giảng viên -->
    <div class="course-list">
        <h3>Danh sách các khóa học của bạn:</h3>

        @if($courses->isEmpty())
            <p>Giảng viên chưa tạo khóa học nào.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Tên khóa học</th>
                        <th>Mô tả</th>
                        <th>Ngày tạo</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->description }}</td>
                            <td>{{ $course->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('teacher.courses.manage_students', $course->id) }}" class="btn btn-info">Quản lý học sinh</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</main>

@include('components.footer')

</body>
</html>
