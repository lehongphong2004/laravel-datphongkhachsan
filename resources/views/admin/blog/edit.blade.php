@extends('layout.admin')

@section('title','Sửa Bài Viết')

@section('admin_content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fa fa-edit me-2"></i> Sửa Bài Viết</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="tieu_de" class="form-control" value="{{ $blog->tieu_de }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Tác giả</label>
                <input type="text" name="tac_gia" class="form-control" value="{{ $blog->tac_gia }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea name="noi_dung" class="form-control" rows="5">{{ $blog->noi_dung }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection
