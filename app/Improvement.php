<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Improvement extends Model
{
    //
    public static function getImprovementsWithCriterias( $id_allocation )
    {
        $result = \App\Improvement::join("improvement_criterias","improvements.criteria_id",'=',"improvement_criterias.id")
            ->where("improvements.id_allocation",'=',$id_allocation)
            ->select("improvements.*","improvement_criterias.criteria")
            ->orderBy("improvements.criteria_id","esc")
            ->get();

        if(count($result) === 0){
            $criterias = \App\ImprovementCriteria::all();
            foreach ($criterias as $key => $criteria) {
                $newRecord = new \App\Improvement;
                $newRecord->id_allocation = $id_allocation;
                $newRecord->criteria_id = $criteria->id;
                $newRecord->point = 'A';
                $newRecord->save();
            }
            $result = \App\Improvement::join("improvement_criterias","improvements.criteria_id",'=',"improvement_criterias.id")
                ->where("improvements.id_allocation",'=',$id_allocation)
                ->select("improvements.*","improvement_criterias.criteria")
                ->orderBy("improvements.criteria_id","esc")
                ->get();
        }

        return $result;
    }
}
