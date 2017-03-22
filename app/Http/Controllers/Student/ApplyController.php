<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;

use App\Http\Requests;

class ApplyController extends \App\Http\Controllers\Controller
{
    public function getApplyRequest(){
    	$position = \Request::get('position');
    	$user_id = \Request::get('user_id');
    	$recruitment_id = \Request::get('recruitment_id');

    	$student_apply = new \App\StudentApply();
    	$student_apply->applied_position = $position;
    	$student_apply->user_id = $user_id;
    	$student_apply->recruitment_id = $recruitment_id;
    	$student_apply->save();
    }
}
