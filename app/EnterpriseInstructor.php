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

    public static function getInstructorsOfCompany( \App\Company $company )
    {
        return \App\EnterpriseInstructor::join("users",
                        "users.id",'=',"enterprise_instructors.user_id")
                ->where("company_id",'=', $company->id)
                ->select("users.name","enterprise_instructors.*")
                ->get();
    }

    public static function getInstructorsOfCompanyById($company_id)
    {
        if($company_id == null){
            $company_id = $company->id;
        }
        return \App\EnterpriseInstructor::join("users",
                        "users.id",'=',"enterprise_instructors.user_id")
                ->where("company_id",'=', $company_id)
                ->select("users.name","enterprise_instructors.*")
                ->get();
    }

    public static function getInstructorOfStudent( $student_id, \App\Season $season )
    {
        return \App\EnterpriseInstructor::join("allocations","allocations.instructor_id",'=',"enterprise_instructors.user_id")
            ->join("users","users.id",'=',"enterprise_instructors.user_id")
            ->where([
                ["allocations.student_id",'=', $student_id],
                ["season",'=', $season->id]
            ])
            ->select("users.name","enterprise_instructors.*")
            ->first();
    }

    public static function getInstructor( \App\StudentInfo $student, \App\Season $season )
    {
        return \App\EnterpriseInstructor::join("allocations",
                "allocations.instructor_id",'=',"enterprise_instructors.user_id")
            ->join("users","users.id",'=',"enterprise_instructors.user_id")
            ->where([
                ["allocations.student_id",'=', $student->user_id],
                ["season",'=', $season->id]
            ])
            ->select("users.name","enterprise_instructors.*")
            ->first();
    }
}
