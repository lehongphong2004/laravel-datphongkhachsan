@extends('layout.app')

@section('title', 'Danh sách khách sạn - HotelGo')

@section('content')
<style>
/* Card khách sạn nâng cấp */
.hotel-card {
  border-radius: 12px;
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
  position: relative;
}
.hotel-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}
.hotel-card img {
  height: 200px;
  object-fit: cover;
  transition: transform 0.4s;
}
.hotel-card:hover img {
  transform: scale(1.05);
}
.hotel-card .badge {
  font-size: 0.8rem;
  padding: 6px 10px;
}
.hotel-card .price {
  font-size: 1.1rem;
  font-weight: bold;
  color: #dc3545; /* đỏ nổi bật */
}
.hotel-card .old-price {
  font-size: 0.9rem;
  color: #6c757d;
  text-decoration: line-through;
}
.hotel-card .amenities i {
  margin-right: 6px;
  color: #007bff;
}
</style>

<div class="container my-5">
    <h2 class="fw-bold text-primary text-center mb-4">Danh sách khách sạn</h2>
    <p class="text-muted text-center mb-5">
        Khám phá những khách sạn nổi bật, tiện nghi và giá tốt nhất cho chuyến đi của bạn.
    </p>

    <div class="row">
        @forelse($khachsans as $ks)
            @php
                // Lấy ưu đãi hợp lệ (nếu có)
                $uudai = $ks->uuDais
                    ->where('ngay_bat_dau', '<=', now())
                    ->where('ngay_ket_thuc', '>=', now())
                    ->first();
            @endphp

            <div class="col-md-4 mb-4">
                <div class="card hotel-card h-100 shadow-sm border-0">

                    {{-- Badge khuyến mãi (nếu có ưu đãi) --}}
                    @if($uudai)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                            -{{ $uudai->giam_gia }}%
                        </span>
                    @endif

                    {{-- Ảnh khách sạn --}}
                    @if($ks->hinhAnhs && $ks->hinhAnhs->count() > 0)
                        <img src="{{ asset('storage/'.$ks->hinhAnhs->first()->duong_dan) }}" 
                             class="card-img-top" alt="Ảnh khách sạn">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=Hotel" 
                             class="card-img-top" alt="Ảnh khách sạn">
                    @endif

                    {{-- Thông tin khách sạn --}}
                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-bold text-dark">{{ $ks->ten_khach_san }}</h5>
                        <p class="text-muted mb-1">
                            <i class="bi bi-geo-alt-fill text-danger"></i> {{ $ks->dia_chi }}
                        </p>

                        {{-- Giá: nếu có ưu đãi thì hiển thị giá gốc + giá sau giảm --}}
                        @if(isset($ks->gia_tham_khao))
                            @if($uudai)
                                <p class="old-price">{{ number_format($ks->gia_tham_khao, 0, ',', '.') }} VND</p>
                                <p class="price">
                                    Chỉ từ {{ number_format($ks->gia_tham_khao * (1 - $uudai->giam_gia/100), 0, ',', '.') }} VND/đêm
                                </p>
                            @else
                                <p class="price">
                                    Chỉ từ {{ number_format($ks->gia_tham_khao, 0, ',', '.') }} VND/đêm
                                </p>
                            @endif
                        @endif

                        {{-- Tiện ích (demo cứng) --}}
                        <p class="amenities text-muted mb-3">
                            <i class="bi bi-wifi"></i> WiFi miễn phí · 
                            <i class="bi bi-cup-hot"></i> Buffet sáng · 
                            <i class="bi bi-water"></i> Hồ bơi
                        </p>

                        {{-- Nút CTA --}}
                        <a href="{{ route('user.phong.chitiet', $ks->khachsan_id) }}" 
                           class="btn btn-primary w-100 fw-bold mt-auto">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Hiện chưa có khách sạn nào được hiển thị.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
