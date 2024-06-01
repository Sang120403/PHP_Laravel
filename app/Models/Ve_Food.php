<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ve_Food extends Model
{
    use HasFactory;

    protected $table = 've_food';

    protected $fillable = [
        'ten_food',
        'gia_food',
        'so_luong',
        'id_ve',
        'created_at',
        'updated-at'
    ];
}
