<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Season;
use App\Allocation;
use App\Registration;
use App\Recruitment;
use App\StudentInfo;
use App\EnterpriseInstructor;
use App\Company;
use App\Teacher;


class AllocationController extends Controller
{
    public function __construct()
    {

    }

    public function viewManagerAllocating(Season $season = null)
    {
        if($season->exists == false){
            $season = Season::getLastSeason();
        }

        $companies = Company::getCompanies($season);
        $teachers = Teacher::getAllTeachers();
        $internshipStatus = Allocation::getInternshipStatus($season);
        $noCompanyStudents = StudentInfo::getNoCompanyStudents($season);
// dd($internshipStatus);
// dd($noCompanyStudents);
        return view('manager.allocate',
            compact("noCompanyStudents","companies","season","teachers",
                    "internshipStatus"));

    }

    public function allocate()
    {
        if( (\Request::isMethod("post")) && (\Input::get("_token") == csrf_token()) ){
            $student_id = \Input::get('student_id');
            $company_id = \Input::get('company_id');
            $instructor_id = \Input::get('instructor_id');
            $teacher_id = \Input::get('teacher_id');
            $season = \Input::get('season');

            $allocation = Allocation::where([
                ["student_id",'=',$student_id],
                ["season", '=', $season]
                ])->first();

            if( $allocation == null ){
                $allocation = new Allocation;
            }

            $allocation->student_id = $student_id;
            $allocation->company_id = $company_id;
            $allocation->teacher_id = ($teacher_id == 0)? 2 : $teacher_id;
            $allocation->instructor_id = ($instructor_id == 0)? 3 : $instructor_id;
            $allocation->season = $season;

            $allocation->save();
        }
    }

    public function getInstructorsOfCompany()
    {
        $company_id = \Input::get('company_id');

        return EnterpriseInstructor::getInstructorsOfCompanyById($company_id);
    }
}
