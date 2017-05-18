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

        return view('teacher.marking', compact("students"));
    }
}
