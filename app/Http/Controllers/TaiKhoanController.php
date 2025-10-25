<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaiKhoan;

class TaiKhoanController extends Controller
{
    // Hiển thị danh sách tài khoản
    public function index()
    {
        $taikhoans = TaiKhoan::all();
        return view('admin.taikhoan.index', compact('taikhoans'));
    }

    // Form tạo tài khoản mới
    public function create()
    {
        return view('admin.taikhoan.create');
    }

    // Lưu tài khoản mới
    public function store(Request $request)
    {
        $request->validate([
            'ten_dang_nhap' => 'required|string|max:150|unique:taikhoan,ten_dang_nhap',
            'mat_khau' => 'required|min:6',
            'vai_tro' => 'required',
        ]);

        $data = $request->only(['ten_dang_nhap', 'vai_tro']);
        $data['mat_khau'] = bcrypt($request->mat_khau);

        TaiKhoan::create($data);

        return redirect()->route('admin.taikhoan.index')->with('success', 'Thêm tài khoản thành công!');
    }

    // Form sửa tài khoản
    public function edit($id)
    {
        $taikhoan = TaiKhoan::findOrFail($id);
        return view('admin.taikhoan.edit', compact('taikhoan'));
    }

    // Cập nhật tài khoản
    public function update(Request $request, $id)
    {
        $taikhoan = TaiKhoan::findOrFail($id);

        $request->validate([
            'ten_dang_nhap' => 'required|string|max:150|unique:taikhoan,ten_dang_nhap,' . $id . ',taikhoan_id',
            'vai_tro' => 'required',
        ]);

        $taikhoan->ten_dang_nhap = $request->ten_dang_nhap;
        $taikhoan->vai_tro = $request->vai_tro;

        if ($request->mat_khau) {
            $taikhoan->mat_khau = bcrypt($request->mat_khau);
        }

        $taikhoan->save();

        return redirect()->route('admin.taikhoan.index')->with('success', 'Cập nhật tài khoản thành công!');
    }

    // Xóa tài khoản
    public function destroy($id)
    {
        TaiKhoan::findOrFail($id)->delete();
        return redirect()->route('admin.taikhoan.index')->with('success', 'Đã xóa tài khoản!');
    }
}
