<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public static function getCompanyNameByID($id){
    	$company = \App\Company::where('id', $id)->first();
    	return $company->name;
    }

    public static function getCompanyAddressByID($id){
    	$company = \App\Company::where('id', $id)->first();
    	return $company->address;
    }
}
