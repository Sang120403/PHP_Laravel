<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ve_Ghe extends Model
{
    use HasFactory;
    protected $table = 've_ghe';
     // Không có khóa chính

    protected $fillable =
    [
        'row',
        'col',
        'gia_ve',
        'id_ve',
        'ten_loai_ghe',
        'created_at',
        'update_at'
        
    ];
    
    public function ve()
    {
        return $this->belongsTo(Ve::class, 'id_ve', 'id_ve');
    }
}
