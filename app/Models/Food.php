<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table='foods';
    protected $primaryKey='id_food';
    protected $fillable=[
        'ten_food',
        'hinh_food',
        'gia_food',
        'trang_thai',
        'created_at',
        'updated_at',
    ];

    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'combo_food', 'id_food', 'id_combo');
    }
}
