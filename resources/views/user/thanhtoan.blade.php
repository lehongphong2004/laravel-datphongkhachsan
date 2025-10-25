@extends('layout.app')

@section('title','Thanh toán')

@section('content')
<div class="container my-5">

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center bg-light p-3 rounded shadow-sm">
      <li class="breadcrumb-item text-muted">1. Điền thông tin</li>
      <li class="breadcrumb-item active fw-bold text-primary">2. Thanh toán</li>
      <li class="breadcrumb-item text-muted">3. Hoàn tất</li>
    </ol>
  </nav>

  <div class="row mt-4">
    <!-- Cột trái: Chọn phương thức thanh toán -->
    <div class="col-md-7">
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h5 class="fw-bold mb-3 text-primary"><i class="bi bi-credit-card"></i> Chọn phương thức thanh toán</h5>

          <form id="payment-form" action="{{ route('user.datphong.process') }}" method="POST">
            @csrf
            <input type="hidden" name="phong_id" value="{{ $phong->phong_id }}">
            <input type="hidden" id="ngay_den" name="ngay_den" value="{{ $ngay_den->format('Y-m-d') }}">
            <input type="hidden" id="ngay_di" name="ngay_di" value="{{ $ngay_di->format('Y-m-d') }}">

            <div class="mb-3">
              <select name="payment_method" id="payment_method" class="form-select" required>
                <option value="">-- Chọn phương thức --</option>
                <option value="bank">Chuyển khoản ngân hàng</option>
                <option value="momo">Ví MoMo</option>
              </select>
            </div>

            <!-- QR hiển thị động -->
            <div id="qr-section" style="display:none;" class="text-center mt-3">
              <p class="fw-bold">Quét mã QR để thanh toán</p>
              <img id="qr-image" src="" class="img-fluid mb-2" style="max-width:200px;">
              <div id="qr-text" class="fw-semibold text-primary"></div>
            </div>

            <!-- Thông báo lỗi ngày -->
            <div id="date-error" class="alert alert-danger mt-3" style="display:none;"></div>

            <div class="text-center mt-4">
              <button type="submit" class="btn btn-success btn-lg px-5">
                Xác nhận thanh toán <i class="bi bi-check-circle"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Cột phải: Tóm tắt đặt phòng -->
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold text-primary mb-3"><i class="bi bi-receipt"></i> Thông tin đặt phòng</h5>
          <p><strong>Khách sạn:</strong> {{ $phong->khachSan->ten_khach_san ?? '---' }}</p>
          <p><strong>Phòng:</strong> {{ $phong->ten_phong }}</p>
          <p><strong>Giá:</strong> {{ number_format($phong->gia,0,',','.') }} VND/đêm</p>
          <hr>
          <p><i class="bi bi-calendar-check"></i> Ngày nhận phòng: {{ $ngay_den->format('d/m/Y') }}</p>
          <p><i class="bi bi-calendar-x"></i> Ngày trả phòng: {{ $ngay_di->format('d/m/Y') }}</p>
          <p><i class="bi bi-moon-stars"></i> Số đêm: {{ $so_ngay }}</p>
          <hr>

          @if(isset($uudai) && $uudai)
            <p>Giá gốc: <del>{{ number_format($tong_tien,0,',','.') }} VND</del></p>
            <p class="text-success">Ưu đãi: -{{ $uudai->giam_gia }}%</p>
            <p class="fw-bold text-danger fs-5">
              Tổng sau ưu đãi: {{ number_format($tong_tien_sau_uudai,0,',','.') }} VND
            </p>
          @else
            <p class="fw-bold text-danger fs-5">
              Tổng tiền: {{ number_format($tong_tien,0,',','.') }} VND
            </p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Hiển thị QR theo phương thức
document.getElementById('payment_method').addEventListener('change', function() {
  const qrSection = document.getElementById('qr-section');
  const qrImage = document.getElementById('qr-image');
  const qrText = document.getElementById('qr-text');

  if (this.value === 'bank') {
    qrSection.style.display = 'block';
    const randomCode = 'BANK-' + Math.floor(100000 + Math.random() * 900000);
    qrImage.src = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data='+randomCode;
    qrText.innerText = "Chủ tài khoản: Hotels Go | STK: " + randomCode;
  } else if (this.value === 'momo') {
    qrSection.style.display = 'block';
    const randomCode = 'MOMO-' + Math.floor(100000 + Math.random() * 900000);
    qrImage.src = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data='+randomCode;
    qrText.innerText = "Chủ tài khoản: Hotels Go | SĐT: " + randomCode;
  } else {
    qrSection.style.display = 'none';
  }
});

// Ràng buộc ngày: ngay_den >= hôm nay và ngay_di > ngay_den
document.getElementById('payment-form').addEventListener('submit', function(e) {
  const ngayDenStr = document.getElementById('ngay_den').value;
  const ngayDiStr  = document.getElementById('ngay_di').value;
  const errBox = document.getElementById('date-error');

  const toDate = (s) => {
    const [y,m,d] = s.split('-').map(Number);
    return new Date(y, m-1, d);
  };

  const today = new Date(); today.setHours(0,0,0,0);
  const ngayDen = toDate(ngayDenStr);
  const ngayDi  = toDate(ngayDiStr);

  let errors = [];

  if (ngayDen < today) {
    errors.push('Ngày nhận phòng phải từ hôm nay trở đi.');
  }
  if (ngayDi <= ngayDen) {
    errors.push('Ngày trả phòng phải sau ngày nhận phòng.');
  }

  if (errors.length > 0) {
    e.preventDefault();
    errBox.style.display = 'block';
    errBox.innerHTML = errors.join('<br>');
    errBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
  } else {
    errBox.style.display = 'none';
    errBox.innerHTML = '';
  }
});
</script>
@endsection
