<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UuDai extends Model
{
    use HasFactory;

    protected $table = 'uudai';
    protected $primaryKey = 'uudai_id';
    public $timestamps = false; // ✅ Tắt tự động created_at và updated_at

    protected $fillable = [
        'tieu_de',
        'mo_ta',
        'giam_gia',
        'khachsan_id',
        'ngay_bat_dau',
        'ngay_ket_thuc',
    ];

    public function khachsan()
    {
        return $this->belongsTo(KhachSan::class, 'khachsan_id', 'khachsan_id');
    }
}
