<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getUserNameByID($id){
        $user = \App\User::where('id', $id)->first();
        return $user->name;
    }

    public static function getUserEmailByID($id){
        $user = \App\User::where('id', $id)->first();
        return $user->email;
    }
}
