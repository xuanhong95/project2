<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Season;

class Company extends Model
{
    public static function getCompanyNameByID($id){
    	$company = Company::where('id', $id)->first();
    	return $company->name;
    }

    public static function getCompanyAddressByID($id){
    	$company = Company::where('id', $id)->first();
    	return $company->address;
    }

    public static function getCompanies(Season $season )
    {
        return Company::join("enterprises","enterprises.company_id",'=',"companies.id")
            ->join("recruitments","recruitments.user_id",'=',"enterprises.user_id")
            ->where("recruitments.season", '=', $season->id )
            ->select("companies.*")
            ->get();
    }

}
