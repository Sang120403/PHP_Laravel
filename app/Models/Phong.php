<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    use HasFactory;
    protected $table = 'phong';
    protected $primaryKey = 'id_phong';
    protected $fillable = [
        'ten_phong',
        'id_loai_phong',
        'id_rap',
        'trang_thai',
    ];

    public function loaiphongs()
    {
        return $this->belongsTo(Loaiphong::class, 'id_loai_phong', 'id_loai_phong');
    }

    public function raps()
    {
        return $this->belongsTo(Rap::class, 'id_rap', 'id_rap');
    }

    public function ghes()
    {
        return $this->hasMany(Ghe::class, 'id_phong', 'id_phong');
    }

    public function rows()
    {
        return $this->ghes()->select('row')->groupBy('row');
    }

    public function lichtrinhs()
    {
        return $this->hasMany(Lichtrinh::class, 'id_phong', 'id_phong');
    }
    //adminlichtrinh
    public function lichTrinhByDate($date)
    {
        return $this->lichtrinhs()->where('ngay', $date)->get();
    }
    public function latestLichTrinhByDate($date)
    {

        return $this->lichtrinhs()->where('ngay', $date)->latest('thoi_gian_ket_thuc')->limit(1)->get();
    }
}
