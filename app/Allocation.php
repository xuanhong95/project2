<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    //
    public static function getAllocationStudentIDSeason($student_id, $season_id)
    {
        $allocation = \App\Allocation::where([
            ['season','=',$season_id],
            ['student_id','=',$student_id]
            ])->first();
        return $allocation;
    }

    public static function getIDByStudentIDSeason( $student_id, $season_id )
    {
        $allocation = \App\Allocation::where([
            ['season','=',$season_id],
            ['student_id','=',$student_id]
            ])->first();
        $allocation_id = $allocation->id;
        return $allocation_id;
    }
}
