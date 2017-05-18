<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public static function getTimesheetsOfStudentsInSeason( $students, $season )
    {
        $timesheets = array();
        foreach ($students as $student) {
            $timesheet = \App\Timesheet::join("allocations", "allocations.id", '=', "timesheets.id_allocation")
                ->where([
                    ["allocations.student_id", '=', $student->user_id],
                    ["allocations.season", '=', $season]
                ])
                ->select("allocations.student_id","timesheets.*")
                ->get();

            if( $timesheet == null){
                $allocation_id = \App\Allocation::getAllocationStudentIDSeason($student->user_id, $season);

                $timesheet = new \App\Timesheet;

                $timesheet->id_allocation = $allocation_id->id;
                $timesheet->save();
            }
            array_push($timesheets, $timesheet);
        }

        return $timesheets;
    }
}
