@extends('layout.admin')
@section('title','Chỉnh sửa Ưu Đãi')

@section('admin_content')
<h4>Chỉnh sửa Ưu Đãi</h4>

<form action="{{ route('admin.uudai.update', $uudai->uudai_id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Tiêu đề</label>
        <input type="text" name="tieu_de" class="form-control" 
               value="{{ old('tieu_de', $uudai->tieu_de) }}" required>
    </div>

    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="mo_ta" class="form-control">{{ old('mo_ta', $uudai->mo_ta) }}</textarea>
    </div>

    <div class="mb-3">
        <label>Giảm giá (%)</label>
        <input type="number" name="giam_gia" class="form-control" min="0" max="100" 
               value="{{ old('giam_gia', $uudai->giam_gia) }}" required>
    </div>

    <div class="mb-3">
        <label>Khách sạn áp dụng</label>
        <select name="khachsan_id" class="form-control" required>
            @foreach($khachsans as $ks)
                <option value="{{ $ks->khachsan_id }}" 
                    {{ $uudai->khachsan_id == $ks->khachsan_id ? 'selected' : '' }}>
                    {{ $ks->ten_khach_san }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Ngày bắt đầu</label>
        <input type="date" name="ngay_bat_dau" class="form-control" 
               value="{{ old('ngay_bat_dau', $uudai->ngay_bat_dau) }}" required>
    </div>

    <div class="mb-3">
        <label>Ngày kết thúc</label>
        <input type="date" name="ngay_ket_thuc" class="form-control" 
               value="{{ old('ngay_ket_thuc', $uudai->ngay_ket_thuc) }}" required>
    </div>

    <button type="submit" class="btn btn-success">Cập nhật</button>
    <a href="{{ route('admin.uudai.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
