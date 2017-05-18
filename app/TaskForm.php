<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskForm extends Model
{
    //
    public static function getTaskFormsInSeason( $season )
    {
        return \App\TaskForm::join("allocations", "allocations.id", '=', "task_forms.id_allocation")
            ->where("season", $season)
            ->get();
    }

    public static function getTaskFormsOfCompanyInSeason( $season, $company)
    {

    }

    public static function getTaskFormsOfStudentsInSeason( $students, $season)
    {
        $taskForms = array();
        foreach( $students as $student){
            $taskForm = \App\TaskForm::join("allocations","allocations.id", '=', "task_forms.id_allocation")
                ->where([
                    ["allocations.student_id", '=', $student->user_id],
                    ["allocations.season", '=', $season]
                ])
                ->select("allocations.student_id","task_forms.*")
                ->get();

            if($taskForm == null){
                $allocation = \App\Allocation::getAllocationStudentIDSeason($student->user_id, $season);
                $taskForm = new \App\TaskForm;

                $taskForm->id_allocation = $allocation->id;
                $taskForm->save();
            }
            array_push($taskForms, $taskForm);

        }

        return $taskForms;
    }

    public static function decodeDaysToArray( $daysString )
    {
        return json_decode($daysString);
    }
}
