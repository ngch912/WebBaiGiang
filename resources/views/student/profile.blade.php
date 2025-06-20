<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân - Học sinh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #ecf0f1;
        }

        .profile-wrapper {
            display: flex;
            flex-wrap: wrap;
            min-height: 600px;
            width: 100%;
        }

        .sidebar {
            background-color: #2c3e50;
            color: white;
            padding: 30px;
            width: 100%;
            max-width: 300px;
        }

        .sidebar .avatar {
            background-color: #34495e;
            text-align: center;
            padding: 30px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            position: relative;
        }

        .sidebar .avatar i {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        .sidebar .info p {
            margin-bottom: 10px;
            font-size: 15px;
        }

        .sidebar .change-btn {
            margin-top: 15px;
            width: 100%;
            background-color: #2980b9;
            color: white;
            font-weight: bold;
            border: none;
            padding: 10px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .sidebar .change-btn:hover {
            background-color: #3498db;
        }

        .content {
            flex: 1;
            background-color: #f7f9fa;
            padding: 30px;
        }

        .section-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .tabs {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .tabs span {
            background-color: #2c3e50;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
        }

        .tabs span:hover {
            background-color: #2980b9;
        }

        .course-list {
            min-height: 200px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            color: #555;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
            width: 100%;
        }
    </style>
</head>
<body>

    @include('components.header')

    <div class="profile-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="avatar">
                <strong>Ảnh Đại Diện</strong>
                <i class="fas fa-pen"></i> <!-- Chỉnh sửa ảnh -->
            </div>
            <div class="info">
                <p><strong>Họ tên:</strong> {{ $user->username }}</p>
                <p><strong>ID:</strong> {{ $user->id }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>SĐT:</strong> 09xxxxxxxx</p>
                <p><strong>Mật khẩu:</strong> ******** <i class="fas fa-pen"></i></p>
            </div>
            <button class="change-btn">Thay đổi</button>
        </div>

        <!-- Nội dung chính -->
        <div class="content">
            <div class="section-title">Sơ Đồ Hoạt Động</div>

            <div class="tabs">
                <span>Khóa Học Đã Đăng Ký</span>
                <span>Khóa Học Đang Học</span>
                <span>Khóa Học Đã Hoàn Thành</span>
            </div>

            <div class="section-title">Danh Sách Các Khóa Học Đã Lọc</div>
            <div class="course-list">
                <p>Chưa có dữ liệu khóa học hiển thị...</p>
            </div>
        </div>
    </div>

    @include('components.footer')

</body>
</html>
