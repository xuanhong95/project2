<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    public static function getEnterpriseNameByID($id){
    	$enterprise = \App\User::where('id', $id)->first();
    	return $enterprise->name;
    }
}
