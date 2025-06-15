<header>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            background-color: #f4f7fc;
            color: #2c3e50;
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

        /* Menu ngang */
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

    <!-- Logo -->
    <div class="logo">
        <img src="{{ asset('Ảnh/LOGO.png') }}" alt="Logo Hệ Thống Web Bài Giảng">
    </div>

    <!-- Thanh tìm kiếm -->
    <div class="search-bar-container">
        <div class="search-bar">
            <input type="text" placeholder="Tìm kiếm khóa học...">
            <button>Tìm kiếm</button>
        </div>
    </div>

    <!-- Icon cá nhân và chuông -->
    <div class="auth-buttons">
        @php $role = auth()->user()->role ?? null; @endphp

        @if ($role === 'teacher')
            <i class="fas fa-user-circle" onclick="window.location.href='{{ route('teacher.profile') }}'"></i>
        @elseif ($role === 'student')
            <i class="fas fa-user-circle" onclick="window.location.href='{{ route('student.profile') }}'"></i>
        @else
            <i class="fas fa-user-circle" onclick="window.location.href='#'"></i>
        @endif

        <i class="fas fa-bell" onclick="window.location.href='/notifications'"></i>
    </div>
</header>

<!-- Thanh menu ngang -->
<nav class="custom-menu">
    <ul>
        <li><a href="#">Trang chủ</a></li>
        <li><a href="#">Khóa học</a></li>
        <li><a href="#">Bài giảng</a></li>
        <li><a href="#">Tài liệu</a></li>
        <li><a href="#">Lịch học</a></li>
        <li><a href="#">Liên hệ</a></li>
    </ul>
</nav>
