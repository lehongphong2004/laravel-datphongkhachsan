<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;

class DanhGiaController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'khachsan_id'=>'required',
            'diem'=>'required|integer|min:1|max:5',
            'binh_luan'=>'required'
        ]);

        DanhGia::create([
            'nguoidung_id'=>session('taikhoan_id'),
            'khachsan_id'=>$request->khachsan_id,
            'diem'=>$request->diem,
            'binh_luan'=>$request->binh_luan
        ]);

        return back()->with('success','Cảm ơn bạn đã đánh giá!');
    }
}
