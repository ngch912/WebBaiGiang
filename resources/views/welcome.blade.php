<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Hệ Thống Web Bài Giảng</title>

    <!-- Thêm Font Awesome CDN để sử dụng các icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- CSS Styles -->
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
        }

        header .logo img {
            width: 220px;
            height: 70px;
            border-radius: 5px;
            /* Add border-radius for rounded corners */
        }

        /* Thanh tìm kiếm */
        header .search-bar {
            display: flex;
            align-items: center;
            width: 50%;  /* Đặt chiều rộng của thanh tìm kiếm */
            justify-content: center; /* Căn giữa thanh tìm kiếm */
        }

        header .search-bar input {
            padding: 10px;
            width: 80%;  /* Chiều rộng của input */
            border: none;
            border-radius: 5px;
        }

        header .search-bar button {
            padding: 10px 15px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 4px;  /* Tách chữ "Tìm kiếm" với thanh tìm kiếm ra 3-4px */
        }

        /* Nút đăng nhập và đăng ký */
        header .auth-buttons button {
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            margin-left: 10px;
        }

        /* Navigation Menu */
        nav {
            background-color: #34495e;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        /* Slide Show */
        .slideshow {
            position: relative;
            overflow: hidden;
            margin-top: 30px;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: auto;
        }

        .caption {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            font-size: 24px;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        /* Hiệu ứng khi rê chuột vào nút đăng ký */
        header .auth-buttons button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Hiệu ứng khi nhấn nút */
        header .auth-buttons button:active {
            transform: translateY(2px);
            box-shadow: none;
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <header>
        <div class="logo">
            <!-- Dùng helper asset() để đảm bảo đường dẫn đến ảnh là đúng -->
            <img src="{{ asset('Ảnh/LOGO.png') }}" alt="Logo Hệ Thống Web Bài Giảng">
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Tìm kiếm khóa học...">
            <button>Tìm kiếm</button>
        </div>

        <div class="auth-buttons">
            <!-- Liên kết đến trang đăng nhập -->
            <button onclick="window.location.href='/login'">Đăng nhập</button>

            <!-- Liên kết đến trang đăng ký -->
            <button onclick="window.location.href='{{ route('register') }}'">Đăng ký</button>
        </div>
    </header>

    <!-- Navigation Menu -->
    <nav>
        <ul>
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Khóa học</a></li>
            <li><a href="#">Giảng viên</a></li>
            <li><a href="#">Học viên</a></li>
            <li><a href="#">Liên hệ</a></li>
        </ul>
    </nav>

    <!-- Slide Show Section -->
    <section class="slideshow">
        <div class="slides">
            <div class="slide">
                <img src="course1.jpg" alt="Khóa học 1">
                <div class="caption">Khóa học 1: Lập trình web cơ bản</div>
            </div>
            <div class="slide">
                <img src="course2.jpg" alt="Khóa học 2">
                <div class="caption">Khóa học 2: Thiết kế giao diện web</div>
            </div>
            <div class="slide">
                <img src="course3.jpg" alt="Khóa học 3">
                <div class="caption">Khóa học 3: Quản lý cơ sở dữ liệu</div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <!-- Import Footer -->
    @include('components.footer')

</body>

</html>
