@extends('admin.home')

@section('title','Bảng điều khiển')

@section('admin_content')
<div class="container mt-4">
    <!-- Hàng thống kê -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Lượt đặt phòng</h5>
                    <p class="fs-4 fw-bold">{{ $soDatPhong }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Doanh thu tháng</h5>
                    <p class="fs-4 fw-bold text-success">{{ number_format($doanhThuThang) }}đ</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tổng số khách hàng</h5>
                    <p class="fs-4 fw-bold">{{ $soKhachHang }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Doanh thu theo tháng</div>
                <div class="card-body">
                    <canvas id="chartDoanhThu"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Tỷ lệ đơn theo khách sạn</div>
                <div class="card-body">
                    <canvas id="chartTyLe"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Doanh thu theo tháng
    const doanhThuData = @json($doanhThuTheoThang);
    new Chart(document.getElementById('chartDoanhThu'), {
        type: 'bar',
        data: {
            labels: Object.keys(doanhThuData).map(m => 'Tháng ' + m),
            datasets: [{
                label: 'Doanh thu (đ)',
                data: Object.values(doanhThuData),
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        }
    });

    // Tỷ lệ đơn theo khách sạn
 const tyLeLabels = @json($tyLeDonTheoKS->pluck('ten_khach_san'));
const tyLeData   = @json($tyLeDonTheoKS->pluck('so_don'));

    new Chart(document.getElementById('chartTyLe'), {
        type: 'pie',
        data: {
            labels: tyLeLabels,
            datasets: [{
                data: tyLeData,
                backgroundColor: ['#FF6384','#36A2EB','#FFCE56','#4BC0C0','#9966FF','#FF9F40']
            }]
        }
    });
</script>
@endsection
