<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getUserNameByID($id){
        $user = \App\User::where('id', $id)->first();
        return $user->name;
    }

    public static function getUserEmailByID($id){
        $user = \App\User::where('id', $id)->first();
        return $user->email;
    }

    public static function getStudentSourceCompanyAvailable($avail_company, $id){
        if(empty($avail_company)){
            $source = \App\User::join('student_infos', 'users.id', '=', 'student_infos.user_id')
            ->where('users.id', $id)
            ->get(['users.name', 'users.email',
                'student_infos.class', 'student_infos.student_number',
                'student_infos.address', 'student_infos.phone',
                'student_infos.is_male', 'student_infos.have_laptop',
                ]);
        }
        else{
            $source = \App\User::join('student_infos', 'users.id', '=', 'student_infos.user_id')
            ->join('available_companies', 'users.id', '=', 'available_companies.user_id')
            ->where('users.id', $id)
            ->get(['users.name', 'users.email',
                'student_infos.class', 'student_infos.student_number',
                'student_infos.address', 'student_infos.phone',
                'student_infos.is_male', 'student_infos.have_laptop',
                'available_companies.name as cpn_name', 'available_companies.address as cpn_address',
                'available_companies.instructor as cpn_instructor', 'available_companies.phone as cpn_phone',
                'available_companies.email as cpn_email', 'available_companies.start_date as cpn_start_date',
                'available_companies.end_date as cpn_end_date'
                ]);
        }
        return $source;
    }
}
