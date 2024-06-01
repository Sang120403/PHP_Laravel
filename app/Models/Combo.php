<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;
    protected $primaryKey='id_combo';
    protected $table='combos';
    protected $fillable=[
        'ten_combo',
        'hinh',
        'gia',
        'status',
    ];

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'combo_food', 'id_combo', 'id_food')->withPivot('so_luong');
    }
}
