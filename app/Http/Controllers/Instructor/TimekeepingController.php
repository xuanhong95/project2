<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TimekeepingController extends Controller
{
    //
    public function viewTimesheets()
    {
        $lastSeason = \App\Season::getLastSeasonID();

        $timesheetOfStudent = \App\EnterpriseInstructor::getStudentsInSeason( $lastSeason );

        $studentsInSeason = \App\Registration::getStudentsInSeason( $lastSeason );

        $timesheets = \App\Timesheet::getTimesheetsOfStudentsInSeason($studentsInSeason, $lastSeason);

        $taskForms = \App\TaskForm::getTaskFormsOfStudentsInSeason($studentsInSeason, $lastSeason );

        // dd($timesheets);
        // $company_id = \App\EnterpriseInstructor::
        // dd($taskForms);
        // dd($timesheetOfStudent);
        // dd($studentsInSeason);
        return view("instructor.instructor-timesheets", compact("timesheetOfStudent","studentsInSeason","taskForms", "timesheets"));
    }

    public static function getDaysNumber( $month, $year)
    {
        switch ($month) {
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12: return 31;
            case 2: if( ($year % 4 == 0) && ($year % 100 != 0)){
                        return 29;
                    }
                    else{
                        return 28;
                    }

            default: return 30;
        }
    }
}
