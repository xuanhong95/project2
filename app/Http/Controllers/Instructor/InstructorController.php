<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InstructorController extends Controller
{
    //
    public function showStudents()
    {
        $currentSeason = \App\Season::getOpenningSeason();

        if( is_null( $currentSeason ) ){
            return "There aren't any openning season!!!";
        }

        $students = \App\Allocation::join('users','student_id','=','users.id')
            ->join('student_infos','student_infos.user_id','=','users.id')
            ->where( 'instructor_id',\Auth::id() )
            ->orderBy('season','desc')
            ->select('users.name','season','student_infos.student_number','student_infos.class','user_id')
            ->get();

        return view('instructor.show-students',compact('students'));
    }
}
