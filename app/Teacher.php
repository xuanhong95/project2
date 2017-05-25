<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StudentInfo;
use App\Season;

class Teacher extends Model
{
    //
    public static function getAllTeachers()
    {
        return Teacher::join("users","users.id","=","teachers.user_id")
            ->select("users.name","teachers.*")
            ->get();
    }

    public static function getTeacher(StudentInfo $student, Season $season)
    {
        return Teacher::join("allocations",
                "allocations.teacher_id",'=',"teachers.user_id")
                ->join("users","users.id",'=',"teachers.user_id")
            ->where([
                ["allocations.student_id", '=', $student->user_id],
                ["allocations.season", '=', $season->id]
            ])
            ->select("users.name","teachers.*")
            ->first();
    }
}
