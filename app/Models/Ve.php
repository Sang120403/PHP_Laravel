<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ve extends Model
{
    use HasFactory;
    protected $table = 've';
    protected $primaryKey='id_ve';
    protected $fillable =
    [
        'id_lich_trinh',
        'id_user',
        'trang_thai_giu_ve',
        'trang_thai_dat_ve',
        'trang_thai_thanh_toan',
        'trang_thai_combo',
        'trang_thai_giam_gia',
        'tong_tien_ve',
        'ma_code',
    ];

    public function veghes()
    {
        return $this->hasMany(Ve_Ghe::class, 'id_ve', 'id_ve');
    }
    public function lichtrinhs()
    {
        return $this->hasOne(Lichtrinh::class,'id_lich_trinh','id_lich_trinh');
    }
    public function vecombos()
    {
        return $this->hasMany(Ve_Combo::class, 'id_ve', 'id_ve');
    }
    public function vefoods()
    {
        return $this->hasMany(Ve_Food::class, 'id_ve', 'id_ve');
    }
}
