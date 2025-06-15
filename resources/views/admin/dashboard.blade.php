<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
       * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; margin: 0; font-family: 'Arial', sans-serif; }
        body {
            display: flex; flex-direction: column;
            justify-content: flex-start; align-items: center;
            background-color: #f4f7fc; color: #2c3e50;
        }
        header {
            display: flex; justify-content: space-between;
            padding: 20px; background-color: #2c3e50;
            color: white; width: 100%;
        }
        header .logo img { width: 220px; height: 70px; border-radius: 5px; }
        header .search-bar-container {
            display: flex; align-items: center; justify-content: center;
            width: 50%;
        }
        header .search-bar { display: flex; align-items: center; width: 100%; }
        header .search-bar input {
            padding: 10px; width: 80%; border: none; border-radius: 5px;
        }
        header .search-bar button {
            padding: 10px 15px; background-color: #27ae60;
            color: white; border: none; border-radius: 5px; margin-left: 4px;
        }
        header .auth-buttons { display: flex; align-items: center; }
        header .auth-buttons i {
            font-size: 25px; color: white; margin-left: 20px;
            cursor: pointer; transition: transform 0.3s ease, color 0.3s ease;
        }
        header .auth-buttons i:hover {
            transform: scale(1.2); color: #3498db;
        }
        footer {
            background-color: #2c3e50; color: white;
            text-align: center; padding: 20px; margin-top: 30px; width: 100%;
        }
        main {
            padding: 40px;
            width: 100%;
            max-width: 1200px;
        }
    </style>
</head>
<body>

@include('components.header')

<main>
    <h2>Xin chào quản trị viên {{ auth()->user()->username }}</h2>
    <p>Đây là trang quản trị hệ thống.</p>
</main>

@include('components.footer')

</body>
</html>
