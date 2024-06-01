<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gioihandotuoi extends Model
{
    use HasFactory;
    protected $table = 'gioi_han_do_tuoi';
    protected $primaryKey='id_gioi_han_do_tuoi';
    protected $fillable =
    [
        'ten_gioi_han',
        'mieu_ta',
    ];

    // public function phims()
    // {
    //     return $this
    // }
}


