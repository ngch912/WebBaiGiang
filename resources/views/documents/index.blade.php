@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách tài liệu</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Tải lên tài liệu mới</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Khóa học</th>
                <th>File</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>{{ $document->title }}</td>
                <td>{{ $document->course->name ?? 'Không rõ' }}</td>
                <td><a href="{{ asset('storage/' . $document->file_path) }}" target="_blank">Xem tài liệu</a></td>
                <td>
                    <form action="{{ route('documents.destroy', $document->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
