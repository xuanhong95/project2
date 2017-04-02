<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    //

    public static function getConfirmedRecruitments()
    {
        return \App\Recruitment::whereNot('is_confirm',null)->get();
    }

    public static function getUnconfirmedRecruitments()
    {
        return \App\Recruitment::where('is_confirm',null)->get();
    }
}
