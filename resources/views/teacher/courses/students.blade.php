@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>👩‍🎓 Quản lý học sinh - {{ $course->name }}</h3>
    <hr>

    @if($course->students->isEmpty())
        <p>Không có sinh viên nào đăng ký khóa học này.</p>
    @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($course->students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            {{ $student->pivot->status === 'approved' ? '✅ Đã duyệt' : '⏳ Chờ duyệt' }}
                        </td>
                        <td>
                            @if($student->pivot->status !== 'approved')
                                <form action="{{ route('teacher.courses.approve_student', [$course->id, $student->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Duyệt</button>
                                </form>
                            @endif

                            <form action="{{ route('teacher.courses.remove_student', [$course->id, $student->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('teacher.courses.index') }}" class="btn btn-secondary mt-3">⬅️ Quay lại danh sách khóa học</a>
</div>
@endsection
