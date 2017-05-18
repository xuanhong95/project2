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

    public static function getAllocationsInSeason( $season )
    {
        return \App\Allocation::where("season",'=',$season)->get();
    }

    public static function getMergedAllocationsInSeason( $season )
    {
        //Merge student_id
        $allocations = \App\Allocation::join('companies','allocations.company_id','=','companies.id')
            ->join('users','users.id','=','student_id')
            ->select("company_id","companies.name as company_name","users.name","teacher_id","instructor_id","student_id")
            ->where("season",'=',$season)
            ->orderBy("companies.id",'esc')
            ->get();

        //Merge teacher_id
        foreach ($allocations as $allocation) {
            $allocation->teacher_id = \App\User::getUserNameByID($allocation->teacher_id);
            $allocation->instructor_id = \App\User::getUserNameByID($allocation->instructor_id);
        }

        return $allocations;
    }

    public static function getCompanyIDsListInSeason( $season )
    {
        return \App\Allocation::where("season",'=',$season)->select('company_id')
            ->distinct()->get();
    }

    public static function getStudentIDsAllocationInSeason( $season )
    {
        return \App\Allocation::where("season",'=',$season)->select('student_id')
            ->distinct()->get();
    }

    public static function existStudentInAllocationSeason( $season, $student_id )
    {
        $allocation = \App\Allocation::where([
            ['season','=',$season],
            ['student_id','=',$student_id],
        ])->first();

        return $allocation == null?false:true;
    }

    public static function getAllocationsOfTeacherInSeason( $season_id, $teacher_id )
    {
        $allocation = \App\Allocation::where([
            ['season','=',$season_id],
            ['teacher_id','=',$teacher_id]
            ])->first();
        return $allocation;
    }

    public static function getStudentsOfTeacherInSeason( $teacher_id, $season_id)
    {
        return \App\Allocation::join("users","users.id",'=',"allocations.student_id")
            ->join("student_infos","student_infos.user_id",'=', "allocations.student_id")
            ->where([
                ['season','=', $season_id],
                ["teacher_id", '=', $season_id]
            ])
            ->select("users.name","student_infos.*","allocations.*")
            ->get();
    }

}
