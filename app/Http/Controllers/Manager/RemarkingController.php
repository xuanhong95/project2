<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RemarkingController extends Controller
{
    //
    public function approvePoint($id){
        if(\Auth::user()->user_type != 5)
            return "False";
        $result = \App\Result::find($id);
        $arr_return = [];
        if(!empty($result->edit_progress_point)){
            $result->progress_point = $result->edit_progress_point;
            $result->edit_progress_point = null;
        }
        if(!empty($result->edit_exam_point)){
            $result->exam_point = $result->edit_exam_point;
            $result->edit_exam_point = null;
        }
        array_push($arr_return, $result->progress_point);
        array_push($arr_return, $result->exam_point);
        $result->save();

        return $arr_return;
    }

    public function declinePoint($id){
        if(\Auth::user()->user_type != 5)
            return "False";
        $result = \App\Result::find($id);
        $result->edit_progress_point = null;
        $result->edit_exam_point = null;
        $result->save();
        return "Success";
    }
}
