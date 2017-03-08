<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    //
    protected $fillable=[
        'class','student_number','phone','address','is_male','dob','have_laptop',
    ];
}
