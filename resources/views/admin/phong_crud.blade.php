@extends('admin.home')

@section('admin_content')
<div class="container mt-5">
    <h2 class="text-center mb-4">{{ isset($phong) ? 'Sửa phòng' : 'Thêm phòng' }}</h2>

    @if(isset($khachsan))
        <p class="text-center mb-4 fw-bold">Khách sạn: {{ $khachsan->ten_khach_san }}</p>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm p-4">
        <form action="{{ isset($phong) ? route('admin.phong.update', $phong->phong_id) : route('admin.phong.store') }}" method="POST">
            @csrf

            <input type="hidden" name="khachsan_id" value="{{ $khachsan->khachsan_id ?? $khachsan_id }}">

            <div class="mb-3">
                <label class="form-label">Tên phòng:</label>
                <input type="text" name="ten_phong" class="form-control" value="{{ $phong->ten_phong ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Loại phòng:</label>
                <input type="text" name="loai_phong" class="form-control" value="{{ $phong->loai_phong ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Giá:</label>
                <input type="number" name="gia" class="form-control" value="{{ $phong->gia ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Số lượng:</label>
                <input type="number" name="so_luong" class="form-control" value="{{ $phong->so_luong ?? 1 }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả:</label>
                <textarea name="mo_ta" class="form-control">{{ $phong->mo_ta ?? '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($phong) ? 'Cập nhật phòng' : 'Thêm phòng' }}
            </button>

            @if(isset($phong))
                <form action="{{ route('admin.phong.destroy', $phong->phong_id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ms-2" onclick="return confirm('Bạn chắc chắn muốn xóa phòng này?')">Xóa phòng</button>
                </form>
            @endif

            <a href="{{ route('admin.khachsan.index') }}" class="btn btn-secondary ms-2">Quay lại danh sách khách sạn</a>
        </form>
    </div>
</div>
@endsection
