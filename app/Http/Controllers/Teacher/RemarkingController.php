<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RemarkingController extends Controller
{
    //
    public function editPoint()
    {
        $lastSeason = \App\Season::getLastSeasonID();

        $students = \App\Allocation::getAllStudentInSeason($lastSeason);
        $resultOfStudents = \App\Result::getResultOfStudentsObj( $students );
        $message = null;

        if(\Request::isMethod("post")){
            foreach ($resultOfStudents as $key => $resultOfStudent) {
                $result = \App\Result::where("user_id",'=',$resultOfStudent->user_id)
                ->first();
                $edit_progress_point = $_POST["progress_point/".$resultOfStudent->user_id];
                $edit_exam_point = $_POST["exam_point/".$resultOfStudent->user_id];
                if($result == null){
                 $result = new \App\Result;
                 $result->user_id = $resultOfStudent->user_id;
                }
                if(($result->progress_point == $edit_progress_point)
                    && ($result->exam_point == $edit_exam_point)){
                    continue;
                }

                $result->edit_progress_point = $edit_progress_point;
                $result->edit_exam_point = $edit_exam_point;
                $result->save();
                }
                return back();
            }

        return view('teacher.marking', compact("resultOfStudents","message"));
    }

    public function approvePoint($id){
        if(\Auth::user()->user_type != 4)
            return "False";
        $result = \App\Result::where('user_id', $id)->first();
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
        if(\Auth::user()->user_type != 4)
            return "False";

        $result = \App\Result::where('user_id', $id)->first();
        $result->edit_progress_point = null;
        $result->edit_exam_point = null;
        $result->save();
        return "Success";
    }
}
