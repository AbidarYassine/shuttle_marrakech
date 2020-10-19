<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = "admins";
    protected $fillable = [
        'name', 'email', 'password', 'image', 'slug', 'phone'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'email', 'password', 'image', 'phone');
    }

    public function setEmailAttribute($value)
    {
        $this->email = $value;
    }
}
