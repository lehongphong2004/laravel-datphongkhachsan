@extends('layout.admin')

@section('title', 'Quản lý Khách sạn')

@section('admin_content')
<div class="card shadow-sm border-0">
    <!-- Header -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa fa-hotel me-2"></i> Danh sách Khách sạn</h5>
        <a href="{{ route('admin.khachsan.create') }}" class="btn btn-light btn-sm fw-bold">
            <i class="fa fa-plus-circle me-1"></i> Thêm Khách Sạn
        </a>
    </div>

    <!-- Body -->
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Tên khách sạn</th>
                        <th>Địa chỉ</th>
                        <th>Mô tả</th>
                        <th>Xếp hạng</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($khachsans as $ks)
                    <tr>
                        <td>{{ $ks->khachsan_id }}</td>
                        <td class="fw-semibold">{{ $ks->ten_khach_san }}</td>
                        <td>{{ $ks->dia_chi }}</td>
                        <td>{{ Str::limit($ks->mo_ta, 50) }}</td>
                        <td>
                            @for($i = 0; $i < $ks->xep_hang; $i++)
                                <i class="fa fa-star text-warning"></i>
                            @endfor
                        </td>
                        <td>
                            <span class="badge {{ $ks->trang_thai == 'hoat_dong' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $ks->trang_thai == 'hoat_dong' ? 'Hoạt động' : 'Ngừng hoạt động' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.khachsan.edit', $ks->khachsan_id) }}" 
                               class="btn btn-warning btn-sm me-1" data-bs-toggle="tooltip" title="Sửa">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.khachsan.destroy', $ks->khachsan_id) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('Bạn chắc chắn muốn xóa khách sạn này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Xóa">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Chưa có khách sạn nào</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
