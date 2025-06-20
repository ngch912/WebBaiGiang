<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Hệ Thống Web Bài Giảng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
        }
        html, body {
            height: 100%;
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #2c3e50;
        }

        /* HEADER */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        .search-bar-container {
            display: flex;
            justify-content: center;
            width: 50%;
        }
        .search-bar {
            display: flex;
            align-items: center;
            width: 100%;
        }
        .search-bar input {
            padding: 10px;
            width: 80%;
            border: none;
            border-radius: 5px;
        }
        .search-bar button {
            position: relative;
            padding: 10px 15px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 4px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, padding-right 0.3s;
        }
        .search-bar button::after {
            content: "\f061";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            margin-left: 8px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .search-bar button:hover {
            background-color: #219150;
            padding-right: 22px;
        }
        .search-bar button:hover::after {
            opacity: 1;
        }

        .auth-buttons {
            display: flex;
            align-items: center;
        }
        .auth-buttons button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
            min-width: 100px;
        }
        .auth-buttons button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* MENU */
        .custom-menu {
            width: 100%;
            background-color: #2c3e50;
            display: flex;
            justify-content: flex-start;
            padding: 12px 0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .custom-menu ul {
            list-style: none;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            padding: 0 20px;
            gap: 16px;
        }
        .custom-menu li {
            flex: 1;
            background-color: #34495e;
            border-radius: 8px;
            text-align: center;
            transition: background-color 0.3s, transform 0.3s;
            min-width: 100px;
        }
        .custom-menu li:hover {
            background-color: #1abc9c;
            transform: scale(1.05);
        }
        .custom-menu a {
            display: block;
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 0;
        }

        /* FOOTER */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
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
            <button onclick="window.location.href='/login'">Đăng nhập</button>
            <button onclick="window.location.href='{{ route('register') }}'">Đăng ký</button>
        </div>
    </header>

    <!-- MENU -->
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

    <!-- MAIN CONTENT -->
    <main style="padding: 40px; max-width: 1200px; margin: auto;">
        <h1>Chào mừng bạn đến với Hệ Thống Web Bài Giảng</h1>
        <p>Khám phá các khóa học chất lượng cùng đội ngũ giảng viên uy tín.</p>
    </main>

    <!-- FOOTER -->
    @include('components.footer')

</body>
</html>
