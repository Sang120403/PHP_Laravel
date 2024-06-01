<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey='id_user';
    protected $fillable = [
        'fullName',
        'password',
        'email',
        'phone',
        'xacminh_email',
        'id_rap_phim ',
        'point',
        'role',
        'status',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles', 'user_id', 'role_id');
    }

    public function hasRole($role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function ves()
    {
        return $this->hasMany(Ve::class, 'id_user', 'id_user');
    }

//    public function role() {
//        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
//    }

    public function raps()
    {
        return $this->belongsTo(Theater::class, 'theater_id', 'id');
    }
}
