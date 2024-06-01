<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Daodien extends Model
{
    use HasFactory;
    protected $table = 'dao_dien';
    protected $primaryKey='id_dao_dien';
    protected $fillable =
    [
        'ten_dao_dien',
        'hinh_dao_dien',
        'ngaysinh',
    ];

    public function phims()
{
    return $this->belongsToMany(Phim::class, 'daodien_phim', 'id_dao_dien', 'id_phim');
}

}
