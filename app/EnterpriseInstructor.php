<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnterpriseInstructor extends Model
{
    //
    public static function getStudentsInSeason( $season )
    {

        return \App\Company::join('allocations', 'companies.id', '=', 'allocations.company_id')
            ->join('users','users.id','=', 'allocations.student_id')
            ->join('student_infos', 'student_infos.user_id', '=', 'allocations.student_id')
            ->join('timesheets', 'timesheets.id_allocation', '=','allocations.id')
            ->join('enterprise_instructors', 'enterprise_instructors.company_id', '=', 'companies.id')
            ->where([
                ['allocations.season','=', $season],
                ['enterprise_instructors.user_id', '=', \Auth::id()]
            ])
            ->select("allocations.student_id","users.name","student_infos.student_number","timesheets.*")
            ->get();

    }

    public static function getInstructorsInCompany( $company_id )
    {
        return \App\EnterpriseInstructor::where("company_id",'=', $company_id)->get();
    }

    public static function getInstructorOfStudent( $student_id, $season )
    {
        return \App\EnterpriseInstructor::join("allocations","allocations.instructor_id",'=',"enterprise_instructors.user_id")
            ->join("users","users.id",'=',"enterprise_instructors.user_id")
            ->where([
                ["allocations.student_id",'=', $student_id],
                ["season",'=', $season]
            ])
            ->select("users.name","enterprise_instructors.*")
            ->first();
    }
}
