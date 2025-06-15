<!-- resources/views/student/profile.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin cá nhân - Học sinh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
<body class="bg-light">

    @include('components.header')

    <div class="container mt-5 mb-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Thông tin cá nhân</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('student.profile.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên người dùng</label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="{{ old('username', $user->username) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ old('email', $user->email) }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>

    @include('components.footer')

</body>
</html>
