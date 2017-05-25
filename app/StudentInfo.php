<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Allocation;
use App\Season;
use App\User;
use App\Company;

class StudentInfo extends Model
{
    //
    protected $fillable=[
        'class','student_number','phone','address','is_male','dob','have_laptop',
    ];


    public static function getStudentNumberByID( $student_id )
    {
        $student = StudentInfo::where("user_id",'=', $student_id)->select("student_number")->first();

        return $student->student_number;
    }

    public static function getStudentInfo( $user_id )
    {
        return StudentInfo::join("users","users.id",'=',"student_infos.user_id")
            ->where("users.id",'=',$user_id)
            ->select("users.name","student_infos.*")
            ->first();
    }

    public static function getStudents(Company $company, Season $season)
    {
        return StudentInfo::join("allocations",
                    "allocations.student_id",'=', "student_infos.user_id")
                ->join("users","users.id",'=',"student_infos.user_id")
                ->where([
                    ["allocations.company_id", '=', $company->id],
                    ["season", '=', $season->id]
                ])
                ->select("users.name","student_infos.*")
                ->get();
    }

    public static function getStudentsInSeason(Season $season = null, $season_id = null )
    {
        if(is_null($season_id)){
            $season_id = $season->id;
        }

        return StudentInfo::join("registrations",
                    "registrations.user_id",'=', "student_infos.user_id")
                ->join("users","users.id",'=',"student_infos.user_id")
                ->where("registrations.season", '=', $season_id)
                ->select("users.name","student_infos.*")
                ->get();
    }

    public static function getNoCompanyStudents(Season $season)
    {
        $noCompanyStudents = array();
        $allStudentsInSeason = StudentInfo::getStudentsInSeason($season);

        foreach ($allStudentsInSeason as $student) {
            if(Allocation::hasCompany($student, $season) == false){
                array_push($noCompanyStudents, $student);
            }
        }

        return $noCompanyStudents;
    }
}
