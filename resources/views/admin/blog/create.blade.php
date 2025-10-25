@extends('layout.admin')

@section('title','Thêm Blog Du Lịch')

@section('admin_content')
<div class="card shadow-sm border-0">
  <div class="card-header bg-primary text-white">
    <h5 class="mb-0"><i class="fa fa-plus-circle me-2"></i> Thêm bài viết mới</h5>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label">Tiêu đề</label>
        <input type="text" name="tieu_de" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Ảnh đại diện</label>
        <input type="file" name="anh_dai_dien" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Nội dung</label>
        <textarea name="noi_dung" class="form-control" rows="6" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Tác giả</label>
        <input type="text" name="tac_gia" class="form-control">
      </div>

      <button type="submit" class="btn btn-success">
        <i class="fa fa-save me-1"></i> Lưu
      </button>
      <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left me-1"></i> Quay lại
      </a>
    </form>
  </div>
</div>
@endsection
