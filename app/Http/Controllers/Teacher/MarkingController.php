<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MarkingController extends Controller
{
    //
    public function viewMarkingList()
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

    public function handleMarking()
    {
        dd($_POST['progress_point/1']);
    }
}
