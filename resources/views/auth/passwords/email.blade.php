<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>

    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Cấu hình cho body */
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        /* Cấu hình flexbox cho body */
        body {
            display: flex;
            flex-direction: column;  /* Đặt các phần tử theo chiều dọc */
            justify-content: flex-start; /* Các phần tử bắt đầu từ trên cùng */
            align-items: center; /* Căn giữa các phần tử theo chiều ngang */
            background-color: #f3f7fc;
            color: #2c3e50;
        }

        .form-container {
            max-width: 450px;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 30px;
            box-sizing: border-box;
            margin-top: 50px;
            /* Thêm khoảng cách trên cho form */
        }

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

        /* Nút gửi link reset mật khẩu */
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

        /* Hiệu ứng hover cho nút */
        .form-container button:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
        }

        /* Hiệu ứng khi nhấn nút */
        .form-container button:active {
            transform: translateY(2px);
            background-color: #1d6fa5;
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

        /* Thông báo thành công */
        .alert-success {
            background-color: #4caf50;
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: auto;  /* Đảm bảo footer luôn ở dưới cùng */
            width: 100%;
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
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Quên Mật Khẩu</h1>

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

        <!-- Hiển thị thông báo thành công nếu có -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.request') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Nhập email của bạn">
            </div>

            <button type="submit">Gửi Mã Đặt Lại Mật Khẩu</button>
        </form>

        <a href="{{ url('/') }}" class="back-to-home">Trở về Trang Chủ</a>
    </div>

    <!-- Footer -->
    @include('components.footer')

</body>

</html>
