<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - Hệ Thống Web Bài Giảng</title>
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f7fb;
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

        /* Nút đăng ký */
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

        /* Hiệu ứng hover cho nút đăng ký */
        .form-container button:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
        }

        /* Hiệu ứng khi nhấn nút */
        .form-container button:active {
            transform: translateY(2px);
            background-color: #1d6fa5;
        }

        /* Đường link quay lại trang chủ */
        .form-container .back-to-home {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
            font-size: 16px;
        }

        .form-container .back-to-home:hover {
            text-decoration: underline;
        }

        /* Tạo giao diện đẹp cho radio buttons */
        .role-selector {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .role-selector label {
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 8px;
            background-color: #ecf0f1;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .role-selector label:hover {
            background-color: #3498db;
            color: white;
            transform: scale(1.05);
        }

        .role-selector input[type="radio"] {
            display: none;
        }

        .role-selector input[type="radio"]:checked + label {
            background-color: #3498db;
            color: white;
        }

        /* Thông báo lỗi */
        .alert {
            background-color: #f44336;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
            display: none;
        }

        .alert ul {
            list-style-type: none;
            padding-left: 0;
        }

        .alert ul li {
            margin: 5px 0;
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Đăng Ký Tài Khoản</h1>

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

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div>
                <label for="username">Tên Đăng Nhập</label>
                <input type="text" id="username" name="username" required placeholder="Nhập tên đăng nhập">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Nhập email của bạn">
            </div>
            <div>
                <label for="password">Mật Khẩu</label>
                <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">
            </div>
            <div>
                <label for="password_confirmation">Xác Nhận Mật Khẩu</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Xác nhận mật khẩu">
            </div>

            <!-- Chọn vai trò của người dùng -->
            <div class="role-selector">
                <div>
                    <input type="radio" id="teacher" name="role" value="teacher" required>
                    <label for="teacher">Giáo viên</label>
                </div>
                <div>
                    <input type="radio" id="student" name="role" value="student" checked required>
                    <label for="student">Học sinh</label>
                </div>
            </div>

            <button type="submit">Đăng Ký</button>
        </form>

        <a href="{{ route('login') }}" class="back-to-home">Đã có tài khoản? Đăng nhập ngay!</a>
    </div>

    <!-- Footer -->
    <!-- Import Footer -->
    @include('components.footer')

</body>

</html>
