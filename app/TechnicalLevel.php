<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechnicalLevel extends Model
{
    //
    public static function getTechnicalLevelsWithCriterias( $id_allocation )
    {
        $result = \App\TechnicalLevel::join("technical_level_criterias","technical_levels.criteria_id",'=',"technical_level_criterias.id")
            ->where("technical_levels.id_allocation",'=',$id_allocation)
            ->select("technical_levels.*","technical_level_criterias.criteria")
            ->orderBy("technical_levels.criteria_id","esc")
            ->get();

        if( count($result) === 0 ){
            $criterias = \App\TechnicalLevelCriteria::get();

            foreach ($criterias as $key => $criteria) {
                $newRecord = new \App\TechnicalLevel;
                $newRecord->id_allocation = $id_allocation;
                $newRecord->criteria_id = $criteria->id;
                $newRecord->point = 'A';
                $newRecord->save();
            }
            $result = \App\TechnicalLevel::join("technical_level_criterias","technical_levels.criteria_id",'=',"technical_level_criterias.id")
                ->where("technical_levels.id_allocation",'=',$id_allocation)
                ->select("technical_levels.*","technical_level_criterias.criteria")
                ->orderBy("technical_levels.criteria_id","esc")
                ->get();
        }

        return $result;
    }
}
