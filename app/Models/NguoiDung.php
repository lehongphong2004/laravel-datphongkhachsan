<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NguoiDung extends Model
{
    use HasFactory;

    protected $table = 'NguoiDung';
    protected $primaryKey = 'nguoidung_id';
    public $timestamps = false;
    protected $fillable = ['taikhoan_id','ho_ten','email','so_dien_thoai'];

    public function taiKhoan() {
        return $this->belongsTo(TaiKhoan::class,'taikhoan_id');
    }

    public function khachSan() {
        return $this->hasMany(KhachSan::class,'nguoidung_id');
    }

    public function datPhongs() {
        return $this->hasMany(DatPhong::class,'nguoidung_id');
    }

    public function danhGias() {
        return $this->hasMany(DanhGia::class,'nguoidung_id');
    }
}
