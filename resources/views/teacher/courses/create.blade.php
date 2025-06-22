@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tạo Khóa Học Mới</h2>
        <form action="{{ route('teacher.courses.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên Khóa Học</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Mô Tả</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Tạo Khóa Học</button>
        </form>
    </div>
@endsection
