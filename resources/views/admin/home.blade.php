@extends('layout.admin')

@section('title', 'Trang Quản Trị - Home')

@section('admin_content')
<div class="container-fluid">
  <h3 class="mb-4">📊 Dashboard</h3>

  <!-- Cards thống kê -->
  <div class="row">
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0 mb-4">
        <div class="card-body">
          <h6>Lượt đặt phòng</h6>
          <h3 class="text-primary">{{ $stats['orders'] ?? 0 }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0 mb-4">
        <div class="card-body">
          <h6>Doanh thu tháng</h6>
          <h3 class="text-success">{{ number_format($stats['revenue'] ?? 0) }}đ</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0 mb-4">
        <div class="card-body">
          <h6>Khách hàng mới</h6>
          <h3 class="text-info">{{ $stats['new_users'] ?? 0 }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card text-center shadow-sm border-0 mb-4">
        <div class="card-body">
          <h6>Điểm TB</h6>
          <h3 class="text-warning">{{ number_format($stats['avg_rating'] ?? 0, 1) }}</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Biểu đồ -->
  <div class="row">
    <div class="col-md-7">
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-header fw-bold">Doanh thu theo tháng</div>
        <div class="card-body">
          <canvas id="revenueChart" height="120"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-header fw-bold">Tỷ lệ đơn theo khách sạn</div>
        <div class="card-body">
          <canvas id="ordersPie" height="120"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  const revenueLabels = {!! json_encode($charts['revenue_months'] ?? []) !!};
  const revenueData   = {!! json_encode($charts['revenue_values'] ?? []) !!};
  const pieLabels     = {!! json_encode($charts['orders_by_hotel_labels'] ?? []) !!};
  const pieData       = {!! json_encode($charts['orders_by_hotel_values'] ?? []) !!};

  new Chart(document.getElementById('revenueChart'), {
    type: 'line',
    data: {
      labels: revenueLabels,
      datasets: [{
        label: 'Doanh thu (đ)',
        data: revenueData,
        borderColor: '#0d6efd',
        backgroundColor: 'rgba(13,110,253,0.15)',
        fill: true,
        tension: .3
      }]
    }
  });

  new Chart(document.getElementById('ordersPie'), {
    type: 'doughnut',
    data: {
      labels: pieLabels,
      datasets: [{
        data: pieData,
        backgroundColor: ['#0d6efd','#20c997','#ffc107','#dc3545','#6f42c1','#0dcaf0']
      }]
    }
  });
</script>
@endpush
@endsection
