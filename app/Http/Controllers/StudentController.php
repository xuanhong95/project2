<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StudentController extends Controller
{
    /*This function return view list of intern in a season
    * Parameter: $season_id      :define the season
    * Output: $students  : contains student info
    * Output: $all_season_id  : to generate selections seasons
    */
    public function showStudents($season_id = null)
    {
        if (is_null($season_id)){
            $season_id = \App\Season::getLastSeasonID();
        }

        $student_registrations = \App\Registration::where([
            ["season",'=', $season_id]
        ])->get();
        
        $students = array();
        //get student infomations through registration->user_id
        foreach ($student_registrations as $registration) {
            $student = \App\User::join('student_infos','student_infos.user_id','=','users.id')
                ->where('user_id','=',$registration->user_id)
                ->select('users.name','student_infos.*')
                ->first();
            array_push($students, $student);
        }
        // dd($student_registrations);
        $all_season_id = \App\Season::getAllSeasonIDs();

        return view('internship.students-in-season',compact('students','all_season_id'));
    }
}
