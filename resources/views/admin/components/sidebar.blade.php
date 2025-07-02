<div class="bg-dark text-white p-3" style="min-width: 250px;">
    <h4>Administrator</h4>
    <hr>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Bảng điều khiển</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link text-white">Quản lý tài khoản</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-white">Quản lý lớp học phần</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-white">Quản lý bài giảng</a>
        </li>
        <!-- Thêm mục menu tùy ý -->
    </ul>
</div>
