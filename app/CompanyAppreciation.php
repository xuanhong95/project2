<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAppreciation extends Model
{
    //
    public static function getAppreciationByAllocationID( $id_allocation )
    {
        return \App\CompanyAppreciation::where('id_allocation',$id_allocation)->first();
    }


}
