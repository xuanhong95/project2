<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Season;
use App\StudentInfo;
use App\EnterpriseInstructor;
use App\Company;

class Allocation extends Model
{
    //
    public static function getAllocationStudentIDSeason($student_id, $season_id)
    {
        $allocation = Allocation::where([
            ['season','=',$season_id],
            ['student_id','=',$student_id]
            ])->first();
        return $allocation;
    }

    public static function getIDByStudentIDSeason( $student_id, $season_id )
    {
        $allocation = Allocation::where([
            ['season','=',$season_id],
            ['student_id','=',$student_id]
            ])->first();
        $allocation_id = $allocation->id;
        return $allocation_id;
    }

    public static function getAllocationsInSeason( $season )
    {
        return Allocation::where("season",'=',$season)->get();
    }

    public static function getMergedAllocationsInSeason( $season )
    {
        //Merge student_id
        $allocations = Allocation::join('companies','allocations.company_id','=','companies.id')
            ->join('users','users.id','=','student_id')
            ->select("company_id","companies.name as company_name","users.name","teacher_id","instructor_id","student_id")
            ->where("season",'=',$season)
            ->orderBy("companies.id",'esc')
            ->get();

        //Merge teacher_id
        foreach ($allocations as $allocation) {
            $allocation->teacher_id = User::getUserNameByID($allocation->teacher_id);
            $allocation->instructor_id = User::getUserNameByID($allocation->instructor_id);
        }

        return $allocations;
    }

    public static function getCompanyIDsListInSeason( $season )
    {
        return Allocation::where("season",'=',$season)->select('company_id')
            ->distinct()->get();
    }

    public static function getStudentIDsAllocationInSeason( $season )
    {
        return Allocation::where("season",'=',$season)->select('student_id')
            ->distinct()->get();
    }

    public static function hasCompany(StudentInfo $student ,  Season $season)
    {
        $allocation = Allocation::where([
            ['season','=',$season->id],
            ['student_id','=',$student->user_id],
        ])->first();

        return ($allocation == null?false:true);
    }

    public static function getAllocationsOfTeacherInSeason( $season_id, $teacher_id )
    {
        $allocation = Allocation::where([
            ['season','=',$season_id],
            ['teacher_id','=',$teacher_id]
            ])->first();
        return $allocation;
    }

    public static function getStudentsOfTeacherInSeason( $teacher_id, $season_id)
    {
        $students = Allocation::join("users","users.id",'=',"allocations.student_id")
            ->join("student_infos","student_infos.user_id",'=', "allocations.student_id")
            ->where([
                ['season','=', $season_id],
                ["teacher_id", '=', $season_id]
            ])
            ->select("users.name","student_infos.*","allocations.*")
            ->get();

        return $students;
    }

    public static function getAllStudentInSeason($season_id){
        $students = \App\Allocation::join("users","users.id",'=',"allocations.student_id")
            ->join("student_infos","student_infos.user_id",'=', "allocations.student_id")
            ->where([
                ['season','=', $season_id],
            ])
            ->select("users.name","student_infos.*","allocations.*")
            ->get();
        return $students;
    }

    public static function getInternshipStatus( Season $season )
    {
        $internship = new \StdClass;
        $companiesStatus = array();


        $internship->season = $season;

        $companiesInSeason = Company::getCompanies( $season );

        foreach( $companiesInSeason as $company ){
            $instructors = EnterpriseInstructor::getInstructorsOfCompany($company);
            $students = StudentInfo::getStudents($company, $season);

            $studentInstructorTeacher = array();

            foreach($students as $student){
                $tempBindingObject = new \StdClass;
                $tempBindingObject->student = $student;
                $tempBindingObject->instructor
                    = EnterpriseInstructor::getInstructor($student, $season);
                $tempBindingObject->teacher
                    = Teacher::getTeacher($student, $season);

                array_push($studentInstructorTeacher, $tempBindingObject);
            }

            $company->studentInstructor = $studentInstructorTeacher;
            $company->instructors = $instructors;

            array_push($companiesStatus, $company);
        }

        $internship->companies = $companiesStatus;
// dd($companiesStatus);
        return $internship;
    }

}
