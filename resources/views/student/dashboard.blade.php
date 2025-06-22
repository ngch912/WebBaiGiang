<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Học Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
            width: 100%;
        }
        main {
            padding: 40px;
            width: 100%;
            max-width: 1200px;
        }
        .course-list {
            margin-top: 30px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f7f9fa;
            border: 1px solid #ccc;
        }
        .course-list h3 {
            font-size: 22px;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        .course-item {
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 8px;
            background-color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .course-item h4 {
            font-size: 18px;
            margin: 0;
        }
        .course-item p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .course-item .status {
            padding: 8px;
            background-color: #27ae60;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>

@include('components.header')

<main>
    <h2>Xin chào học viên {{ auth()->user()->username }}</h2>
    <p>Chào mừng bạn đến với hệ thống học trực tuyến. Dưới đây là danh sách các khóa học bạn đã tham gia.</p>

    <!-- Danh sách các khóa học của học viên -->
    <div class="course-list">
        <h3>Các khóa học của tôi</h3>

        @if($courses->isEmpty())
            <p>Bạn chưa tham gia khóa học nào. Vui lòng đăng ký khóa học mới.</p>
        @else
            @foreach($courses as $course)
                <div class="course-item">
                    <div>
                        <h4>{{ $course->name }}</h4>
                        <p>{{ $course->description }}</p>
                    </div>
                    <span class="status">{{ $course->pivot->status == 'approved' ? 'Đã duyệt' : 'Chờ duyệt' }}</span>
                </div>
            @endforeach
        @endif
    </div>

</main>

@include('components.footer')

</body>
</html>
