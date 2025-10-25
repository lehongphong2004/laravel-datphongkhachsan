<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;

    protected $table = 'DanhGia';
    protected $primaryKey = 'danhgia_id';
    public $timestamps = false;
    protected $fillable = ['nguoidung_id','khachsan_id','diem','binh_luan','ngay_danhgia'];

    public function nguoiDung() {
        return $this->belongsTo(NguoiDung::class,'nguoidung_id');
    }

    public function khachSan() {
        return $this->belongsTo(KhachSan::class,'khachsan_id');
    }
}
