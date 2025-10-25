<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class TaiKhoan extends Authenticatable
{
    protected $table = 'taikhoan';
    protected $primaryKey = 'taikhoan_id';
    public $timestamps = false;

    protected $fillable = ['ten_dang_nhap', 'mat_khau', 'vai_tro'];

    protected $hidden = ['mat_khau'];

    // Laravel mặc định dùng cột 'password', nên override lại
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }
}
