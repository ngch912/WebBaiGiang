<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header - Hệ Thống Web Bài Giảng</title>

    <!-- Font Awesome & Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
            width: 100%;
        }

        .logo img {
            width: 220px;
            height: 70px;
            border-radius: 5px;
        }

        .search-bar-container {
            width: 50%;
            display: flex;
            justify-content: center;
        }

        .search-bar {
            display: flex;
            width: 100%;
        }

        .search-bar input {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        .search-bar button {
            padding: 10px 15px;
            margin-left: 5px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .auth-buttons {
            display: flex;
            align-items: center;
            position: relative;
        }

        .auth-buttons i {
            font-size: 28px;
            margin-left: 20px;
            color: white;
            cursor: pointer;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .auth-buttons i:hover {
            transform: scale(1.2);
            color: #1abc9c;
        }

        .auth-buttons i:active {
            color: #16a085;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 40px;
            background-color: #34495e;
            padding: 10px;
            border-radius: 8px;
            width: 180px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .dropdown-menu a,
        .dropdown-menu button {
            background: none;
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            text-align: left;
            width: 100%;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease, transform 0.2s ease, color 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #1abc9c;
            color: white;
            transform: scale(1.03);
        }

        .dropdown-menu button:hover {
            background-color: #e74c3c;
            color: white;
            transform: scale(1.03);
        }

        .custom-menu {
            width: 100%;
            background-color: #34495e;
            display: flex;
            justify-content: flex-start;
            padding: 10px 0;
        }

        .custom-menu ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding-left: 20px;
        }

        .custom-menu li {
            background-color: #2c3e50;
            border-radius: 10px;
            padding: 10px 20px;
            min-width: 120px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .custom-menu li:hover {
            background-color: #1abc9c;
            transform: scale(1.05);
        }

        .custom-menu a {
            color: white;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<!-- Bootstrap JS (v5.3.3) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<body>

    <header>
        <div class="logo">
            <img src="{{ asset('Ảnh/LOGO.png') }}" alt="Logo Hệ Thống Web Bài Giảng">
        </div>

        <div class="search-bar-container">
            <div class="search-bar">
                <input type="text" placeholder="Tìm kiếm khóa học...">
                <button>Tìm kiếm</button>
            </div>
        </div>

        <div class="auth-buttons">
            @php $role = auth()->user()->role ?? null; @endphp

            <i class="fas fa-user-circle" id="profileIcon"></i>
            <i class="fas fa-bell" onclick="window.location.href='/notifications'"></i>

            <div class="dropdown-menu" id="dropdownMenu">
                @if ($role === 'student')
                    <a href="{{ route('student.profile') }}"><i class="fas fa-user me-2"></i> Hồ sơ của tôi</a>
                    <a href="{{ route('student.courses') }}"><i class="fas fa-book me-2"></i> Khóa học của tôi</a>
                @elseif($role === 'teacher')
                    <a href="{{ route('teacher.profile') }}"><i class="fas fa-user me-2"></i> Hồ sơ của tôi</a>
                    <a href="{{ route('teacher.courses.index') }}"><i class="fas fa-chalkboard-teacher me-2"></i> Quản
                        lý khóa học</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</button>
                </form>
            </div>
        </div>
    </header>

    <nav class="custom-menu">
        <ul>
            <li><a href="{{ route('home') }}">Trang chủ</a></li>
            <li><a href="{{ route('courses.all') }}">Khóa học</a></li>
            <li><a href="{{ route('lectures.index') }}">Bài giảng</a></li>
            <li><a href="{{ route('documents.index') }}">Tài liệu</a></li>
            <li><a href="#">Liên hệ</a></li>
        </ul>
    </nav>

    <script>
        // Toggle dropdown
        document.getElementById('profileIcon').addEventListener('click', function() {
            const menu = document.getElementById('dropdownMenu');
            menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
        });

        // Ẩn khi click ra ngoài
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('dropdownMenu');
            const icon = document.getElementById('profileIcon');
            if (!icon.contains(event.target) && !menu.contains(event.target)) {
                menu.style.display = 'none';
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
