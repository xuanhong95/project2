<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TimekeepingController extends Controller
{
    //
    public function viewTimesheets($selectedMonth = null, $season = null)
    {
        if( is_null($season) ){
            $season = \App\Season::getLastSeason();
        }

        $monthsInSeason = \App\Season::getMonthsBetween($season->start_date,$season->end_date);

        if( is_null($selectedMonth) ){
            $selectedMonth = $monthsInSeason[0];
        }

        $students = \App\Registration::getStudentsInSeason( $season->id );

        $timesheetsOfStudentsInSelectedMonth
            = \App\Timesheet::getTimesheetsOfStudentsInMonthOfSeason($students, $selectedMonth, $season);
// dd($timesheetsOfStudentsInSelectedMonth);
        if( (\Request::isMethod("post")) && (\Input::get("_token") == csrf_token()) ){
            $selectedMonthIndex= \Input::get("selectedMonthIndex");
            $selectedStudentId = \Input::get("student_id");

            $selectedMonth = $monthsInSeason[$selectedMonthIndex];
            $student = \App\StudentInfo::getStudentInfo( $selectedStudentId );
            $timesheetsOfStudentInSelectedMonth
                = \App\Timesheet::getTimesheetsOfStudentInMonthOfSeason($student, $selectedMonth, $season);

            return $timesheetsOfStudentInSelectedMonth;
        }

        // dd($timesheetsOfStudentsInSelectedMonth);
        return view("instructor.instructor-timesheets",
        compact("timesheetsOfStudentsInSelectedMonth","monthsInSeason"));
    }

    public function timekeeping()
    {
        if((\Request::isMethod("post")) && (\Input::get("_token") == csrf_token())){
            $input = \Input::all();
            $data = \Input::get('days');
            $student_id = \Input::get('student_id');
            $month = \Input::get('month');
            $status = \Input::get('status');
            $season_id = \Input::get('season_id');
            $task_id = \Input::get('task_id');

            $student = \App\StudentInfo::getStudentInfo($student_id);
            $season = \App\Season::getSeason($season_id);

            $result = \App\Timesheet::saveValue($data, $student, $status, $task_id, $month, $season);

            return $result;
        }
    }


}
