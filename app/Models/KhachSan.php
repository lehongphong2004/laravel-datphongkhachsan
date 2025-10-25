<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachSan extends Model
{
    use HasFactory;

    protected $table = 'KhachSan';
    protected $primaryKey = 'khachsan_id';
    public $timestamps = false;
    
    protected $fillable = [
        'ten_khach_san',
        'dia_chi',
        'mo_ta',
        'xep_hang',
        'trang_thai'
    ];

    // Quan hệ với HinhAnhKhachSan
    public function hinhAnhs()
    {
        return $this->hasMany(HinhAnhKhachSan::class, 'khachsan_id');
    }

    // Quan hệ với Phong
    public function phongs()
    {
        return $this->hasMany(Phong::class, 'khachsan_id');
    }

    // Quan hệ với DanhGia
    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'khachsan_id');
    }

    // Quan hệ với UuDai
    public function uuDais()
    {
        return $this->hasMany(UuDai::class, 'khachsan_id');
    }
}
