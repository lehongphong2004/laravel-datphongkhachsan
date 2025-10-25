@extends('layout.admin')

@section('title', $title ?? 'Quản Lý Đơn Đặt Phòng')

@section('admin_content')
<div class="card shadow-sm border-0">
    <!-- Header -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fa fa-receipt me-2"></i> Danh sách Đơn đặt phòng</h5>
    </div>

    <!-- Body -->
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Khách Hàng</th>
                        <th>Khách Sạn / Phòng</th>
                        <th>Ngày Đặt</th>
                        <th>Ngày Đến</th>
                        <th>Ngày Đi</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th class="text-center">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($datphongs as $dp)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dp->nguoiDung->ho_ten ?? 'N/A' }}</td>
                            <td>
                                {{ $dp->phong->ten_phong ?? 'N/A' }}
                                ({{ $dp->phong->khachsan->ten_khach_san ?? '' }})
                            </td>
                            <td>{{ \Carbon\Carbon::parse($dp->ngay_dat)->format('d-m-Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($dp->ngay_den)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($dp->ngay_di)->format('d-m-Y') }}</td>
                            <td>{{ number_format($dp->tong_tien, 0, ',', '.') }} đ</td>
                            <td>
                                @if($dp->trang_thai == 'cho_xac_nhan')
                                    <span class="badge bg-warning">Chờ Duyệt</span>
                                @elseif($dp->trang_thai == 'da_coc')
                                    <span class="badge bg-success">Đã Cọc</span>
                                @elseif($dp->trang_thai == 'da_thanh_toan')
                                    <span class="badge bg-primary">Đã Thanh Toán</span>
                                @elseif($dp->trang_thai == 'huy')
                                    <span class="badge bg-danger">Đã Hủy</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($dp->trang_thai == 'cho_xac_nhan')
                                    <a href="{{ route('admin.datphong.duyet', $dp->datphong_id) }}" 
                                       class="btn btn-success btn-sm me-1" data-bs-toggle="tooltip" title="Duyệt">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <a href="{{ route('admin.datphong.huy', $dp->datphong_id) }}" 
                                       class="btn btn-danger btn-sm me-1" data-bs-toggle="tooltip" title="Hủy">
                                        <i class="fa fa-times"></i>
                                    </a>
                                @elseif($dp->trang_thai == 'da_coc')
                                    <span class="text-success">Đã Cọc</span>
                                @elseif($dp->trang_thai == 'da_thanh_toan')
                                    <span class="text-primary">Đã Thanh Toán</span>
                                @elseif($dp->trang_thai == 'huy')
                                    <span class="text-danger">Đã Hủy</span>
                                @endif

                                <!-- Nút xóa -->
                                <a href="{{ route('admin.datphong.xoa', $dp->datphong_id) }}" 
                                   class="btn btn-outline-danger btn-sm mt-1" data-bs-toggle="tooltip" title="Xóa">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Chưa có đơn đặt phòng nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
