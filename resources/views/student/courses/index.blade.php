@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách khóa học</h2>

    @foreach ($courses as $course)
        <div class="card my-3">
            <div class="card-body">
                <h5>{{ $course->name }}</h5>
                <p>{{ $course->description }}</p>
                <p><strong>Giảng viên:</strong> {{ $course->teacher->username }}</p>

                @if (in_array($course->id, $joined))
                    <button class="btn btn-success" disabled>Đã tham gia</button>
                @else
                    <form action="{{ route('student.courses.join', $course->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Tham gia</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
