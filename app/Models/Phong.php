<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    use HasFactory;

    protected $table = 'Phong';
    protected $primaryKey = 'phong_id';
    public $timestamps = false;
    protected $fillable = ['khachsan_id','ten_phong','loai_phong','gia','so_luong','mo_ta'];

    public function khachSan() {
        return $this->belongsTo(KhachSan::class,'khachsan_id');
    }

    public function datPhongs() {
        return $this->hasMany(DatPhong::class,'phong_id');
    }
}
