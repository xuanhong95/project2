<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public static function getTasksWithCriterias( $id_allocation )
    {
        $result = \App\Task::join("task_criterias","tasks.criteria_id",'=',"task_criterias.id")
            ->where("tasks.id_allocation",'=',$id_allocation)
            ->select("tasks.*","task_criterias.criteria")
            ->orderBy("tasks.criteria_id","esc")
            ->get();

        if( count($result) === 0 ){
            $criterias = \App\TaskCriteria::get();
            foreach ($criterias as $key => $criteria) {
                $newRecord = new \App\Task;
                $newRecord->id_allocation = $id_allocation;
                $newRecord->criteria_id = $criteria->id;
                $newRecord->point = 'A';
                $newRecord->save();
            }
            $result = \App\Task::join("task_criterias","tasks.criteria_id",'=',"task_criterias.id")
                ->where("tasks.id_allocation",'=',$id_allocation)
                ->select("tasks.*","task_criterias.criteria")
                ->orderBy("tasks.criteria_id","esc")
                ->get();
        }

        return $result;
    }
}
