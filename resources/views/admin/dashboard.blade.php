@extends('layouts.admin'){{-- Nếu chưa có, mình có thể giúp bạn tạo --}}

@section('content')
    <h2>Thông Tin Hệ Thống</h2>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">KHOA</h5>
                    <p class="card-text">{{ $faculties }} khoa</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">BỘ MÔN</h5>
                    <p class="card-text">{{ $departments }} bộ môn</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">HỌC PHẦN</h5>
                    <p class="card-text">{{ $courses }} học phần</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">LỚP HỌC PHẦN</h5>
                    <p class="card-text">10 lớp (tạm fix số)</p>
                </div>
            </div>
        </div>
    </div>
@endsection
