@extends('layout.app')

@section('title', $ks->ten_khach_san)

@section('content')
<div class="container mt-4">

    <!-- Thông tin khách sạn -->
    <h2 class="fw-bold text-primary">{{ $ks->ten_khach_san }}</h2>
    <p class="text-muted"><i class="bi bi-geo-alt-fill"></i> {{ $ks->dia_chi }}</p>
    <p>{{ $ks->mo_ta ?? 'Khách sạn tiện nghi, vị trí thuận lợi cho chuyến đi của bạn.' }}</p>

    <hr>

    <!-- Danh sách phòng -->
    <h4 class="fw-bold mb-3">Danh sách phòng</h4>
    <div class="row">
        @forelse($ks->phongs as $phong)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if(!empty($phong->hinh_anh))
                        <img src="{{ asset('storage/'.$phong->hinh_anh) }}" class="card-img-top" alt="Ảnh phòng">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=Room" class="card-img-top" alt="Ảnh phòng">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $phong->ten_phong }}</h5>
                        <p class="card-text">{{ $phong->loai_phong }} - {{ $phong->so_nguoi }} người</p>
                        <p class="fw-bold text-primary">{{ number_format($phong->gia,0,',','.') }}đ/đêm</p>
                        <a href="{{ url('/user/datphong/'.$phong->phong_id) }}" class="btn btn-primary w-100">Đặt ngay</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Hiện chưa có phòng nào.</p>
        @endforelse
    </div>
</div>
@endsection
