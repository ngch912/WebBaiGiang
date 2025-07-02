@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Khóa học thuộc môn: {{ $subject }}</h2>

        @if ($courses->count() > 0)
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->title }}</h5>
                                <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Không có khóa học nào thuộc môn này.</p>
        @endif
    </div>
@endsection
