<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    //
    protected $fillable=[
        'class','student_number','phone','address','is_male','dob','have_laptop',
    ];

    public static function getStudentsInSeason($season){
    
        return \App\User::join('registrations','users.id','=','registrations.user_id')
            ->where("registrations.season",'=',$season)
            ->get();
    }

    public static function getStudentNumberByID( $student_id )
    {
        $student = \App\StudentInfo::where("user_id",'=', $student_id)->select("student_number")->first();

        return $student->student_number;
    }
}
