<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable

{

    use HasApiTokens, SoftDeletes, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function basic_info()
    {
        return $this->hasOne(UserBasicInformation::class, 'user_id');
    }

    
}
