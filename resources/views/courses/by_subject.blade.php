@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Khóa học môn {{ $subject }}</h2>

    @if($courses->isEmpty())
        <p>Hiện chưa có khóa học nào cho môn này.</p>
    @else
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                            <a href="#" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $courses->links() }}
    @endif
</div>
@endsection
