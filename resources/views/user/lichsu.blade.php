@extends('layout.app')

@section('title','Hoàn tất đặt phòng')

@section('content')
<div class="container my-5">

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center bg-light p-3 rounded shadow-sm">
      <li class="breadcrumb-item text-muted">1. Điền thông tin</li>
      <li class="breadcrumb-item text-muted">2. Thanh toán</li>
      <li class="breadcrumb-item active fw-bold text-primary">3. Hoàn tất</li>
    </ol>
  </nav>

  <!-- Thông báo thành công -->
  <div class="text-center my-4">
    <div class="alert alert-success shadow-sm p-4 rounded">
      <h3 class="fw-bold text-success"><i class="bi bi-check-circle-fill"></i> Đặt phòng thành công!</h3>
      <p class="mb-0">Cảm ơn bạn đã tin tưởng <strong>Hotels Go</strong>. Đơn đặt phòng của bạn đang chờ xác nhận.</p>
    </div>
  </div>

  <!-- Lịch sử đặt phòng -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="fw-bold text-primary mb-3"><i class="bi bi-clock-history"></i> Lịch sử đặt phòng</h5>
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
          <thead class="table-primary">
            <tr>
              <th>Khách sạn</th>
              <th>Phòng</th>
              <th>Ngày đến</th>
              <th>Ngày đi</th>
              <th>Tổng tiền</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            @foreach($datphongs as $d)
              <tr>
                <td>{{ $d->phong->khachSan->ten_khach_san }}</td>
                <td>{{ $d->phong->ten_phong }}</td>
                <td>{{ \Carbon\Carbon::parse($d->ngay_den)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($d->ngay_di)->format('d/m/Y') }}</td>
                <td class="fw-bold text-success">{{ number_format($d->tong_tien,0,',','.') }} đ</td>
                <td>
                  @if($d->trang_thai === 'Đã xác nhận')
                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> {{ $d->trang_thai }}</span>
                  @elseif($d->trang_thai === 'Chờ xác nhận' || $d->trang_thai === 'cho_xac_nhan')
                    <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> Chờ xác nhận</span>
                  @elseif($d->trang_thai === 'Đã hủy')
                    <span class="badge bg-danger"><i class="bi bi-x-circle"></i> {{ $d->trang_thai }}</span>
                  @else
                    <span class="badge bg-secondary"><i class="bi bi-question-circle"></i> {{ $d->trang_thai }}</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="text-center mt-4">
        <a href="{{ route('landing') }}" class="btn btn-outline-primary me-2">
          <i class="bi bi-house-door"></i> Quay lại Trang chủ
        </a>
        <a href="{{ route('user.hotels') }}" class="btn btn-primary">
          <i class="bi bi-plus-circle"></i> Đặt phòng khác
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
