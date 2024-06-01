<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loaiphim extends Model
{
    use HasFactory;
    protected $table = 'loai_phim';
    protected $primaryKey='id_loai_phim';
    protected $fillable =
    [
        'ten_loai_phim',
        'trang_thai',
   
    ];

    public $timestamps = false;

    public function phims()
    {
        return $this->belongsToMany(Movie::class,'loai_phim_phim','id_loai_phim','id_phim');
    }
}

