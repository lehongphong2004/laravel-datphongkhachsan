<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use App\Models\Phong;
use App\Models\KhachSan;
use App\Models\DatPhong;
use App\Models\UuDai;
use App\Models\BlogDuLich;

class AdminController extends Controller
{
    // -------------------------------
    // DASHBOARD
    // -------------------------------
public function index()
{
    // Tổng số khách sạn
    $soKhachSan = \App\Models\KhachSan::count();

    // Tổng số phòng
    $soPhong = \App\Models\Phong::count();

    // Tổng số đơn đặt phòng
    $soDatPhong = \App\Models\DatPhong::count();

    // Tổng số tài khoản khách hàng
    $soKhachHang = \App\Models\TaiKhoan::where('vai_tro', 'khach_hang')->count();

    // Tổng số ưu đãi
    $soUuDai = \App\Models\UuDai::count();

    // Tổng số blog
    $soBlog = \App\Models\BlogDuLich::count();

    // Doanh thu tháng hiện tại (nếu có cột tong_tien trong bảng dathphong)
    $doanhThuThang = \App\Models\DatPhong::whereMonth('ngay_dat', now()->month)
        ->whereYear('ngay_dat', now()->year)
        ->sum('tong_tien');

    // Doanh thu theo tháng (biểu đồ cột)
    $doanhThuTheoThang = \App\Models\DatPhong::selectRaw('MONTH(ngay_dat) as thang, SUM(tong_tien) as tong')
        ->whereYear('ngay_dat', now()->year)
        ->groupBy('thang')
        ->pluck('tong', 'thang');

   
$tyLeDonTheoKS = \App\Models\DatPhong::query()
    ->join('phong as p', 'datphong.phong_id', '=', 'p.phong_id')
    ->join('khachsan as ks', 'p.khachsan_id', '=', 'ks.khachsan_id')
    ->select('ks.khachsan_id', 'ks.ten_khach_san', DB::raw('COUNT(*) as so_don'))
    ->groupBy('ks.khachsan_id', 'ks.ten_khach_san')
    ->get();


    return view('admin.dashboard', compact(
        'soKhachSan','soPhong','soDatPhong','soKhachHang','soUuDai','soBlog',
        'doanhThuThang','doanhThuTheoThang','tyLeDonTheoKS'
    ));
}




    // -------------------------------
    // QUẢN LÝ KHÁCH HÀNG
    // -------------------------------
    public function quanLyKhachHang()
    {
        $khachhangs = TaiKhoan::where('vai_tro', 'khach_hang')->get();
        return view('admin.khachhang.index', compact('khachhangs'));
    }

    // -------------------------------
    // QUẢN LÝ PHÒNG
    // -------------------------------
    public function quanLyPhong()
    {
        $phongs = Phong::with('khachsan')->get();
        return view('admin.phong.index', compact('phongs'));
    }

    public function luuPhong(Request $request)
    {
        $request->validate([
            'ten_phong' => 'required',
            'gia' => 'required|numeric',
            'khachsan_id' => 'required',
        ]);
        Phong::create($request->all());
        return redirect()->route('admin.phong')->with('success', 'Thêm phòng thành công!');
    }

    public function xoaPhong($id)
    {
        Phong::findOrFail($id)->delete();
        return redirect()->route('admin.phong')->with('success', 'Đã xóa phòng!');
    }

    // -------------------------------
    // QUẢN LÝ KHÁCH SẠN
    // -------------------------------
    public function quanLyKhachSan()
    {
        $khachsans = KhachSan::all();
        return view('admin.khachsan.index', compact('khachsans'));
    }

    public function luuKhachSan(Request $request)
    {
        $request->validate([
            'ten_khach_san' => 'required|string|max:150',
            'dia_chi' => 'required|string|max:255',
        ]);
        KhachSan::create($request->all());
        return redirect()->route('admin.khachsan')->with('success', 'Thêm khách sạn thành công!');
    }

    public function xoaKhachSan($id)
    {
        KhachSan::findOrFail($id)->delete();
        return redirect()->route('admin.khachsan')->with('success', 'Đã xóa khách sạn!');
    }

