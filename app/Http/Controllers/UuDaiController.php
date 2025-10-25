<?php

namespace App\Http\Controllers;

use App\Models\UuDai;
use App\Models\KhachSan;
use Illuminate\Http\Request;

class UuDaiController extends Controller
{
    // Hiển thị danh sách ưu đãi cho người dùng (frontend)
    public function index()
    {
        $uudais = UuDai::with('khachsan')
            ->whereDate('ngay_bat_dau', '<=', now())
            ->whereDate('ngay_ket_thuc', '>=', now())
            ->get();

        return view('uudai.index', compact('uudais'));
    }

    // Hiển thị danh sách ưu đãi cho admin
    public function adminIndex()
    {
        $uudais = UuDai::with('khachsan')->get();
        return view('admin.uudai.index', compact('uudais'));
    }

    // Form thêm mới
    public function create()
    {
        $khachsans = KhachSan::all();
        return view('admin.uudai.create', compact('khachsans'));
    }

    // Lưu ưu đãi mới
    public function store(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'giam_gia' => 'required|numeric|min:0|max:100',
            'khachsan_id' => 'required|exists:khachsan,khachsan_id',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
        ]);

        UuDai::create($request->all());

        return redirect()->route('admin.uudai.index')->with('success', 'Thêm ưu đãi thành công!');
    }

    // Form sửa
    public function edit($id)
    {
        $uudai = UuDai::findOrFail($id);
        $khachsans = KhachSan::all();
        return view('admin.uudai.edit', compact('uudai', 'khachsans'));
    }

    // Cập nhật
    public function update(Request $request, $id)
    {
        $uudai = UuDai::findOrFail($id);

        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'mo_ta' => 'nullable|string',
            'giam_gia' => 'required|numeric|min:0|max:100',
            'khachsan_id' => 'required|exists:khachsan,khachsan_id',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
        ]);

        $uudai->update($request->all());

        return redirect()->route('admin.uudai.index')->with('success', 'Cập nhật ưu đãi thành công!');
    }

    // Xóa
    public function destroy($id)
    {
        $uudai = UuDai::findOrFail($id);
        $uudai->delete();

        return redirect()->route('admin.uudai.index')->with('success', 'Xóa ưu đãi thành công!');
    }
}
