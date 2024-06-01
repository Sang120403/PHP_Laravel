<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lichtrinh extends Model
{
    use HasFactory;
    protected $table = 'lich_trinh';
    protected $primaryKey = 'id_lich_trinh';
    protected $fillable = [
        'id_phim',
        'id_phong',
        'ngay',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        'early',
        'trang_thai',
    ];

    public function phims()
    {
        return $this->belongsTo(Phim::class, 'id_phim', 'id_phim');
    }

    public function phongs()
    {
        return $this->belongsTo(Phong::class, 'id_phong', 'id_phong');
    }

    public function ves()
    {
        return $this->hasMany(Ve::class, 'id_lich_trinh','id_lich_trinh');
    }
}
