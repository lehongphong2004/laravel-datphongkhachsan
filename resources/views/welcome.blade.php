@extends('layout.app')

@section('title', 'Trang chủ - HotelGo')

@section('content')
<style>
   .search-banner {
    background: url('/images/background.jpg') center/cover no-repeat;
    color: #fff;
    padding: 80px 20px; /* tăng padding cho thoáng */
    border-radius: 12px;
    margin-bottom: 40px;
    position: relative;
}
.search-banner::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45); /* lớp phủ mờ */
    border-radius: 12px;
}
.search-banner h2,
.search-banner form {
    position: relative;
    z-index: 1;
}
.banner-img {
  max-height: 300px;   /* giới hạn chiều cao tối đa */
  object-fit: cover;   /* cắt ảnh cho vừa khung, không bị méo */
}

.section-title {
    font-weight: bold;
    color: #007BFF;
    margin-bottom: 20px;
}
.destination-card, .hotel-card {
    border-radius: 12px;
    overflow: hidden;
    transition: 0.3s;
}
.destination-card:hover, .hotel-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}
.destination-card img, .hotel-card img {
    height: 180px;
    object-fit: cover;
    width: 100%;
}
.rating-badge {
    background: #007BFF;
    color: #fff;
    padding: 3px 8px;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: bold;
}
.price {
    color: #007BFF;
    font-weight: bold;
}
</style>

<div class="container mt-4">

    <!-- Thanh tìm kiếm -->
    <div class="search-banner text-center">
        <h2 class="fw-bold">Tìm khách sạn, đặt dễ dàng!</h2>
        <form method="GET" action="{{ route('user.search') }}" class="row g-2 mt-3 justify-content-center">
            <div class="col-md-3">
                <input type="text" name="keyword" class="form-control"
                       placeholder="Điểm đến hoặc khách sạn..." value="{{ request('keyword') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="ngay_den" class="form-control"
                       min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-2">
                <input type="date" name="ngay_di" class="form-control"
                       min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="col-md-2">
                <select name="so_khach" class="form-select">
                    <option value="1">1 khách</option>
                    <option value="2">2 khách</option>
                    <option value="3">3 khách</option>
                    <option value="4">4 khách</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="so_phong" class="form-select">
                    <option value="1">1 phòng</option>
                    <option value="2">2 phòng</option>
                    <option value="3">3 phòng</option>
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-light w-100 fw-bold">Tìm</button>
            </div>
        </form>
    </div>

    @php
        $destinations = [
            ['name' => 'Hồ Chí Minh', 'image' => 'images/hochiminh.jpg'],
            ['name' => 'Đà Nẵng', 'image' => 'images/danang.jpg'],
            ['name' => 'Hà Nội', 'image' => 'images/hanoi.jpg'],
            ['name' => 'Nha Trang', 'image' => 'images/nhatrang.jpg'],
            ['name' => 'Quảng Ninh', 'image' => 'images/quangninh.jpg'],
            ['name' => 'Lâm Đồng', 'image' => 'images/lamdong.jpg'],
            ['name' => 'Kiên Giang', 'image' => 'images/kienggiang.jpg'],
            ['name' => 'Thừa Thiên Huế', 'image' => 'images/hue.jpg'],
        ];
    @endphp

    <!-- Điểm đến phổ biến -->
    <h3 class="section-title">Điểm đến phổ biến</h3>
    <div class="row mb-5">
        @foreach($destinations as $city)
            <div class="col-md-3 mb-4">
                <a href="{{ route('user.search', ['keyword' => $city['name']]) }}" class="text-decoration-none text-dark">
                    <div class="card destination-card shadow-sm border-0">
                        <img src="{{ asset($city['image']) }}"
                             alt="{{ $city['name'] }}" class="card-img-top" style="height:200px; object-fit:cover;">
                        <div class="card-body text-center">
                            <h5 class="fw-bold">{{ $city['name'] }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Banner trang trí -->
    <div class="my-5">
        <img src="/images/banner.jpg" alt="HotelGo Banner" class="img-fluid w-100 rounded shadow banner-img">
    </div>

    <!-- Khách sạn phổ biến -->
    <h3 class="section-title">Khách Sạn Phổ Biến Cho Quý Khách</h3>
    <div class="row mb-5">
        @foreach($popularHotels as $hotel)
            <div class="col-md-3 mb-4">
                <a href="{{ route('user.phong.chitiet', $hotel->khachsan_id) }}" class="text-decoration-none text-dark">
                    <div class="card hotel-card shadow-sm border-0">
                        @if($hotel->hinhAnhs->count() > 0)
                            <img src="{{ asset('storage/'.$hotel->hinhAnhs->first()->duong_dan) }}"
                                 alt="{{ $hotel->ten_khach_san }}">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=Hotel" alt="{{ $hotel->ten_khach_san }}">
                        @endif
                        <div class="card-body">
                            <h5>{{ $hotel->ten_khach_san }}</h5>
                            <span class="rating-badge">{{ $hotel->xep_hang }} ★</span>
                            <p class="text-muted">{{ $hotel->dia_chi }}</p>
                            <p class="price">{{ number_format($hotel->gia_trung_binh) }}đ / đêm</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    @php
        $worldCities = [
            ['city' => 'Paris', 'country' => 'Pháp', 'price' => 25000000, 'image' => 'images/paris.jpg'],
            ['city' => 'New York', 'country' => 'Mỹ', 'price' => 30000000, 'image' => 'images/newyork.jpg'],
            ['city' => 'Tokyo', 'country' => 'Nhật Bản', 'price' => 18000000, 'image' => 'images/tokyo.jpg'],
            ['city' => 'London', 'country' => 'Anh', 'price' => 28000000, 'image' => 'images/london.jpg'],
            ['city' => 'Rome', 'country' => 'Ý', 'price' => 27000000, 'image' => 'images/rome.jpg'],
            ['city' => 'Bangkok', 'country' => 'Thái Lan', 'price' => 6000000, 'image' => 'images/bangkok.jpg'],
            ['city' => 'Dubai', 'country' => 'UAE', 'price' => 19456000, 'image' => 'images/dubai.jpg'],
            ['city' => 'Barcelona', 'country' => 'Tây Ban Nha', 'price' => 22000000, 'image' => 'images/barcelona.jpg'],
        ];
    @endphp

    <!-- Thành phố nổi tiếng thế giới -->
    <h3 class="section-title">Các thành phố nổi tiếng trên thế giới</h3>
    <div class="row mb-5">
        @foreach($worldCities as $dest)
            <div class="col-md-3 mb-4">
                <a href="{{ route('user.search', ['keyword' => $dest['city']]) }}" class="text-decoration-none text-dark">
                    <div class="card destination-card shadow-sm border-0">
                        <img src="{{ asset($dest['image']) }}"
                             alt="{{ $dest['city'] }}"
                             class="card-img-top"
                             style="height:200px; object-fit:cover;">
                        <div class="card-body text-center">
                            <h6 class="fw-bold">{{ $dest['city'] }}</h6>
                            <p class="text-muted">{{ $dest['country'] }}</p>
                            <p class="price text-danger fw-bold">Chỉ từ {{ number_format($dest['price'], 0, ',', '.') }}đ</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

</div>
@endsection
