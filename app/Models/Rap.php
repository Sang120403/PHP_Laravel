<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rap extends Model
{
    use HasFactory;
    protected $table = 'rap';
    protected $primaryKey = 'id_rap';
    protected $fillable = [
        'ten_rap',
        'dia_chi',
        'thanh_pho',
        'vi_tri',
        'trang_thai',
    ];

    public function phongs()
    {
        return $this->hasMany(Phong::class, 'id_rap', 'id_rap');
    }

    public function lichtheongayvaphims($date, $movie)
    {
        return $this->phongs()->select('lich_trinh.*')
            ->join('lich_trinh', 'lich_trinh.id_phong', '=', 'phong.id_phong')
            ->where('lich_trinh.ngay', $date)
            ->where('lich_trinh.id_phim', $movie)
            ->get();
    }

    public function lichtheongayvarapvaphims($movie, $roomType)
    {
        return $this->phongs()->select('lich_trinh.*')
            ->join('lich_trinh', 'lich_trinh.id_phong', '=', 'phong.id_phong')
            ->join('loai_phong', 'loai_phong.id_loai_phong', '=', 'phong.id_loai_phong')
            ->where('rap.id_rap', $this->id_rap)
            ->where('loai_phong.id_loai_phong', $roomType)
            ->where('lich_trinh.id_phim', $movie)
            ->get();
    }
}
