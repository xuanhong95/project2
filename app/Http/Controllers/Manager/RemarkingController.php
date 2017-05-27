<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RemarkingController extends Controller
{
    //
    public function editPoint()
    {
        $lastSeason = \App\Season::getLastSeasonID();
        $teacher_id = \Auth::id();

        $students = \App\Allocation::getStudentsOfTeacherInSeason($teacher_id, $lastSeason);
        $resultOfStudents = \App\Result::getResultOfStudents( $students );
        $message = null;

        if(\Request::isMethod("post")){
            foreach ($resultOfStudents as $key => $resultOfStudent) {
                $result = \App\Result::where("user_id",'=',$resultOfStudent->user_id)
                    ->orderBy("id","desc")
                    ->first();
                if($result == null){
                    $result = new \App\Result;
                    $result->user_id = $resultOfStudent->user_id;
                }
                $result->progress_point = $_POST["progress_point/".$resultOfStudent->user_id];
                $result->exam_point = $_POST["exam_point/".$resultOfStudent->user_id];
                $result->save();
            }
            return back();
        }

        return view('teacher.marking', compact("resultOfStudents","message"));
    }

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
