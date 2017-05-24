<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attitude extends Model
{
    //
    public static function getAttitudesWithCriterias( $id_allocation )
    {
        $result = \App\Attitude::join("attitude_criterias","attitudes.criteria_id",'=',"attitude_criterias.id")
            ->where("attitudes.id_allocation",'=',$id_allocation)
            ->select("attitudes.*","attitude_criterias.criteria")
            ->orderBy("attitudes.criteria_id","esc")
            ->get();

        if(count($result) === 0){
            $criterias = \App\AttitudeCriteria::get();
            foreach ($criterias as $key => $criteria) {
                $newRecord = new \App\Attitude;
                $newRecord->id_allocation = $id_allocation;
                $newRecord->criteria_id = $criteria->id;
                $newRecord->point = 'A';
                $newRecord->save();
            }
            $result = \App\Attitude::join("attitude_criterias","attitudes.criteria_id",'=',"attitude_criterias.id")
                ->where("attitudes.id_allocation",'=',$id_allocation)
                ->select("attitudes.*","attitude_criterias.criteria")
                ->orderBy("attitudes.criteria_id","esc")
                ->get();
        }

        return $result;
    }
}
