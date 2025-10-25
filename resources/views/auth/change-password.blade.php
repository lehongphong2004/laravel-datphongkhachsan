@extends('layout.app')

@section('title', 'Đổi mật khẩu')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Đổi mật khẩu</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.password.change') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Mật khẩu hiện tại:</label>
            <input type="password" name="mat_khau_cu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mật khẩu mới:</label>
            <input type="password" name="mat_khau_moi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Xác nhận mật khẩu mới:</label>
            <input type="password" name="mat_khau_moi_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
    </form>
</div>
@endsection
