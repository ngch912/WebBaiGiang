@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="card shadow-lg">
            <div class="row g-0">
                <!-- Ảnh khóa học -->
                <div class="col-md-5">
                    <img src="{{ asset('images/default_course.jpg') }}" class="img-fluid h-100 rounded-start"
                        alt="Ảnh khóa học" style="object-fit: cover;">
                </div>

                <!-- Nội dung khóa học -->
                <div class="col-md-7">
                    <div class="card-body">
                        <h3 class="card-title text-primary fw-bold">{{ $course->name }}</h3>

                        <p class="card-text mt-3">
                            <strong>Môn học:</strong>
                            <span class="badge bg-info text-dark">{{ $course->subject }}</span>
                        </p>

                        <p class="card-text">
                            <strong>Giáo viên:</strong>
                            {{ $course->teacher->username ?? 'Chưa cập nhật' }}
                        </p>

                        <p class="card-text mt-3">
                            <strong>Mô tả khóa học:</strong>
                            <br>
                            {{ $course->description }}
                        </p>

                        <p class="card-text mt-4 text-muted">
                            <i class="fas fa-calendar-alt"></i> Ngày tạo: {{ $course->created_at->format('d/m/Y') }}
                            <br>
                            <i class="fas fa-edit"></i> Cập nhật lần cuối: {{ $course->updated_at->format('d/m/Y') }}
                        </p>

                        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                    @auth
                        @if (auth()->user()->role === 'student')
                            <form method="POST" action="{{ route('courses.request_join', $course->id) }}">
                                @csrf
                                <button class="btn btn-primary mt-3">
                                    📥 Tham gia khóa học
                                </button>
                            </form>
                        @endif
                    @endauth

                </div>
            </div>
        </div>

    </div>
@endsection
