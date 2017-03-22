<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    //
    protected $fillable= [
        'start_date','register_deadline','submit_result_deadline',
        'remarking_deadline','end_date',
    ];

    public static function is_openningSeason(\App\Season $season)
    {
        $currentDate = date('Y-m-d');
        return ( $currentDate >= $season->start_date )&&( $currentDate <= $season->end_date )?true:false;
    }

    public static function is_closedSeason(\App\Season $season)
    {
        $currentDate = date('Y-m-d');
        return ( $currentDate >= $season->start_date )&&( $currentDate <= $season->end_date )?false:true;
    }

    public static function getOpenningSeason()
    {
        $currentDate= date('Y-m-d');
        $openningSeasons=\App\Season::whereBetween($currentDate,['start_date','end_date'])->get();
        return $openningSeasons;
    }
}
