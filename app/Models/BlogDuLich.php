<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogDuLich extends Model
{
    protected $table = 'blogdulich'; // tên bảng bạn vừa tạo

    protected $fillable = [
        'tieu_de',
        'noi_dung',
        'hinh_anh',
        'tac_gia',
    ];
}
?>