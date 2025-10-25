@extends('admin.home')

@section('title', 'Thêm tài khoản')

@section('admin_content')
<div class="container-fluid">
    <h3 class="mb-4">Thêm tài khoản mới</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.taikhoan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Tên Đăng Nhập</label>
            <input type="text" name="ten_dang_nhap" class="form-control" value="{{ old('ten_dang_nhap') }}" required>
        </div>

        <div class="mb-3">
            <label>Mật Khẩu</label>
            <input type="password" name="mat_khau" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Vai Trò</label>
            <select name="vai_tro" class="form-control" required>
                <option value="admin" {{ old('vai_tro') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="khach_hang" {{ old('vai_tro') == 'khach_hang' ? 'selected' : '' }}>Khách Hàng</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.taikhoan.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
