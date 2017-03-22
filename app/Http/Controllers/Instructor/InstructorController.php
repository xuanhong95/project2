<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InstructorController extends Controller
{
    //
    public function showStudents()
    {
        $currentSeason = \App\Season::getOpenningSeason();
        $students = \App\Allocation::where([
            ['instructor_id',\Auth::id()],
            ['']
            ])->get();
    }
}
