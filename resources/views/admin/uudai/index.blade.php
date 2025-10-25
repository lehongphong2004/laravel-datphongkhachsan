@extends('layout.admin')

@section('title','Quản lý Ưu Đãi')

@section('admin_content')
<div class="card shadow-sm border-0">
    <!-- Header -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa fa-gift me-2"></i> Danh sách Ưu Đãi</h5>
        <a href="{{ route('admin.uudai.create') }}" class="btn btn-light btn-sm fw-bold">
            <i class="fa fa-plus-circle me-1"></i> Thêm Ưu Đãi
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
                        <th>#</th>
                        <th>Tiêu đề</th>
                        <th>Giảm giá (%)</th>
                        <th>Khách sạn áp dụng</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($uudais as $index => $u)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $u->tieu_de }}</td>
                            <td>{{ $u->giam_gia }}</td>
                            <td>{{ $u->khachsan->ten_khach_san ?? '---' }}</td>
                            <td>{{ $u->ngay_bat_dau ?? '-' }}</td>
                            <td>{{ $u->ngay_ket_thuc ?? '-' }}</td>
                            <td class="text-center">
                                <!-- Nút sửa -->
                                <a href="{{ route('admin.uudai.edit', $u->uudai_id) }}" 
                                   class="btn btn-warning btn-sm me-1" data-bs-toggle="tooltip" title="Sửa">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <!-- Nút xóa -->
                                <form action="{{ route('admin.uudai.destroy', $u->uudai_id) }}" 
                                      method="POST" class="d-inline" 
                                      onsubmit="return confirm('Bạn có chắc muốn xóa ưu đãi này không?');">
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
                            <td colspan="7" class="text-center text-muted">Chưa có ưu đãi nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
