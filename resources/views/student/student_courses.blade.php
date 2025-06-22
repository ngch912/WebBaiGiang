<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khóa học của học sinh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0f1;
            margin: 0;
        }

        header {
            background-color: #2c3e50;
            padding: 20px;
            color: white;
            text-align: center;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h2 {
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        td {
            background-color: #fff;
        }

        .status {
            font-weight: bold;
        }

        .approved {
            color: green;
        }

        .pending {
            color: orange;
        }

        .view-btn {
            padding: 5px 10px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .view-btn:hover {
            background-color: #2ecc71;
        }
    </style>
</head>
<body>

@include('components.header')

<div class="container">
    <h2>Danh sách khóa học của bạn</h2>

    @if (session('success'))
        <div style="color: green; margin-bottom: 20px;">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div style="color: red; margin-bottom: 20px;">{{ session('error') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Khóa học</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->description }}</td>
                    <td class="status">
                        @if ($course->pivot->status === 'approved')
                            <span class="approved">Đã duyệt</span>
                        @else
                            <span class="pending">Chờ duyệt</span>
                        @endif
                    </td>
                    <td>
                        @if ($course->pivot->status === 'approved')
                            <a href="{{ route('student.courses.view', $course->id) }}" class="view-btn">Xem khóa học</a>
                        @else
                            <em>Chưa được duyệt</em>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Bạn chưa đăng ký khóa học nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('components.footer')

</body>
</html>
