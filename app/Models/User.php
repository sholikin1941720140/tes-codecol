<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'status',
        'username',
        'password',
        'email',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function employee()
    {
        $this->hasOne(Employee::class, 'user_id', 'id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id');
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'user_id', 'id');
    }
}
