@extends('admin.home')

@section('admin_content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">CHỈNH SỬA KHÁCH SẠN</h2>

    <form action="{{ route('admin.khachsan.update', $khachsan->khachsan_id) }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên khách sạn</label>
            <input type="text" name="ten_khach_san" value="{{ $khachsan->ten_khach_san }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="dia_chi" value="{{ $khachsan->dia_chi }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="mo_ta" rows="3" class="form-control">{{ $khachsan->mo_ta }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Xếp hạng (1–5)</label>
            <input type="number" name="xep_hang" value="{{ $khachsan->xep_hang }}" class="form-control" min="1" max="5">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <select name="trang_thai" class="form-select">
                <option value="hoat_dong" {{ $khachsan->trang_thai == 'hoat_dong' ? 'selected' : '' }}>Hoạt động</option>
                <option value="tam_dung" {{ $khachsan->trang_thai == 'tam_dung' ? 'selected' : '' }}>Tạm dừng</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh hiện tại</label><br>
            @if($khachsan->hinhAnhs && $khachsan->hinhAnhs->count() > 0)
                <img src="{{ asset('storage/' . $khachsan->hinhAnhs->first()->duong_dan) }}" 
                     width="150" class="rounded shadow">
            @else
                <p class="text-muted">Chưa có ảnh</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Cập nhật ảnh mới (nếu có)</label>
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

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.khachsan.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
