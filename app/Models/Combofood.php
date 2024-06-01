<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combofood extends Model
{
    use HasFactory;
    protected $table='combo_food';
    
    protected $fillable=[
        'id_combo',
        'id_food',
        'so_luong',
        'created_at',
        'updated_at',

    ];
}
