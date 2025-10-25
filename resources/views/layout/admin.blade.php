<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'HotelGo Admin')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 + FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body { font-family: 'Segoe UI', sans-serif; }
    .sidebar {
      width: 250px;
      min-height: 100vh;
      background: linear-gradient(180deg, #0d6efd, #0a58ca);
    }
    .sidebar .nav-link {
      color: #fff;
      padding: 12px 20px;
      border-radius: 6px;
      margin-bottom: 5px;
      transition: all .3s;
    }
    .sidebar .nav-link:hover, .sidebar .nav-link.active {
      background: rgba(255,255,255,0.2);
      font-weight: 600;
    }
    .content-wrapper {
      flex: 1;
      background: #f8f9fa;
      padding: 20px;
    }
  </style>
</head>
<body>
<div class="d-flex">
  <!-- Sidebar -->
  <aside class="sidebar p-3 text-white">
    <h4 class="fw-bold mb-4">HotelGo Admin</h4>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a href="{{ route('admin.home') }}" class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
          <i class="fas fa-chart-line me-2"></i> Thống Kê
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.khachsan.index') }}" class="nav-link {{ request()->routeIs('admin.khachsan.*') ? 'active' : '' }}">
          <i class="fas fa-hotel me-2"></i> Quản Lý Khách Sạn
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.taikhoan.index') }}" class="nav-link {{ request()->routeIs('admin.taikhoan.*') ? 'active' : '' }}">
          <i class="fas fa-users me-2"></i> Quản Lý Tài Khoản
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.donhang.index') }}" class="nav-link {{ request()->routeIs('admin.donhang.*') ? 'active' : '' }}">
          <i class="fas fa-receipt me-2"></i> Quản Lý Đơn Đặt Phòng
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.blog.index') }}" class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
          <i class="fas fa-blog me-2"></i> Quản Lý Blog Du Lịch
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('admin.uudai.index') }}" class="nav-link {{ request()->routeIs('admin.uudai.*') ? 'active' : '' }}">
          <i class="fas fa-gift me-2"></i> Quản Lý Ưu Đãi
        </a>
      </li>
    </ul>
  </aside>

  <!-- Content -->
  <div class="content-wrapper">
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-light bg-white shadow-sm mb-4 rounded">
      <div class="container-fluid">
        <span class="navbar-brand fw-bold">Bảng điều khiển</span>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              <i class="fas fa-user-circle"></i> Admin
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                  <i class="fa fa-sign-out-alt me-1"></i> Đăng xuất
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Nội dung động -->
    @yield('admin_content')

    <!-- Footer -->
    <footer class="text-center mt-4 text-muted">
      <small>HotelGo &copy; 2025</small>
    </footer>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stack('scripts')
</body>
</html>
