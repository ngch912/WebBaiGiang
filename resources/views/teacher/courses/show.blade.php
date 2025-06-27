@extends('layouts.app')

@section('content')
<div class="container mt-4">
    {{-- 🗞 Thông tin chi tiết khóa học --}}
    <div class="card shadow-sm border-0 mb-4 course-info-card">
        <div class="card-body">
            <h3 class="text-primary">{{ $course->name }}</h3>
            <p class="text-muted mb-3">{{ $course->description }}</p>

            <ul class="list-unstyled mb-0">
                <li><strong>Môn học:</strong> {{ $course->subject ?? 'Chưa cập nhật' }}</li>
                <li><strong>Giảng viên:</strong> {{ $course->teacher->username ?? 'Không xác định' }}</li>
                <li><strong>Ngày tạo:</strong> {{ $course->created_at->format('d/m/Y') }}</li>
                <li><strong>Cập nhật gần nhất:</strong> {{ $course->updated_at->format('d/m/Y') }}</li>
            </ul>
        </div>
    </div>

    {{-- 🔔 Học viên chờ duyệt (nút mở modal) --}}
    <button class="btn btn-warning mt-3 me-2" data-bs-toggle="modal" data-bs-target="#manageStudentsModal">
        🔔 Duyệt học viên
    </button>

    <!-- Nút mở modal QUẢN LÝ học viên -->
    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#manageApprovedStudentsModal">
        👨‍🏫 Quản lý học viên
    </button>

    {{-- 📂 Khu vực tài liệu --}}
    <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <h4>📂 Danh sách tài liệu</h4>
        <a href="{{ route('documents.create', $course->id) }}" class="btn btn-success">
            + Tải lên bài giảng mới
        </a>
    </div>

    @if ($course->documents->isEmpty())
        <div class="alert alert-warning">Chưa có tài liệu nào được tải lên cho khóa học này.</div>
    @else
        <div class="row">
            @foreach ($course->documents as $document)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm document-card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $document->title }}</h5>
                            <a href="{{ asset('storage/' . $document->file_path) }}"
                               class="btn btn-outline-primary btn-sm w-100"
                               target="_blank">
                               📅 Xem / Tải về
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- ===== MODAL DUYỆT HỌC VIÊN ===== --}}
<div class="modal fade" id="manageStudentsModal" tabindex="-1" aria-labelledby="manageStudentsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="manageStudentsLabel">Danh sách học viên chờ duyệt</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        @if ($pendingStudents->isEmpty())
            <p class="text-muted mb-0">Không có học viên nào đang chờ duyệt.</p>
        @else
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Thời gian yêu cầu</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingStudents as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->username }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->pivot->joined_at ? \Carbon\Carbon::parse($student->pivot->joined_at)->format('d/m/Y H:i') : '—' }}</td>
                            <td class="text-center">
                                <form class="d-inline" method="POST" action="{{ route('teacher.courses.approve_student', [$course->id, $student->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm me-1">
                                        ✅ Duyệt
                                    </button>
                                </form>
                                <form class="d-inline" method="POST" action="{{ route('teacher.courses.remove_student', [$course->id, $student->id]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        ❌ Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

{{-- ===== MODAL QUẢN LÝ HỌC VIÊN ĐÃ DUYỆT ===== --}}
<div class="modal fade" id="manageApprovedStudentsModal" tabindex="-1" aria-labelledby="approvedModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="approvedModalLabel">Danh sách học viên đã duyệt</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        @if ($students->isEmpty())
            <p class="text-muted">Chưa có học viên nào được duyệt vào khóa học.</p>
        @else
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Ngày tham gia</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->username }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->pivot->joined_at ? \Carbon\Carbon::parse($student->pivot->joined_at)->format('d/m/Y H:i') : '—' }}</td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('teacher.courses.remove_student', [$course->id, $student->id]) }}" onsubmit="return confirm('Bạn có chắc muốn xoá học viên này?')">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        ❌ Xóa khỏi lớp
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

{{-- ✨ CSS tùy chỉnh --}}
<style>
    .course-info-card{
        background:linear-gradient(135deg,#e9f5ff,#f3f8ff);
        border-radius:15px;
        transition:box-shadow .3s;
    }
    .course-info-card:hover{box-shadow:0 6px 25px rgba(0,0,0,.1)}
    .document-card{
        border-left:5px solid #0d6efd;
        border-radius:10px;
        transition:transform .2s,box-shadow .2s;
    }
    .document-card:hover{
        transform:translateY(-5px);
        box-shadow:0 6px 20px rgba(0,0,0,.1);
    }
</style>
@endsection
