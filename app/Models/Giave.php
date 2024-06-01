<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giave extends Model
{
    use HasFactory;
    protected $table='gia_ve';
    protected $primaryKey='id_gia_ve';
    protected $fillable=
    [
        'gia_ve',
        'ngay',
        'thoi_gian_sau',
        'generation',
        'id_user',
    ];
}
