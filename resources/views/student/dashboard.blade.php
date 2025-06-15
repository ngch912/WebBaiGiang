<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Học Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>

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
    <h2>Xin chào học viên {{ auth()->user()->username }}</h2>
    <p>Chào mừng bạn đến với hệ thống học trực tuyến.</p>
</main>

@include('components.footer')

</body>
</html>
