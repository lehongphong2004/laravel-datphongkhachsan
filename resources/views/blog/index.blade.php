@extends('layout.app')

@section('title','Blog Du Lịch')

@section('content')
<div class="container my-5">

  <!-- Banner -->
  <div class="blog-banner text-center text-white d-flex align-items-center justify-content-center">
    <div>
      <h1 class="fw-bold"><i class="bi bi-journal-text"></i> Blog Du Lịch</h1>
      <p class="lead">Khám phá kinh nghiệm, review và điểm đến hấp dẫn cho chuyến đi của bạn</p>
    </div>
  </div>

  <!-- Danh sách bài viết -->
  <div class="row">
    @foreach($blogs as $blog)
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="position-relative">
            <img src="{{ $blog->hinh_anh ? asset('storage/'.$blog->hinh_anh) : 'https://via.placeholder.com/400x250?text=Blog' }}" 
                 class="card-img-top rounded-top" alt="{{ $blog->tieu_de }}">
            <span class="badge bg-primary position-absolute top-0 start-0 m-2">Mới</span>
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-bold">{{ $blog->tieu_de }}</h5>
            <p class="card-text text-muted small mb-2">
              <i class="bi bi-person"></i> {{ $blog->tac_gia ?? 'Hotels Go' }} | 
              <i class="bi bi-calendar"></i> {{ $blog->created_at->format('d/m/Y') }}
            </p>
            <p class="card-text text-muted">{{ Str::limit(strip_tags($blog->noi_dung), 100) }}</p>
            <a href="{{ route('user.blog.show',$blog->id) }}" class="btn btn-outline-primary mt-auto">
              Đọc tiếp <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Phân trang -->
  <div class="d-flex justify-content-center mt-4">
    {{ $blogs->links() }}
  </div>
</div>

<!-- CSS -->
<style>
.blog-banner {
  background: url('/images/blogdulich.jpg') no-repeat center center;
  background-size: cover;
  height: 300px;
  border-radius: 12px;
  margin-bottom: 40px;
  position: relative;
}
.blog-banner::after {
  content: "";
  position: absolute;
  top:0; left:0; right:0; bottom:0;
  background: rgba(0,0,0,0.4);
  border-radius: 12px;
}
.blog-banner > div {
  position: relative;
  z-index: 2;
}
.card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border-radius: 12px;
  overflow: hidden;
}
.card img {
  height: 200px;
  object-fit: cover;
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.card-title {
  font-size: 1.1rem;
  min-height: 48px;
}
.card .btn {
  border-radius: 20px;
}
</style>
@endsection
