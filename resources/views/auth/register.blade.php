@extends('layout.app')

@section('title', 'Đăng ký')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #e6f2ff, #cce0ff);
        font-family: 'Segoe UI', sans-serif;
    }
    .auth-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        color: #333;
    }
    .auth-card h3 {
        color: #007BFF;
        font-weight: bold;
    }
    .auth-input {
        border: 1px solid #ddd;
    }
    .auth-input:focus {
        border-color: #4da6ff;
        box-shadow: 0 0 6px rgba(77,166,255,0.5);
    }
    .auth-btn {
        background: #4da6ff;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        border: none;
        transition: 0.3s;
    }
    .auth-btn:hover {
        background: #007BFF;
    }
</style>

<div class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card auth-card p-4" style="width: 420px;">
        <div class="card-header text-center border-0 bg-transparent">
            <h3 class="fw-bold">Đăng ký tài khoản</h3>
            <p class="small text-muted">Trải nghiệm dịch vụ đặt phòng khách sạn</p>
        </div>

        <div class="card-body px-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/register') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Họ tên</label>
                    <input type="text" name="ho_ten" class="form-control auth-input"
                           placeholder="Nhập họ và tên" value="{{ old('ho_ten') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên đăng nhập</label>
                    <input type="text" name="ten_dang_nhap" class="form-control auth-input"
                           placeholder="Nhập tên đăng nhập" value="{{ old('ten_dang_nhap') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control auth-input"
                           placeholder="Nhập email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="so_dien_thoai" class="form-control auth-input"
                           placeholder="Nhập số điện thoại" value="{{ old('so_dien_thoai') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" name="mat_khau" class="form-control auth-input"
                           placeholder="Nhập mật khẩu" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" name="mat_khau_confirmation" class="form-control auth-input"
                           placeholder="Nhập lại mật khẩu" required>
                </div>

                <button type="submit" class="btn auth-btn w-100 py-2">Đăng ký</button>
            </form>
        </div>

        <div class="card-footer text-center border-0 bg-transparent">
            <small>Đã có tài khoản?
                <a href="{{ url('/login') }}" style="color:#007BFF; font-weight:600;">Đăng nhập</a>
            </small>
        </div>
    </div>
</div>
@endsection
