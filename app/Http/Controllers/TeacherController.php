<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TeacherController extends Controller
{
    //
    public function getIndex(){
        return view('home');
    }

    public function showSeasons(){
        $seasons=\DB::table('seasons')->get();
        // dd($seasons);
        return view('teacher.seasons',compact('seasons'));
    }

    public function showCreateSeasonPage(){
        $season=\DB::table('seasons')->count('id')+1;

        $form=\DataForm::source(new \App\Season);
        $form->add('start_date','start_date:','text');
        $form->add('register_deadline','register_deadline:','text');
        $form->add('submit_result_deadline','submit_result_deadline:','text');
        $form->add('remarking_deadline','remarking_deadline:','text');
        $form->add('end_date','end_date:','text');
        $form->submit('Start new season');

        $form->saved(function () use($form){
            $form->message("Saved");
            $form->link('/teacher/seasons','Back');
        });
        $form->build();

        return view('teacher.create-season',compact('form','season'));
    }

    public function showSeasonInfo($season){
        $form=\DataForm::source(\App\Season::where('id',$season)->first());
        $form->add('start_date','start_date:','text');
        $form->add('register_deadline','register_deadline:','text');
        $form->add('submit_result_deadline','submit_result_deadline:','text');
        $form->add('remarking_deadline','remarking_deadline:','text');
        $form->add('end_date','end_date:','text');
        $form->submit('Save');

        $form->saved(function () use($form){
            $form->message("Saved");
        });
        $form->build();

        return view('teacher.edit-season',compact('form','season'));
    }
}
