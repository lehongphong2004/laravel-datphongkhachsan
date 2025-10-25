@extends('layout.admin')
@section('title','Thêm Ưu Đãi')

@section('admin_content')
<h4>Thêm Ưu Đãi</h4>

<form action="{{ route('admin.uudai.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Tiêu đề</label>
        <input type="text" name="tieu_de" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="mo_ta" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label>Giảm giá (%)</label>
        <input type="number" name="giam_gia" class="form-control" min="0" max="100" required>
    </div>
    <div class="mb-3">
        <label>Khách sạn áp dụng</label>
        <select name="khachsan_id" class="form-control" required>
            @foreach($khachsans as $ks)
                <option value="{{ $ks->khachsan_id }}">{{ $ks->ten_khach_san }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Ngày bắt đầu</label>
        <input type="date" name="ngay_bat_dau" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Ngày kết thúc</label>
        <input type="date" name="ngay_ket_thuc" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Lưu</button>
    <a href="{{ route('admin.uudai.index') }}" class="btn btn-secondary">Hủy</a>
</form>
@endsection
