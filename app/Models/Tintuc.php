<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tintuc extends Model
{
    use HasFactory;
    protected $table = 'tin_tuc';
    protected $primaryKey='id_tin_tuc';
    protected $fillable = [
        'tieu_de',
        'hinh_tin_tuc',
        'content',
        'trang_thai',
        'id_user'
    ];

    public $timestamps = false;
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

}
