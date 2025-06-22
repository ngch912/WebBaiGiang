<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý học sinh – {{ $course->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Nếu bạn đã có Bootstrap hoặc CSS riêng thì import tại đây --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    {{-- Header dùng lại component có sẵn --}}
    @include('components.header')

    <main class="container my-4">
        <h2>Quản lý học sinh: {{ $course->name }}</h2>

        {{-- Thông báo flash --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped align-middle mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $student->username }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            @if ($student->pivot->status === 'approved')
                                <span class="badge bg-success">Đã duyệt</span>
                            @else
                                <span class="badge bg-warning text-dark">Chờ duyệt</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($student->pivot->status === 'pending')
                                <form method="POST"
                                      action="{{ route('teacher.courses.approve_student', [$course->id, $student->id]) }}"
                                      style="display:inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Duyệt
                                    </button>
                                </form>
                            @else
                                <em class="text-muted">Không có hành động</em>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Chưa có học sinh nào đăng ký khóa học này.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>

    {{-- Footer dùng lại component có sẵn --}}
    @include('components.footer')

</body>
</html>
