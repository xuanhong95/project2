<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;

class SeasonController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function showSeasons()
    {
        $seasons=\DB::table('seasons')->get();
        // dd($seasons);
        return view('manager.seasons',compact('seasons'));
    }

    public function showCreateSeason()
    {
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
            $form->link(route('seasons'),'Back');
        });
        $form->build();

        return view('manager.create-season',compact('form','season'));
    }

    public function showSeasonInfo($season)
    {
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

        return view('manager.edit-season',compact('form','season'));
    }

    


}
