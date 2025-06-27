@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>{{ $course->name }}</h2>
    <p><strong>Môn:</strong> {{ $course->subject }}</p>
    <p><strong>Mô tả:</strong> {{ $course->description }}</p>

    <hr>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>🎓 Danh sách bài giảng</h4>
        <a href="{{ route('lectures.create', $course->id) }}" class="btn btn-success btn-sm">+ Thêm bài giảng</a>
    </div>

    @if($course->lectures->count())
        <ul class="list-group mb-4">
            @foreach($course->lectures as $lecture)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $lecture->title }}
                    <a href="#" class="btn btn-outline-primary btn-sm">Xem</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Chưa có bài giảng nào.</p>
    @endif

    <hr>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📁 Tài liệu đính kèm</h4>
        <a href="{{ route('documents.create', $course->id) }}" class="btn btn-primary btn-sm">+ Tải tài liệu</a>
    </div>

    @if($course->documents->count())
        <div class="row">
            @foreach($course->documents as $doc)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $doc->title }}</h5>
                            <p class="card-text">Loại: <strong>{{ strtoupper($doc->type) }}</strong></p>
                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="btn btn-outline-secondary btn-sm">Xem tài liệu</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Chưa có tài liệu nào.</p>
    @endif
</div>
@endsection
