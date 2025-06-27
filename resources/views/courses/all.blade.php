@extends('layouts.app')

@section('content')
<style>
    .subject-title {
        background: linear-gradient(90deg, #e3f2fd, #bbdefb);
        border-left: 5px solid #2196f3;
        padding: 12px 20px;
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
        border-radius: 6px;
    }

    .course-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }

    .course-card .card-img-top {
        height: 160px;
        object-fit: cover;
    }

    .btn-detail {
        background-color: #2196f3;
        color: white;
        font-weight: 500;
        padding: 5px 12px;
        border-radius: 6px;
    }

    .btn-detail:hover {
        background-color: #1976d2;
        color: white;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4 text-center text-primary fw-bold">Danh sách khóa học</h2>

    @forelse($groupedCourses as $subject => $coursesBySubject)
        <div class="subject-title d-flex justify-content-between align-items-center">
            {{ $subject }}
            <a href="{{ route('subject.courses', ['subject' => $subject]) }}" class="btn btn-sm btn-outline-primary">Xem thêm</a>
        </div>

        <div class="row">
            @foreach($coursesBySubject as $course)
                <div class="col-md-4 mb-4">
                    <div class="card course-card h-100">
                        <img src="{{ asset('Ảnh/default_course.jpg') }}" class="card-img-top" alt="Ảnh khóa học">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">{{ Str::limit($course->description, 80) }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
                            <small class="text-muted">GV: {{ $course->teacher->username ?? 'Không rõ' }}</small>
                            <a href="#" class="btn btn-sm btn-detail">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="alert alert-warning">Không có khóa học nào được tìm thấy.</div>
    @endforelse

    @if(isset($courses) && method_exists($courses, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {{ $courses->links() }}
        </div>
    @endif
</div>
@endsection
