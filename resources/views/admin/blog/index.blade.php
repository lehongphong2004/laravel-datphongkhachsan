@extends('layout.admin')

@section('title', $title ?? 'Quản Lý Blog Du Lịch')

@section('admin_content')
<div class="card shadow-sm border-0">
    <!-- Header -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa fa-blog me-2"></i> Danh sách Bài viết</h5>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-light btn-sm fw-bold">
            <i class="fa fa-plus-circle me-1"></i> Thêm bài viết
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
                        <th>Tiêu đề</th>
                        <th>Tác giả</th>
                        <th>Ngày đăng</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $b)
                        <tr>
                            <td class="fw-semibold">{{ $b->tieu_de }}</td>
                            <td>{{ $b->tac_gia }}</td>
                            <td>{{ $b->created_at ? $b->created_at->format('d/m/Y') : '' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.blog.edit', $b->id) }}" 
                                   class="btn btn-warning btn-sm me-1" data-bs-toggle="tooltip" title="Sửa">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.blog.destroy', $b->id) }}" 
                                      method="POST" class="d-inline" 
                                      onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này?')">
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
                            <td colspan="4" class="text-center text-muted">Chưa có bài viết nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
