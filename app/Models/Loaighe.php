<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loaighe extends Model
{
    use HasFactory;
    protected $table = 'loai_ghe';
    protected $primaryKey='id_loai_ghe';
    protected $fillable =
    [
        'ten_loai_ghe',
        'phu_phi',
        'mau_loai_ghe',
   
    ];
}

