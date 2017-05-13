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
            return view('manager.allocate', compact("allocations","leftStudents","companiesInSeason"));

    }

    public function allocate()
    {
        $student_id = \Input::get('student_id');
        $company_id = \Input::get('company_id');

        $newAllocation = new \App\Allocation;

        $newAllocation->student_id = $student_id;
        $newAllocation->company_id = $company_id;
        $newAllocation->teacher_id = 2;
        $newAllocation->instructor_id = 3;
        $newAllocation->season = \App\Season::getLastSeasonID();

        $newAllocation->save();
    }
}
