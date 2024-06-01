<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ve_Combo extends Model
{
    use HasFactory;
    protected $table = 've_combo';

    protected $fillable = [
        'ten_combo',
        'gia_combo',
        'mieu_ta',
        'so_luong',
        'id_ve',
        'created-at',
        'updated_at'
    ];
}
