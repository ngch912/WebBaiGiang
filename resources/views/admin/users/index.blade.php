@extends('layouts.admin')

@section('title', 'Quản lý tài khoản')

@section('content')
<div class="container mt-4">
    <h2>Danh sách tài khoản</h2>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Thêm tài khoản</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username ?? $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Bạn có chắc muốn xoá?')" class="btn btn-sm btn-danger">Xoá</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
