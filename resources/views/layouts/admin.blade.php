<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 260px;
            background: #343a40;
            color: #fff;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }

        .sidebar .menu-item {
            padding: 12px 20px;
            display: block;
            color: #fff;
            text-decoration: none;
            border-bottom: 1px solid #495057;
        }

        .sidebar .menu-item:hover {
            background: #495057;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
            background: #f4f4f4;
            min-height: 100vh;
        }

        .info-box {
            padding: 20px;
            color: #fff;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .bg-blue { background: #17a2b8; }
        .bg-red { background: #dc3545; }
        .bg-orange { background: #fd7e14; }
        .bg-green { background: #28a745; }
    </style>
</head>

<body>
    <div class="sidebar">
        <h5 class="text-center mb-4">Administrator</h5>
        <div class="text-center mb-3">
            <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
            <p>Chào Admin!</p>
        </div>
        <a href="#" class="menu-item">Bảng điều khiển</a>
        <a href="#" class="menu-item">Cấu hình</a>
        <a href="#" class="menu-item">Quản lý lớp học phần</a>
        <a href="#" class="menu-item">Quản lý bài giảng</a>
        <a href="#" class="menu-item">Quản lý chương</a>
        <a href="#" class="menu-item">Quản lý bài</a>
        <a href="{{ route('admin.users.index') }}" class="nav-link text-white">Quản lý tài khoản</a>
        <a href="#" class="menu-item">Quản lý khoa</a>
        <a href="#" class="menu-item">Quản lý bộ môn</a>
        <a href="#" class="menu-item">Quản lý học phần</a>
        <a href="#" class="menu-item">Quản lý sinh viên</a> 
        <a href="#" class="menu-item">Quản lý giảng viên</a>
        <a href="#" class="menu-item">Quản lý đánh giá</a>
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">Đăng xuất</button>
</form>

    </div>

    <div class="content">
        <h4>Thông Tin Hệ Thống</h4>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="info-box bg-blue">
                    <h5>KHOA</h5>
                    <p>1</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-red">
                    <h5>BỘ MÔN</h5>
                    <p>5</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-orange">
                    <h5>HỌC PHẦN</h5>
                    <p>5</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-green">
                    <h5>LỚP HỌC PHẦN</h5>
                    <p>10</p>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
