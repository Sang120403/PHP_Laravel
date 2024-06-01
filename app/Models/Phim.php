<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Phim extends Model
{
    use HasFactory;
    protected $table = 'phim';
    protected $primaryKey='id_phim';
    protected $fillable =
    [
        'ten_phim',
        'image',
        'thoi_luong_phim',
        'ngay_phat_hanh',
        'ngay_ket_thuc',
        'quoc_giasx',
        'trailer',
        'id_gioi_han_do_tuoi',
        'trang_thai',
        'mieu_ta',
    ];

    public $timestamps = false;

    public function daodiens()
    {
        return $this->belongsToMany(Daodien::class, 'daodien_phim', 'id_phim', 'id_dao_dien');
    }

    public function loaiphims()
    {
        return $this->belongsToMany(Loaiphim::class,'loai_phim_phim','id_phim','id_loai_phim');
    }

    public function dienviens()
    {
        return $this->belongsToMany(Dienvien::class,'dienvien_phim','id_phim','id_dien_vien');
    }
    public function rating()
    {
        return $this->belongsTo(Gioihandotuoi::class,'id_gioi_han_do_tuoi','id_gioi_han_do_tuoi');
    }

    public function lichtrinhs()
    {
        return $this->hasMany(Lichtrinh::class,'id_phim','id_phim');
    }


}
