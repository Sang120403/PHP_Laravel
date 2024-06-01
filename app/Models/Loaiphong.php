<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loaiphong extends Model
{
    use HasFactory;
    protected $table = 'loai_phong';
    protected $primaryKey = 'id_loai_phong';
    protected $fillable = [
        'ten_loai_phong',
        'phu_phi',
    ];

    public function phongs()
    {
        return $this->hasMany(Phong::class, 'id_loai_phong', 'id_loai_phong');
    }

    public function lichtheongayvarapvaphims($date, $theater, $movie)
    {
        return $this->phongs()->select('lich_trinh.*')
            ->join('lich_trinh', 'lich_trinh.id_phong', '=', 'phong.id_phong')
            ->join('rap', 'rap.id_rap', '=', 'phong.id_rap')
            ->where('lich_trinh.ngay', $date)
            ->where('phong.id_loai_phong', $this->id_loai_phong)
            ->where('rap.id_rap', $theater)
            ->where('lich_trinh.id_phim', $movie)
            ->where('lich_trinh.trang_thai', 1)
            ->get();
    }
}
