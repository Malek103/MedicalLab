<?php

namespace App\Models;

use App\Models\ManagerLab;
use App\Models\TechnicianLab;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'UserName',
        'email',
        'password',
        'status'
    ];
    // public function scopeFilter($query, array $filter)
    // {
    //     $query->when(
    //         $filter['search'] ?? false,
    //         fn ($query, $search) => $query->where(fn ($query) =>
    //         $query->where('UserName', 'like', '%' . $search . '%')
    //             ->orWhere('email', 'like', '%' . $search . '%'))
    //     );

    // }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function manager()
    {
        return $this->hasOne(ManagerLab::class, 'ACNO', 'id');
    }
    public function technician()
    {
        return $this->hasOne(TechnicianLab::class, 'ACNO' , 'id');
    }
    public function patient()
    {
        return $this->hasOne(ManagerLab::class, 'ACNO', 'id');
    }
}
