<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnterpriseInstructor extends Model
{
    //
    public static function getStudentsInSeason( $season )
    {

        return \App\Company::join('allocations', 'companies.id', '=', 'allocations.company_id')
            ->join('users','users.id','=', 'allocations.student_id')
            ->join('student_infos', 'student_infos.user_id', '=', 'allocations.student_id')
            ->join('timesheets', 'timesheets.id_allocation', '=','allocations.id')
            ->join('enterprise_instructors', 'enterprise_instructors.company_id', '=', 'companies.id')
            ->where([
                ['allocations.season','=', $season],
                ['enterprise_instructors.user_id', '=', \Auth::id()]
            ])
            ->select("allocations.student_id","users.name","student_infos.student_number","timesheets.*")
            ->get();

    }


}
