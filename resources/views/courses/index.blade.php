@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Khóa học</h3>
    </div>

    @if($groupedCourses->isEmpty())
        <div class="alert alert-warning">Không có khóa học nào.</div>
    @else
        @foreach($groupedCourses as $subject => $courses)
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="border-start border-5 border-primary ps-3">{{ $subject }}</h4>
                    <a href="{{ route('subject.courses', ['subject' => $subject]) }}" class="btn btn-outline-primary btn-sm">Xem thêm</a>
                </div>
                <div class="row">
                    @foreach($courses as $course)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">{{ $course->name }}</h5>
                                    <p class="card-text text-muted">Giáo viên: {{ $course->teacher->username ?? 'Không rõ' }}</p>
                                    <p class="card-text">{{ Str::limit($course->description, 70) }}</p>
                                    <button class="btn btn-outline-info btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#courseModal{{ $course->id }}">
                                        Xem chi tiết
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="courseModal{{ $course->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $course->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="modalLabel{{ $course->id }}">{{ $course->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                              </div>
                              <div class="modal-body">
                                <p><strong>Giáo viên:</strong> {{ $course->teacher->username ?? 'Không rõ' }}</p>
                                <p><strong>Môn học:</strong> {{ $course->subject }}</p>
                                <p><strong>Mô tả chi tiết:</strong></p>
                                <p>{{ $course->description }}</p>
                                <p><strong>Ngày tạo:</strong> {{ $course->created_at->format('d/m/Y') }}</p>
                                <p><strong>Lần cập nhật cuối:</strong> {{ $course->updated_at->format('d/m/Y') }}</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
