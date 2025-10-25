@extends('admin.home')

@section('admin_content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">THÊM KHÁCH SẠN MỚI</h2>

    <form action="{{ route('admin.khachsan.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên khách sạn</label>
            <input type="text" name="ten_khach_san" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="dia_chi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="mo_ta" rows="3" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Xếp hạng (1–5)</label>
            <input type="number" name="xep_hang" class="form-control" min="1" max="5">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="trang_thai" class="form-select">
                <option value="hoat_dong">Hoạt động</option>
                <option value="tam_dung">Tạm dừng</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh (nếu có)</label>
            <input type="file" name="hinh_anh" class="form-control">
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-success">Thêm mới</button>
        <a href="{{ route('admin.khachsan.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
