@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Danh Sách Khóa Học</h2>
        <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">Tạo Khóa Học Mới</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Tên Khóa Học</th>
                    <th>Mô Tả</th>
                    <th>Quản Lý</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->description }}</td>
                        <td>
                            <a href="{{ route('teacher.courses.manage_students', $course->id) }}" class="btn btn-info">Quản Lý Học Sinh</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
