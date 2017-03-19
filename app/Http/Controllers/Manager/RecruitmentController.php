<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;

class RecruitmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRecruitments()
    {
        $lastSeason=\App\Season::orderBy('id','desc')->first();
        $recruitments=\App\Recruitment::where('season',$lastSeason->id)->get();
        return view('recruitments',compact('recruitments'));
    }

    public function getConfirmedRecruitments()
    {
        return \App\Recruitment::whereNot('is_confirm',null)->get();
    }

    public function getUnconfirmedRecruitments()
    {
        return \App\Recruitment::where('is_confirm',null)->get();
    }
}
