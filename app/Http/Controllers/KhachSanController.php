<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachSan;
use App\Models\HinhAnhKhachSan;
use Illuminate\Support\Facades\Storage;

class KhachSanController extends Controller
{
    // --- DANH SÁCH KHÁCH SẠN (Public)
    public function index(Request $request)
        {
             $query = KhachSan::where('trang_thai', 'hoat_dong');

    if ($request->filled('keyword')) {
        $keyword = trim($request->keyword);

        $query->where(function ($q) use ($keyword) {
            $q->where('ten_khach_san', 'LIKE', "%{$keyword}%")
              ->orWhere('dia_chi', 'LIKE', "%{$keyword}%");
        });
    }

    $khachsans = $query->with('hinhAnhs')
                       ->paginate(9)
                       ->appends($request->query());

    return view('user.hotels', compact('khachsans'));
}

    // Hiển thị chi tiết khách sạn cho admin (danh sách phòng)
    public function chiTietAdmin($id)
    {
        $khachsan = KhachSan::with('phongs')->findOrFail($id);
        return view('admin.khachsan_chitiet', compact('khachsan'));
    }

    public function rating()
    {
    // Lấy 4 khách sạn có số sao (xep_hang) cao nhất
    $popularHotels = KhachSan::with('hinhAnhs')
        ->orderByDesc('xep_hang')
        ->take(4)
        ->get();

    return view('welcome', compact('popularHotels'));
    }


    // --- CHI TIẾT KHÁCH SẠN (Public)
    public function chiTiet($id)
    {
        $ks = KhachSan::with(['phongs', 'hinhAnhs'])->findOrFail($id);
        return view('user.phong_chitiet', compact('ks'));
    }

    // --- DANH SÁCH KHÁCH SẠN (Admin)
    public function adminIndex()
    {
        $khachsans = KhachSan::with('hinhAnhs')->get();
        return view('admin.index', compact('khachsans'));
    }

    // --- FORM THÊM MỚI
    public function create()
    {
        return view('admin.create');
    }

    // --- LƯU KHÁCH SẠN MỚI
    public function store(Request $request)
{
    $validated = $request->validate([
        'ten_khach_san' => 'required|string|max:255',
        'dia_chi' => 'required|string',
        'mo_ta' => 'nullable|string',
        'xep_hang' => 'nullable|integer|min:1|max:5',
        'trang_thai' => 'required|string',
        'hinh_anh' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120', // 2MB
    ]);

    $khachsan = KhachSan::create([
        'ten_khach_san' => $validated['ten_khach_san'],
        'dia_chi' => $validated['dia_chi'],
        'mo_ta' => $validated['mo_ta'] ?? null,
        'xep_hang' => $validated['xep_hang'] ?? 3,
        'trang_thai' => $validated['trang_thai'],
    ]);

    // Lưu hình ảnh nếu có
    if ($request->hasFile('hinh_anh')) {
        $file = $request->file('hinh_anh');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads/khachsan', $fileName, 'public');

        HinhAnhKhachSan::create([
            'khachsan_id' => $khachsan->khachsan_id,
            'duong_dan' => $path
        ]);
    }

    return redirect()->route('admin.khachsan.index')->with('success', 'Thêm khách sạn thành công!');
}



    // --- FORM SỬA
    public function edit($id)
    {
        $khachsan = KhachSan::with('hinhAnhs')->findOrFail($id);
        return view('admin.edit', compact('khachsan'));
    }

    // --- CẬP NHẬT
    public function update(Request $request, $id)
{
    $khachsan = KhachSan::with('hinhAnhs')->findOrFail($id);

    $validated = $request->validate([
        'ten_khach_san' => 'required|string|max:255',
        'dia_chi' => 'required|string',
        'mo_ta' => 'nullable|string',
        'xep_hang' => 'nullable|integer|min:1|max:5',
        'trang_thai' => 'required|string',
        'hinh_anh' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120'
    ]);

    // Cập nhật thông tin chung
    $khachsan->update([
        'ten_khach_san' => $validated['ten_khach_san'],
        'dia_chi' => $validated['dia_chi'],
        'mo_ta' => $validated['mo_ta'] ?? null,
        'xep_hang' => $validated['xep_hang'] ?? 3,
        'trang_thai' => $validated['trang_thai'],
    ]);

    // Nếu có upload ảnh mới
    if ($request->hasFile('hinh_anh')) {
        // Xóa ảnh cũ (nếu có)
        if ($khachsan->hinhAnhs && $khachsan->hinhAnhs->count() > 0) {
            foreach ($khachsan->hinhAnhs as $anh) {
                if (Storage::disk('public')->exists($anh->duong_dan)) {
                    Storage::disk('public')->delete($anh->duong_dan);
                }
                $anh->delete();
            }
        }

        // Lưu ảnh mới
        $file = $request->file('hinh_anh');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads/khachsan', $fileName, 'public');

        HinhAnhKhachSan::create([
            'khachsan_id' => $khachsan->khachsan_id,
            'duong_dan' => $path
        ]);
    }

    return redirect()->route('admin.khachsan.index')->with('success', 'Cập nhật khách sạn thành công!');
}


    // --- XÓA KHÁCH SẠN
    public function destroy($id)
    {
        $khachsan = KhachSan::with('hinhAnhs')->findOrFail($id);

        foreach ($khachsan->hinhAnhs as $anh) {
            if (Storage::disk('public')->exists($anh->duong_dan)) {
                Storage::disk('public')->delete($anh->duong_dan);
            }
            $anh->delete();
        }

        $khachsan->delete();

        return redirect()->route('admin.khachsan.index')->with('success', 'Đã xóa khách sạn thành công!');
    }
}
