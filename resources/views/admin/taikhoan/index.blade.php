@extends('layout.admin')

@section('title', $title ?? 'Quản Lý Tài Khoản')

@section('admin_content')
<div class="card shadow-sm border-0">
    <!-- Header -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa fa-users me-2"></i> Danh sách Tài khoản</h5>
        <a href="{{ route('admin.taikhoan.create') }}" class="btn btn-light btn-sm fw-bold">
            <i class="fa fa-plus-circle me-1"></i> Thêm tài khoản mới
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
                        <th>Tên Đăng Nhập</th>
                        <th>Vai Trò</th>
                        <th class="text-center">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($taikhoans as $tk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $tk->ten_dang_nhap }}</td>
                            <td>
                                <span class="badge {{ $tk->vai_tro === 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                    {{ ucfirst($tk->vai_tro) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.taikhoan.edit', $tk->taikhoan_id) }}" 
                                   class="btn btn-warning btn-sm me-1" data-bs-toggle="tooltip" title="Sửa">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.taikhoan.destroy', $tk->taikhoan_id) }}" 
                                      method="POST" class="d-inline" 
                                      onsubmit="return confirm('Bạn có chắc muốn xóa tài khoản này?')">
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
                            <td colspan="4" class="text-center text-muted">Chưa có tài khoản nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
