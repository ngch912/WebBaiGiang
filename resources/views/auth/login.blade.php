<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Hệ Thống Web Bài Giảng</title>
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #2c3e50;
            padding: 0 20px;
        }

        /* Container cho form */
        .form-container {
            max-width: 450px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            box-sizing: border-box;
        }

        /* Tiêu đề form */
        .form-container h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 20px;
            color: #3498db;
        }

        /* Các trường nhập liệu */
        .form-container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            color: #333;
            background-color: #f7f8fa;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hiệu ứng khi rê chuột vào input */
        .form-container input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.3);
        }

        /* Nút đăng nhập */
        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        /* Hiệu ứng hover cho nút đăng nhập */
        .form-container button:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
        }

        /* Hiệu ứng khi nhấn nút */
        .form-container button:active {
            transform: translateY(2px);
            background-color: #1d6fa5;
        }

        /* Liên kết quên mật khẩu */
        .form-container .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .form-container .forgot-password a {
            color: #3498db;
            text-decoration: none;
        }

        .form-container .forgot-password a:hover {
            text-decoration: underline;
        }

        /* Thông báo lỗi */
        .alert {
            background-color: #f44336;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        /* Nổi bật liên kết đăng ký */
        .back-to-register {
            margin-top: 20px;
            text-align: center;
        }

        .back-to-register a {
            color: #e74c3c;
            font-weight: bold;
            text-decoration: none;
            font-size: 16px;
        }

        .back-to-register a:hover {
            text-decoration: underline;
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: auto;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Đăng Nhập</h1>

        <!-- Hiển thị thông báo lỗi nếu có -->
        @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Nhập email của bạn">
            </div>
            <div>
                <label for="password">Mật Khẩu</label>
                <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">
            </div>

            <button type="submit">Đăng Nhập</button>
        </form>

        <!-- Liên kết quên mật khẩu -->
        <div class="forgot-password">
            <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
        </div>

        <!-- Thêm thông báo đăng ký nếu người dùng chưa có tài khoản -->
        <div class="back-to-register">
            <p>Nếu bạn chưa có tài khoản, hãy <a href="{{ route('register') }}">Đăng ký ngay!</a></p>
        </div>
    </div>

    <!-- Footer -->
    @include('components.footer')

</body>

</html>
