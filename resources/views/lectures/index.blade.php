@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách bài giảng</h2>
    <a href="{{ route('lectures.create') }}" class="btn btn-primary mb-3">Thêm bài giảng</a>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <table class="table table-bordered">
        <tr>
            <th>Tiêu đề</th>
            <th>Khóa học</th>
            <th>Hành động</th>
        </tr>
        @foreach($lectures as $lecture)
        <tr>
            <td>{{ $lecture->title }}</td>
            <td>{{ $lecture->course->name }}</td>
            <td>
                <a href="{{ route('lectures.edit', $lecture) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('lectures.destroy', $lecture) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
