<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatPhong;
use App\Models\Phong;
use App\Models\UuDai;
use Carbon\Carbon;

class DatPhongController extends Controller
{
    // Bước 1: hiển thị form đặt phòng
    public function show($phong_id)
    {
        $phong = Phong::findOrFail($phong_id);
        return view('user.datphong', compact('phong'));
    }

    // Bước 2: nhận dữ liệu từ form, hiển thị trang thanh toán
    public function payment(Request $request)
    {
        $request->validate([
            'phong_id' => 'required|integer',
            'ngay_den' => 'required|date',
            'ngay_di' => 'required|date|after:ngay_den',
        ]);

        $phong = Phong::findOrFail($request->phong_id);
        $ngay_den = Carbon::parse($request->ngay_den);
        $ngay_di = Carbon::parse($request->ngay_di);
        $so_ngay = $ngay_di->diffInDays($ngay_den);
        $tong_tien = $phong->gia * $so_ngay;

        // 🔹 Kiểm tra ưu đãi theo khách sạn
        $uudai = UuDai::where('khachsan_id', $phong->khachsan_id)
            ->whereDate('ngay_bat_dau', '<=', now())
            ->whereDate('ngay_ket_thuc', '>=', now())
            ->first();

        $tong_tien_sau_uudai = $tong_tien;
        if ($uudai) {
            $tong_tien_sau_uudai = $tong_tien - ($tong_tien * ($uudai->giam_gia / 100));
        }

        return view('user.thanhtoan', compact(
            'phong','ngay_den','ngay_di','so_ngay','tong_tien','uudai','tong_tien_sau_uudai'
        ));
    }

    // Bước 3: xử lý thanh toán, lưu DB
    public function processPayment(Request $request)
    {
        $request->validate([
            'phong_id' => 'required|integer',
            'ngay_den' => 'required|date',
            'ngay_di' => 'required|date|after:ngay_den',
            'payment_method' => 'required|string',
        ]);

        $phong = Phong::findOrFail($request->phong_id);
        $ngay_den = Carbon::parse($request->ngay_den);
        $ngay_di = Carbon::parse($request->ngay_di);
        $so_ngay = $ngay_di->diffInDays($ngay_den);
        $tong_tien = $phong->gia * $so_ngay;

        // 🔹 Áp dụng ưu đãi
        $uudai = UuDai::where('khachsan_id', $phong->khachsan_id)
            ->whereDate('ngay_bat_dau', '<=', now())
            ->whereDate('ngay_ket_thuc', '>=', now())
            ->first();

        if ($uudai) {
            $tong_tien = $tong_tien - ($tong_tien * ($uudai->giam_gia / 100));
        }

        DatPhong::create([
            'nguoidung_id' => session('taikhoan_id'),
            'phong_id' => $request->phong_id,
            'ngay_dat' => date('Y-m-d'),
            'ngay_den' => $ngay_den->format('Y-m-d'),
            'ngay_di' => $ngay_di->format('Y-m-d'),
            'tong_tien' => $tong_tien,
            'trang_thai' => 'cho_xac_nhan',
            'phuong_thuc_thanh_toan' => $request->payment_method,
        ]);

        return redirect()->route('user.lichsu')->with('success','Đặt phòng thành công!');
    }

    // Lịch sử đặt phòng
    public function lichSu()
    {
        $nguoidung_id = session('taikhoan_id');
        $datphongs = DatPhong::with('phong','phong.khachSan')
            ->where('nguoidung_id',$nguoidung_id)
            ->get();

        return view('user.lichsu', compact('datphongs'));
    }
}
?>
