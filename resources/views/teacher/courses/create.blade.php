@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Tạo khóa học mới</h3>

        <form method="POST" action="{{ route('teacher.courses.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Tên khóa học</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">Môn học</label>
                <select name="subject" class="form-select" required>
                    <option value="">-- Chọn môn học --</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject }}">{{ $subject }}</option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Tạo khóa học</button>
        </form>
    </div>
@endsection
