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
            $season = \App\Season::getOpenningSeason();
        }
        else{
            $season = \App\Season::getSeasonByID( $season_id );
        }

        $student_registrations = \App\Registration::where([
            ['is_confirmed','=','1'],
            ['updated_at','>=',$season->start_date],
            ['updated_at','<=',$season->end_date]
        ])->get();

        $students = array();
        //get student infomations through registration->user_id
        foreach ($student_registrations as $registration) {
            $student = \App\User::join('student_infos','student_infos.user_id','=','users.id')
                ->where('user_id','=',$registration->user_id)
                ->select('name','student_number','class')
                ->first();
            array_push($students, $student);
        }
        // dd($student_registrations);
        $all_season_id = \App\Season::getAllSeasonIDs();

        return view('internship.students-in-season',compact('students','all_season_id'));
    }
}
