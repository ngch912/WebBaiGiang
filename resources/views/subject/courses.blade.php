 @extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Khóa học môn: {{ $subject }}</h2>

    @if($courses->count())
        <div class="row mt-3">
            @foreach($courses as $course)
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">{{ Str::limit($course->description, 80) }}</p>
                            <p><small>Giảng viên: {{ $course->teacher->username ?? 'Không rõ' }}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Hiện chưa có khóa học nào cho môn {{ $subject }}.</p>
    @endif
</div>
@endsection
