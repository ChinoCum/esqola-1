<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bk','name', 'lastname','telephone','age', 'email', 'password', 'address','firstaccess', 'uuid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function attribute() {
        return $this->hasOne('App\User_attribute');
    }

    public function settings() {
        return $this->hasOne('App\User_settings');
    }

    public function badge() {
        //return $this->hasMany('App\Saved_badges');
        return $this->belongsToMany('App\Badges','saved_badges');
    }

    public function grade() {
        return $this->belongsToMany('App\Grades','grades');
    }

    public function full_name() {
        return $this->name . ' ' . $this->lastname;
    }

    public function error() {
        return $this->hasOne('App\errors');
    }

}
