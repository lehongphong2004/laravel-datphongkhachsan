@extends('admin.home')

@section('title', 'Chi tiết khách sạn')

@section('admin_content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">Chi tiết khách sạn: {{ $khachsan->ten_khach_san }}</h2>

    <a href="{{ route('admin.phong.create', $khachsan->khachsan_id) }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Thêm phòng mới
    </a>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Tên phòng</th>
                <th>Loại phòng</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($khachsan->phongs as $phong)
            <tr>
                <td>{{ $phong->phong_id }}</td>
                <td>{{ $phong->ten_phong }}</td>
                <td>{{ $phong->loai_phong }}</td>
                <td>{{ number_format($phong->gia) }}</td>
                <td>{{ $phong->so_luong }}</td>
                <td>{{ Str::limit($phong->mo_ta, 50) }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('admin.phong.edit', $phong->phong_id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> Sửa
                    </a>

                    <form action="{{ route('admin.phong.destroy', $phong->phong_id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Bạn chắc chắn muốn xóa phòng này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.khachsan.index') }}" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Quay lại danh sách khách sạn
    </a>
</div>
@endsection
