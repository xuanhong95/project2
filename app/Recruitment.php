<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    public static function getRecruitmentConfirmation($recruitment_id)
    {
        $recruitment = \App\Recruitment::where('id', $recruitment_id)->first();

        if( is_null($recruitment->is_confirm) ){
            return "Unapproved";
        }
        elseif( $recruitment->is_confirm == 1 ){
            return "Accepted";
        }
        else {
            return "Declined";
        }
    }

    public static function getAllCompanyRecruitments($enterprise_id)
    {
        return \App\Recruitment::where("user_id", $enterprise_id)->get();
    }

    public static function getCompanyRecruitmentSeason($season_id, $enterprise_id)
    {
        return \App\Recruitment::where([
            ["season", "=", $season_id],
            ["user_id", "=", $enterprise_id]
        ])->first();
    }

    public static function getRecruimentSeason($season)
    {
        return \App\Recruitment::where("season", $season)->first();
    }

    public static function getConfirmedRecruitments()
    {
        return \App\Recruitment::whereNot('is_confirm',null)->get();
    }

    public static function getUnconfirmedRecruitments()
    {
        return \App\Recruitment::where('is_confirm',null)->get();
    }

    public static function getCompaniesInSeason( $season_id )
    {
        return \App\Recruitment::join("enterprises","enterprises.user_id","=","recruitments.user_id")
            ->join("companies","companies.id",'=', "enterprises.company_id")
            ->where("recruitments.season",'=', $season_id)
            ->select("companies.id","companies.name")
            ->get();
    }
}
