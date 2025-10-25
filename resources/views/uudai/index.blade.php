@extends('layout.app')

@section('content')
<div class="container my-5">
  <h2 class="fw-bold text-center text-primary mb-5">
    <i class="bi bi-gift-fill"></i> Ưu Đãi Khách Sạn
  </h2>

  <div class="row g-4">
    @forelse($uudais as $uudai)
      <div class="col-md-4">
        <div class="card h-100 shadow-lg border-0 rounded-4 overflow-hidden hover-card">
          <div class="card-body d-flex flex-column p-4 text-center">
            
            <!-- Tiêu đề ưu đãi -->
            <h5 class="fw-bold text-dark mb-2">
              {{ $uudai->tieu_de }}
            </h5>

            <!-- Tên khách sạn -->
            <p class="text-muted mb-3">
              <i class="bi bi-building"></i> {{ $uudai->khachsan->ten_khach_san }}
            </p>

            <!-- % giảm giá -->
            <div class="mb-3">
              <span class="badge bg-danger fs-5 px-3 py-2 shadow-sm">
                -{{ number_format($uudai->giam_gia, 0) }}%
              </span>
            </div>

            <!-- Thời gian áp dụng -->
            <p class="small text-secondary">
              <i class="bi bi-calendar-event"></i>
              {{ \Carbon\Carbon::parse($uudai->ngay_bat_dau)->format('d/m/Y') }}
              &nbsp;→&nbsp;
              {{ \Carbon\Carbon::parse($uudai->ngay_ket_thuc)->format('d/m/Y') }}
            </p>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center text-muted">Hiện chưa có ưu đãi nào.</p>
    @endforelse
  </div>
</div>

<!-- CSS tùy chỉnh -->
<style>
  .hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  }
</style>
@endsection
