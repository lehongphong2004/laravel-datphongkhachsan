<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HinhAnhKhachSan extends Model
{
    use HasFactory;

    protected $table = 'HinhAnhKhachSan';
    protected $primaryKey = 'hinhanh_id';
    public $timestamps = false;
    protected $fillable = ['khachsan_id','duong_dan'];

    public function khachSan() {
        return $this->belongsTo(KhachSan::class,'khachsan_id');
    }
}
