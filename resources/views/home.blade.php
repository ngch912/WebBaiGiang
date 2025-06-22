<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ - Khóa học</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('components.header')

<div class="container mt-4">
    <!-- Slide show khóa học nổi bật -->
    <div id="highlightCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($highlightedCourses as $index => $course)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="d-flex align-items-center justify-content-center" style="height: 300px; background-color: #f8f9fa">
                        <div class="text-center">
                            <h3>{{ $course->name }}</h3>
                            <p>{{ $course->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#highlightCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#highlightCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <!-- Danh sách khóa học theo môn -->
    <div class="mt-5">
        <h4>Khóa học Toán <a href="{{ route('subject.courses', ['subject' => 'Toán']) }}" class="btn btn-link">Xem thêm</a></h4>
        <div class="row">
            @foreach($mathCourses as $course)
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">{{ Str::limit($course->description, 50) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h4>Khóa học Văn <a href="{{ route('subject.courses', ['subject' => 'Văn']) }}" class="btn btn-link">Xem thêm</a></h4>
        <div class="row">
            @foreach($literatureCourses as $course)
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">{{ Str::limit($course->description, 50) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h4>Khóa học Khoa học <a href="{{ route('subject.courses', ['subject' => 'Khoa học']) }}" class="btn btn-link">Xem thêm</a></h4>
        <div class="row">
            @foreach($scienceCourses as $course)
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">{{ Str::limit($course->description, 50) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@include('components.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
