<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Web Bài Giảng</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #2c3e50;
        }

        main {
            flex: 1;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <x-header />

    <!-- NỘI DUNG TRANG -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <x-footer />

</body>
</html>
