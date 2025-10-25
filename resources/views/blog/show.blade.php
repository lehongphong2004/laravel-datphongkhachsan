@extends('layout.app')

@section('title',$blog->tieu_de)

@section('content')
<div class="container my-5">

  <!-- Banner tiêu đề -->
  <div class="p-5 mb-4 bg-primary text-white rounded shadow-sm text-center">
    <h1 class="fw-bold">{{ $blog->tieu_de }}</h1>
    <p class="mb-0">
      <i class="bi bi-person"></i> {{ $blog->tac_gia ?? 'Hotels Go' }} &nbsp; | &nbsp;
      <i class="bi bi-calendar"></i> {{ $blog->created_at->format('d/m/Y') }}
    </p>
  </div>

  <div class="row">
    <!-- Nội dung chính -->
    <div class="col-lg-8">
      <img src="{{ $blog->hinh_anh ? asset('storage/'.$blog->hinh_anh) : 'https://via.placeholder.com/800x400?text=Blog' }}" 
           class="img-fluid rounded mb-4 shadow-sm w-100" alt="{{ $blog->tieu_de }}">

      <div class="blog-content fs-5 lh-lg">
        {!! nl2br(e($blog->noi_dung)) !!}
      </div>

      <a href="{{ route('user.blog.index') }}" class="btn btn-outline-primary mt-4">
        <i class="bi bi-arrow-left"></i> Quay lại Blog
      </a>
    </div>

    <!-- Sidebar: Bài viết mới nhất -->
    <div class="col-lg-4">
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h5 class="fw-bold text-primary mb-3"><i class="bi bi-stars"></i> Bài viết mới nhất</h5>
          <ul class="list-unstyled">
            @foreach(\App\Models\BlogDuLich::latest()->take(5)->get() as $newBlog)
              <li class="mb-3">
                <a href="{{ route('user.blog.show',$newBlog->id) }}" class="text-decoration-none">
                  <i class="bi bi-chevron-right"></i> {{ Str::limit($newBlog->tieu_de, 40) }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- CSS -->
<style>
.blog-content {
  text-align: justify;
  line-height: 1.8;
}
.blog-content p {
  margin-bottom: 1rem;
}
</style>
@endsection
