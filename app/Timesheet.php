<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Instructor\TimekeepingController;

class Timesheet extends Model
{
    public static function getTimesheetOfStudentsOfCompanyInSeason( $season, $company_id )
    {

        return \App\Company::join('allocations', 'companies.id', '=', 'allocations.company_id')
        ->join('users','users.id','=', 'allocations.student_id')
        ->join('student_infos', 'student_infos.user_id', '=', 'allocations.student_id')
        ->join('timesheets', 'timesheets.id_allocation', '=','allocations.id')
        ->where([
            ['allocations.season','=', $season],
            ['companies.id', '=', $company_id]
        ])
        ->select("allocations.student_id","users.name","student_infos.student_number","timesheets.*")
        ->get();
    }

    public static function getTimesheetsOfStudentsInMonthOfSeason( $students, $month, $season )
    {

        foreach ($students as $index => $student) {
            $timesheetsInMonths = array();
            $allocation = \App\Allocation::getAllocationStudentIDSeason($student->user_id, $season->id);
            // dd($allocation);
            $timesheets = Timesheet::getTimesheetsInMonth($student, $month, $season);

            $timeInMonth = \App\Season::getStartDateAndEndDateOfMonthInSeason($month["month"],$month["year"], $season);
            // dd($timeInMonth);
            $timesheetsInMonth = new \StdClass;
            $timesheetsInMonth->month = $month["month"];
            $timesheetsInMonth->startDay = $timeInMonth["startDay"];
            $timesheetsInMonth->endDay = $timeInMonth["endDay"];
            $timesheetsInMonth->timesheets = $timesheets;
            $timesheetsInMonth->season = $season->id;

            $students[$index]->timesheetsInMonth = $timesheetsInMonth;

            }
            // dd($students);
            return $students;
        }

        public static function getTimesheetsOfStudentInMonthOfSeason( $student, $month, $season )
        {
            $timesheetsInMonths = array();
            $allocation = \App\Allocation::getAllocationStudentIDSeason($student->user_id, $season->id);
            // dd($allocation);
            $timesheets = \App\Timesheet::getTimesheetsInMonth($student, $month, $season);

            $timeInMonth = \App\Season::getStartDateAndEndDateOfMonthInSeason($month["month"],$month["year"], $season);
            // dd($timeInMonth);
            $timesheetsInMonth = new \StdClass;
            $timesheetsInMonth->month = $month["month"];
            $timesheetsInMonth->startDay = $timeInMonth["startDay"];
            $timesheetsInMonth->endDay = $timeInMonth["endDay"];
            $timesheetsInMonth->timesheets = $timesheets;
            $timesheetsInMonth->season = $season->id;

            $student->timesheetsInMonth = $timesheetsInMonth;

            return $student;
            }

            public static function saveValue($data, $student, $status, $task_id, $month, $season)
            {
                $allocation = \App\Allocation::getAllocationStudentIDSeason($student->user_id, $season->id);

                $storeTimesheet = \App\Timesheet::where([
                    ["id_allocation",'=', $allocation->id],
                    ["task_id", '=', $task_id],
                    ["month", '=', $month]
                    ])->first();
// dd($month);
                    switch ($status) {
                        case 'enough' :
                        // dd($storeTimesheet);
                            $storeTimesheet->enough_time = $data;
                            $storeTimesheet->save();

                            return $student->name." worked enough time";
                        case 'overtime' :
                            $storeTimesheet->overtime = $data;
                            $storeTimesheet->save();

                            return $student->name." worked overtime";
                        case 'sick' :
                            $storeTimesheet->sick_leave = $data;
                            $storeTimesheet->save();

                            return $student->name." was sick left";
                        case 'leave' :
                            $storeTimesheet->leave = $data;
                            $storeTimesheet->save();

                            return $student->name." was absent";
                        case 'withoutAbsent' :
                            $storeTimesheet->absent_without_leave = $data;
                            $storeTimesheet->save();

                            return $student->name." was not allowed absent";
                        case 'other' :
                            $storeTimesheet->other = $data;
                            $storeTimesheet->save();

                            return $student->name." Other";
                        default:
                        # code...
                        break;
                    }
                    return "";
                }

                public static function getTimesheetsInMonth( $student, $month, $season )
                {
                    $allocation = \App\Allocation::getAllocationStudentIDSeason($student->user_id, $season->id);
// dd($season);
                    $timesheets = \App\Timesheet::join("task_forms","timesheets.task_id",'=',"task_forms.id")
                    ->where([
                        ["timesheets.month",'=', $month["month"]],
                        ["timesheets.id_allocation",'=', $allocation->id]
                    ])
                    ->select("timesheets.*","task_forms.content")
                    ->get();

                    if( count($timesheets) == 0 ){
                        $taskForms = \App\TaskForm::getTaskFormsOfStudentInSeason($student->user_id, $season->id );
                        foreach ($taskForms as $taskForm){
                            $timesheet = new \App\Timesheet;

                            $timesheet->id_allocation = $allocation->id;
                            $timesheet->month = $month["month"];
                            $timesheet->enough_time = "";
                            $timesheet->overtime = "";
                            $timesheet->leave = "";
                            $timesheet->absent_without_leave = "";
                            $timesheet->sick_leave = "";
                            $timesheet->other = "";
                            $timesheet->task_id = $taskForm->id;
                            $timesheet->save();
                        }
                        $timesheets = \App\Timesheet::join("task_forms","timesheets.task_id",'=',"task_forms.id")
                        ->where([
                            ["timesheets.month",'=', $month["month"]],
                            ["timesheets.id_allocation",'=', $allocation->id]
                        ])
                        ->select("timesheets.*","task_forms.content")
                        ->get();
                    }
                    return $timesheets;
                }
            }
