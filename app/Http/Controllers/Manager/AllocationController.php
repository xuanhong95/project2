<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AllocationController extends Controller
{
    //
    public function viewManagerAllocating()
    {
        $lastSeason = \App\Season::getLastSeasonID();

        $allocations = \App\Allocation::getAllocationsInSeason( $lastSeason );

        $studentsInSeason = \App\Registration::getStudentsInSeason( $lastSeason );
        $companiesInSeason = \App\Recruitment::getCompaniesInSeason( $lastSeason );

        $leftStudents = array();
        foreach ($studentsInSeason as $student) {
            if(\App\Allocation::existStudentInAllocationSeason($lastSeason, $student->user_id)){
            }
            else{
                array_push($leftStudents, $student);
            }
        }

        // dd($allocations);
        // dd($studentsInSeason,$leftStudents);
        // dd($companiesInSeason);
        return view('manager.allocate', compact("allocations","leftStudents","companiesInSeason","lastSeason"));

    }

    public function allocate()
    {
        $student_id = \Input::get('student_id');
        $company_id = \Input::get('company_id');
        $instructor_id = \Input::get('instructor_id');
        $teacher_id = \Input::get('teacher_id');
        $season = \Input::get('season');

        $allocation = \App\Allocation::where([
            ["student_id",'=',$student_id],
            ["season", '=', $season]
            ])->first();

        if( $allocation == null ){
            $allocation = new \App\Allocation;
        }

        $allocation->student_id = $student_id;
        $allocation->company_id = $company_id;
        $allocation->teacher_id = ($teacher_id == 0)? 2 : $teacher_id;
        $allocation->instructor_id = ($instructor_id == 0)? 3 : $instructor_id;
        $allocation->season = $season;

        $allocation->save();
        }

        public function getInstructorsInCompany()
        {
            $company_id = \Input::get('company_id');

            return \App\EnterpriseInstructor::getInstructorsInCompany($company_id);
        }
    }
