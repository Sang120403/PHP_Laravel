<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dienvien extends Model
{
    use HasFactory;
    protected $table = 'dien_vien';
    protected $primaryKey='id_dien_vien';
    protected $fillable =
    [
        'ten_dien_vien',
        'hinh_dien_vien',
        'quoc_gia',
        'content_dien_vien',
    ];

    public function phims()
    {
        return $this->belongsToMany(Phim::class, 'dienvien_phim', 'id_dien_vien', 'id_phim');
    }
}
