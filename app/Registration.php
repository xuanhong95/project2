<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    public static function getRegistrationsOfCompanies( $companies )
    {

    }

    public static function getStudentsInSeason( $season )
    {
        return \App\Registration::join('users','users.id','=','registrations.user_id')
            ->join("student_infos","student_infos.user_id","=", "registrations.user_id")
            ->where([
                ["registrations.season",'=',$season],
                ["is_confirmed",'=', 1]
            ])
            ->select("student_infos.user_id","student_infos.student_number","users.name")
            ->get();
    }

}