    // -------------------------------
    // QUẢN LÝ ƯU ĐÃI
    // -------------------------------
    public function quanLyUuDai()
    {
        $uudais = UuDai::with('khachsan')->get();
        return view('admin.uudai.index', compact('uudais'));
    }

    public function luuUuDai(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required',
            'giam_gia' => 'required|numeric',
            'khachsan_id' => 'required',
        ]);
        UuDai::create($request->all());
        return redirect()->route('admin.uudai')->with('success', 'Thêm ưu đãi thành công!');
    }

    public function xoaUuDai($id)
    {
        UuDai::findOrFail($id)->delete();
        return redirect()->route('admin.uudai')->with('success', 'Đã xóa ưu đãi!');
    }

    // -------------------------------
    // QUẢN LÝ BLOG DU LỊCH
    // -------------------------------
    public function quanLyBlog()
    {
        $blogs = BlogDuLich::all();
        return view('admin.blog.index', compact('blogs'));
    }

    public function luuBlog(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required',
            'noi_dung' => 'required',
        ]);
        BlogDuLich::create($request->all());
        return redirect()->route('admin.blog')->with('success', 'Thêm blog thành công!');
    }

    public function suaBlog($id)
    {
        $blog = BlogDuLich::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function capNhatBlog(Request $request, $id)
    {
        $request->validate([
            'tieu_de' => 'required',
            'noi_dung' => 'required',
        ]);
        $blog = BlogDuLich::findOrFail($id);
        $blog->update($request->all());
        return redirect()->route('admin.blog')->with('success','Cập nhật blog thành công!');
    }

    public function xoaBlog($id)
    {
        BlogDuLich::findOrFail($id)->delete();
        return redirect()->route('admin.blog')->with('success', 'Đã xóa blog!');
    }

    // -------------------------------
    // QUẢN LÝ ĐẶT PHÒNG
    // -------------------------------
    public function quanLyDatPhong()
    {
        $datphongs = DatPhong::with(['nguoiDung','phong'])->get();
        return view('admin.datphong.index', compact('datphongs'));
    }

    public function xoaDatPhong($id)
    {
        DatPhong::findOrFail($id)->delete();
        return redirect()->route('admin.donhang.index')->with('success', 'Đã xóa đặt phòng!');
    }

    public function datPhongChoDuyet()
    {
        $datphongs = DatPhong::with(['nguoiDung','phong'])
            ->where('trang_thai', 'cho_xac_nhan')->get();
        return view('admin.donhang.index', compact('datphongs'))
            ->with('title', 'Phòng Mới Đặt (Chờ duyệt)');
    }

    public function datPhongDaDuyet()
    {
        $datphongs = DatPhong::with(['nguoiDung','phong'])
            ->where('trang_thai', 'da_duyet')->get();
        return view('admin.datphong.index', compact('datphongs'))
            ->with('title', 'Xác Nhận Thanh Toán');
    }

    public function datPhongDaHuy()
    {
        $datphongs = DatPhong::with(['nguoiDung','phong'])
            ->where('trang_thai', 'da_huy')->get();
        return view('admin.datphong.index', compact('datphongs'))
            ->with('title', 'Hồ Sơ Đặt Phòng (Đã hủy)');
    }

    public function duyetDatPhong($id)
    {
        $datphong = DatPhong::findOrFail($id);
        if ($datphong->trang_thai != 'cho_xac_nhan') {
            return redirect()->route('admin.donhang.index')->with('error', 'Đơn này đã được xử lý!');
        }
        $datphong->trang_thai = 'da_coc';
        $datphong->save();
        return redirect()->route('admin.donhang.index')->with('success', 'Đơn đặt phòng đã được duyệt (cọc)!');
    }

    public function huyDatPhong($id)
    {
        $datphong = DatPhong::findOrFail($id);
        if ($datphong->trang_thai != 'cho_xac_nhan') {
            return redirect()->route('admin.datphong')->with('error', 'Đơn này đã được xử lý!');
        }
        $datphong->trang_thai = 'huy';
        $datphong->save();
        return redirect()->route('admin.datphong')->with('success', 'Đơn đặt phòng đã bị hủy!');
    }
}
