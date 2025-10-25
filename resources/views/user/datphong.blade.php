@extends('layout.app')

@section('title','Đặt phòng')

@section('content')
<div class="container my-5">

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center bg-light p-3 rounded shadow-sm">
      <li class="breadcrumb-item active fw-bold text-primary">1. Điền thông tin</li>
      <li class="breadcrumb-item text-muted">2. Thanh toán</li>
      <li class="breadcrumb-item text-muted">3. Hoàn tất</li>
    </ol>
  </nav>

  <div class="row mt-4">
    <!-- Form bên trái -->
    <div class="col-md-7">
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h5 class="fw-bold mb-3 text-primary"><i class="bi bi-person-lines-fill"></i> Điền thông tin liên hệ</h5>

          <form action="{{ route('user.datphong.payment') }}" method="POST" class="row g-3">
            @csrf
            <input type="hidden" name="phong_id" value="{{ $phong->phong_id }}">

            <div class="col-md-6">
              <label class="form-label">Họ và tên *</label>
              <input type="text" name="ho_ten" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email *</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Số điện thoại *</label>
              <input type="text" name="so_dien_thoai" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Ngày đến</label>
              <input type="date" id="ngay_den" name="ngay_den" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Ngày đi</label>
              <input type="date" id="ngay_di" name="ngay_di" class="form-control" required>
            </div>

            <div class="col-12 text-center mt-4">
              <button type="submit" class="btn btn-primary btn-lg px-5">
                Tiếp tục thanh toán <i class="bi bi-arrow-right-circle"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Tóm tắt bên phải -->
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold text-primary mb-3"><i class="bi bi-receipt"></i> Thông tin đặt phòng</h5>
          <p><strong>Khách sạn:</strong> {{ $phong->khachSan->ten_khach_san ?? '---' }}</p>
          <p><strong>Phòng:</strong> {{ $phong->ten_phong }}</p>
          <p><strong>Giá:</strong> <span id="gia_phong">{{ number_format($phong->gia,0,',','.') }}</span> VND/đêm</p>
          <hr>
          <p><i class="bi bi-calendar-check"></i> Ngày nhận phòng: <span id="summary_ngay_den" class="text-muted">Chưa chọn</span></p>
          <p><i class="bi bi-calendar-x"></i> Ngày trả phòng: <span id="summary_ngay_di" class="text-muted">Chưa chọn</span></p>
          <p><i class="bi bi-moon-stars"></i> Số đêm: <span id="summary_so_dem" class="text-muted">0</span></p>
          <hr>
          <p class="fw-bold text-danger fs-5">Tổng tiền: <span id="summary_tong_tien">0</span> VND</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const giaPhong = {{ $phong->gia }};
  const ngayDenInput = document.getElementById('ngay_den');
  const ngayDiInput = document.getElementById('ngay_di');

  function tinhTien() {
    const ngayDen = new Date(ngayDenInput.value);
    const ngayDi = new Date(ngayDiInput.value);

    if (ngayDen && ngayDi && ngayDi > ngayDen) {
      const soDem = Math.ceil((ngayDi - ngayDen) / (1000 * 60 * 60 * 24));
      const tongTien = soDem * giaPhong;

      document.getElementById('summary_ngay_den').innerText = ngayDen.toLocaleDateString('vi-VN');
      document.getElementById('summary_ngay_di').innerText = ngayDi.toLocaleDateString('vi-VN');
      document.getElementById('summary_so_dem').innerText = soDem;
      document.getElementById('summary_tong_tien').innerText = tongTien.toLocaleString('vi-VN');
    }
  }

  ngayDenInput.addEventListener('change', tinhTien);
  ngayDiInput.addEventListener('change', tinhTien);
</script>
@endsection
