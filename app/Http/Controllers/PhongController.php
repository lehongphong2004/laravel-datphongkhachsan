<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phong;
use App\Models\KhachSan;

class PhongController extends Controller
{
    // CRUD Phòng - Admin hoặc Partner
    public function create($khachsan_id){
    $khachsan = KhachSan::findOrFail($khachsan_id);
    return view('admin.phong_crud', ['khachsan_id'=>$khachsan_id, 'khachsan'=>$khachsan]);
}

    public function store(Request $request){
        $request->validate([
            'ten_phong'=>'required',
            'gia'=>'required|numeric',
        ]);

        Phong::create($request->all());
        return back()->with('success','Thêm phòng thành công!');
    }

    public function edit($id){
        $phong = Phong::findOrFail($id);
        return view('admin.phong_crud', compact('phong'));
    }

    public function update(Request $request, $id){
        $phong = Phong::findOrFail($id);
        $phong->update($request->all());
        return back()->with('success','Cập nhật thành công!');
    }

    public function destroy($id){
        $phong = Phong::findOrFail($id);
        $phong->delete();
        return back()->with('success','Xóa phòng thành công!');
    }
}
