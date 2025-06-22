<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header - Hệ Thống Web Bài Giảng</title>
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
            padding: 20px;
            background-color: #2c3e50;
            color: white;
            width: 100%;
        }

        header .logo img {
            width: 220px;
            height: 70px;
            border-radius: 5px;
        }

        header .search-bar-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50%;
        }

        header .search-bar {
            display: flex;
            align-items: center;
            width: 100%;
        }

        header .search-bar input {
            padding: 10px;
            width: 80%;
            border: none;
            border-radius: 5px;
        }

        header .search-bar button {
            padding: 10px 15px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 4px;
        }

        header .auth-buttons {
            display: flex;
            align-items: center;
            position: relative;
        }

        header .auth-buttons i {
            font-size: 30px;
            color: white;
            margin-left: 20px;
            cursor: pointer;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        header .auth-buttons i:hover {
            transform: scale(1.2);
            color: #3498db;
        }

        /* Dropdown menu */
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 40px;
            background-color: #34495e;
            padding: 10px;
            border-radius: 8px;
            width: 150px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .dropdown-menu a, .dropdown-menu button {
            text-decoration: none;
            color: white;
            font-weight: bold;
            display: block;
            padding: 8px 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
            width: 100%;
            text-align: center;
        }

        .dropdown-menu a:hover, .dropdown-menu button:hover {
            background-color: #1abc9c;
        }

        .dropdown-menu button {
            background: none;
            border: none;
            color: white;
            padding: 8px 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .dropdown-menu button:hover {
            background-color: #e74c3c;
            transform: scale(1.05);
        }

        .custom-menu {
            width: 100%;
            background-color: #34495e;
            display: flex;
            justify-content: flex-start;
            padding: 10px 0;
        }

        .custom-menu ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding-left: 20px;
            gap: 16px;
        }

        .custom-menu li {
            background-color: #2c3e50;
            border-radius: 10px;
            padding: 10px 20px;
            min-width: 120px;
            text-align: center;
            transition: background-color 0.3s, transform 0.3s;
        }

        .custom-menu li:hover {
            background-color: #1abc9c;
            transform: scale(1.05);
        }

        .custom-menu a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            display: block;
        }
    </style>
</head>
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

        <!-- Dropdown Menu -->
        <div class="dropdown-menu" id="dropdownMenu">
            @if($role == 'student')
                <a href="{{ route('student.profile') }}">Hồ sơ của tôi</a>
                <a href="{{ route('student.courses') }}">Khóa học của tôi</a>
            @elseif($role == 'teacher')
                <a href="{{ route('teacher.profile') }}">Hồ sơ của tôi</a>
                <a href="{{ route('teacher.courses.index') }}">Quản lý khóa học</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Đăng xuất</button>
            </form>
        </div>
    </div>
</header>

<script>
    // Toggle dropdown menu
    document.getElementById('profileIcon').addEventListener('click', function() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });
</script>

<nav class="custom-menu">
    <ul>
        <li><a href="{{ route('student.courses') }}">Trang chủ</a></li> <!-- Link to home -->
        <li><a href="{{ route('student.courses') }}">Khóa học</a></li> <!-- Link to courses -->
        <li><a href="#">Bài giảng</a></li>
        <li><a href="#">Tài liệu</a></li>
        <li><a href="#">Liên hệ</a></li>
    </ul>
</nav>

</body>
</html>
