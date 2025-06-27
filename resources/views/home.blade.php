@extends('layouts.app')

@section('content')
    <style>
        body {
            transition: background-color 0.3s, color 0.3s;
        }

        .dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .subject-section {
            margin-top: 60px;
        }

        .subject-title {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
            color: white;
            padding: 10px 20px;
            border-radius: 10px 10px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-custom {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card-custom .card-body {
            background: #f9fafb;
        }

        .carousel-highlight {
            background: linear-gradient(90deg, #facc15, #f472b6);
            color: white;
            padding: 50px;
            border-radius: 15px;
            text-align: center;
        }

        .carousel-highlight h3 {
            font-weight: bold;
            font-size: 32px;
        }

        .carousel-highlight p {
            font-size: 18px;
        }

        .thumbnail-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .dark-mode .card-custom .card-body {
            background: #1e1e1e;
            color: white;
        }

        .dark-mode .subject-title {
            background: linear-gradient(90deg, #06b6d4, #3b82f6);
        }

        .dark-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
        }
    </style>

    {{-- 🌙 Dark mode toggle --}}
    <div class="dark-toggle">
        <button onclick="toggleDarkMode()" class="btn btn-dark">🌗 Đổi nền</button>
    </div>

    <div class="container mt-5">

        {{-- 🌟 SLIDE KHÓA HỌC NỔI BẬT --}}
        <div id="highlightCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($highlightedCourses as $index => $course)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="carousel-highlight">
                            <h3>{{ $course->name }}</h3>
                            <p>{{ $course->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#highlightCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#highlightCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        {{-- 📚 KHÓA HỌC THEO MÔN --}}
        @foreach ($coursesBySubject as $subject => $courses)
            @if ($courses->isNotEmpty())
                <div class="subject-section">
                    <div class="subject-title">
                        {{ $subject }}
                        <a href="{{ route('subject.courses', ['subject' => $subject]) }}"
                            class="btn btn-light btn-sm text-dark">Xem thêm</a>
                    </div>

                    <div class="row mt-3">
                        @foreach ($courses as $course)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $course->name }}</h5>
                                        <p class="card-text text-muted">Môn học: {{ $course->subject }}</p>
                                        <p class="card-text">{{ Str::limit($course->description, 50) }}</p>
                                        <button class="btn btn-info mt-2" data-bs-toggle="modal"
                                            data-bs-target="#courseModal{{ $course->id }}">
                                            Xem chi tiết
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="courseModal{{ $course->id }}" tabindex="-1"
                                aria-labelledby="modalLabel{{ $course->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="modalLabel{{ $course->id }}">{{ $course->name }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Đóng"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Giáo viên:</strong> {{ $course->teacher->username ?? 'Không rõ' }}
                                            </p>
                                            <p><strong>Môn học:</strong> {{ $course->subject }}</p>
                                            <p><strong>Mô tả chi tiết:</strong></p>
                                            <p>{{ $course->description }}</p>
                                            <p><strong>Ngày tạo:</strong> {{ $course->created_at->format('d/m/Y') }}</p>
                                            <p><strong>Lần cập nhật cuối:</strong>
                                                {{ $course->updated_at->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
@endsection
