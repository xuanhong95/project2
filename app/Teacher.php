<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    public static function getAllTeachers()
    {
        return \App\Teacher::join("users","users.id","=","teachers.user_id")
            ->select("users.name","teachers.*")
            ->get();
    }
}
