<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatPhong extends Model
{
    use HasFactory;

    protected $table = 'DatPhong';
    protected $primaryKey = 'datphong_id';
    public $timestamps = false;
    protected $fillable = ['nguoidung_id','phong_id','ngay_dat','ngay_den','ngay_di','tong_tien','trang_thai'];

    public function nguoiDung() {
        return $this->belongsTo(NguoiDung::class,'nguoidung_id');
    }

    public function phong() {
        return $this->belongsTo(Phong::class,'phong_id');
    }

    public function thanhToan() {
        return $this->hasOne(ThanhToan::class,'datphong_id');
    }
    
}
