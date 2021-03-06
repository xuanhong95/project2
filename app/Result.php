<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //

    public static function getResultOfStudents( $students ){
        $results = array();
        $result = null;
        $students = json_decode($students);
        for( $i = 0; $i < count($students); $i++){
            $result = \App\Result::where("user_id",'=',$students[$i]->user_id)
                ->orderBy("id","desc")->first();
            $students[$i]->progress_point = $result ==null? null: $result->progress_point;
            $students[$i]->exam_point = $result ==null? null:$result->exam_point;
            $students[$i]->edit_progress_point = $result ==null? null: $result->edit_progress_point;
            $students[$i]->edit_exam_point = $result ==null? null:$result->edit_exam_point;
        }
        return $students;
    }

    public static function getResultOfStudentsObj( $students ){
        $results = array();
        $result = null;
        $students = json_decode($students);
        for( $i = 0; $i < count($students); $i++){
            $result = \App\Result::where("user_id",'=',$students[$i]->student_id)
                ->orderBy("id","desc")->first();
            $students[$i]->progress_point = $result ==null? null: $result->progress_point;
            $students[$i]->exam_point = $result ==null? null:$result->exam_point;
            $students[$i]->edit_progress_point = $result ==null? null: $result->edit_progress_point;
            $students[$i]->edit_exam_point = $result ==null? null:$result->edit_exam_point;
        }
        return $students;
    }
}
