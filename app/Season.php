<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable= [
        'start_date','register_deadline','submit_result_deadline',
        'remarking_deadline','end_date',
    ];


    public static function getStatusSeasonID($season_id)
    {
        $season = \App\Season::where('id', $season_id)->first();

        $currentDate = date('Y-m-d');

        if ( $currentDate > $season->end_date ){
            return "Finished";
        }
        elseif ( $currentDate > $season->remarking_deadline ){
            return "Remarking...";
        }
        elseif ( $currentDate > $season->submit_result_deadline ){
            return "Submitting results...";
        }
        else {
            return "Registering..";
        }
    }

    public static function getLastSeason()
    {
        return \App\Season::orderBy("id",'desc')->first();
    }

    public static function getLastSeasonID()
    {
        return \App\Season::getLastSeason()->id;
    }

    public static function is_openningSeasonID($season_id)
    {
        $currentDate = date('Y-m-d');
        $season = \App\Season::where('id', $season_id)->first();

        return ( $currentDate >= $season->start_date )&&( $currentDate <= $season->end_date )?true:false;
    }

    public static function is_closedSeasonID( $season_id)
    {
        $currentDate = date('Y-m-d');
        $season = \App\Season::where('id', $season_id)->first();

        return ( $currentDate >= $season->start_date )&&( $currentDate <= $season->end_date )?false:true;
    }

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
        $openningSeason=\App\Season::where([
            ['start_date','<=',$currentDate],
            ['end_date','>=',$currentDate]
            ])->first();
        return $openningSeason;
    }

    public static function getOpenningSeasonID()
    {
        $currentDate= date('Y-m-d');
        $openningSeason=\App\Season::where([
            ['start_date','<=',$currentDate],
            ['end_date','>=',$currentDate]
            ])->first();
        $openningSeason_id = $openningSeason->id;
        return $openningSeason_id;
    }

    public static function getSeason($season_id)
    {
        return \App\Season::where('id',$season_id)->first();
    }

    public static function getSeasonByID($season_id)
    {
        return \App\Season::where('id',$season_id)->first();
    }

    public static function getAllSeasons()
    {
        return \App\Season::all();
    }

    public static function getAllSeasonIDs()
    {
        return \App\Season::select('id')->get();
    }

    public static function getStartDate( $season_id )
    {
        $season = \App\Season::where("id",'=',$season_id)->first();

        return $season->start_date;
    }

    public static function getEndDate( $season_id )
    {
        $season = \App\Season::where("id",'=',$season_id)->first();

        return $season->end_date;
    }

    public static function getStartDateAndEndDateOfMonthInSeason($month, $year, $season = null)
    {
        // dd($month);
        if(is_null($season)){
            $season = \App\Season::getLastSeason();
        }

        $startDate = strtotime($season->start_date);
        $endDate = strtotime($season->end_date);

        $startMonth = date("m", $startDate);
        $endMonth = date("m", $endDate);
        $endYear = date("Y", $endDate);
        //get start day

        $startDay = 1;
        if($month == $startMonth){
            $startDay = +date('d', $startDate);
        }

        //get endDay
        $endDay = \App\Season::getDaysNumber($month, $year);
        if($month == $endMonth){
            $endDay = +date('d',$endDate);
        }

        // $time = new StdClass;
        $time = array("month" => $month,"startDay" => $startDay, "endDay" => $endDay);

        return $time;
    }

    public static function getDaysNumber( $month, $year)
    {
        // dd(+$month);
        // dd($year);
        switch (+$month) {
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12: return 31;
            case 4:
            case 6:
            case 9:
            case 11: return 30;
            case 2:
            if( (+$year % 4 == 0) && (+$year % 100 != 0)){
                return 29;
            }
            else{
                return 28;
            }

        }
    }

    public static function getMonthsBetween( $strdate1, $strdate2 )
    {
        $months = array();
        $date1 = strtotime($strdate1);
        $date2 = strtotime($strdate2);

        $month = date('m', $date1);
        $year = date('Y', $date1);

        $endMonth = date('m', $date2);
        $endYear = date('Y', $date2);
        while ( ($month != $endMonth) || ($year != $endYear)) {
            if($month <= 12 ){
                $time = array("month"=>$month, "year"=>$year);
                array_push($months,$time);
                $month++;
            }
            else{
                $year++;
                $month = 1;
            }
        }

        //Add end month to array
        $time = array("month"=>$endMonth, "year"=>$endYear);
        array_push($months,$time);

        return $months;
    }

}
