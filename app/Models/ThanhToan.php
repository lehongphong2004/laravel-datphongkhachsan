<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThanhToan extends Model
{
    use HasFactory;

    protected $table = 'ThanhToan';
    protected $primaryKey = 'thanhtoan_id';
    public $timestamps = false;
    protected $fillable = ['datphong_id','so_tien','hinh_thuc','ngay_tt'];

    public function datPhong() {
        return $this->belongsTo(DatPhong::class,'datphong_id');
    }
}
