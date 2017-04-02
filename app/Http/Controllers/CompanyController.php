<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CompanyController extends Controller
{

    public function showRecruitments()
    {
        $lastSeason=\App\Season::orderBy('id','desc')->first();
        $recruitments=\App\Recruitment::where('season',$lastSeason->id)->get();
        return view('recruitments',compact('recruitments'));
    }

    /*THis function provide infos of companies attending recruitment
    in Season
    parameter: $season :define the season to show companies, default is null
    output:

    */
    public function showCompanies($season_id = null)
    {
        if (is_null($season_id)){
            $season = \App\Season::getOpenningSeason();
        }
        else{
            $season = \App\Season::getSeasonByID( $season_id );
        }

        $enterprises_recruitments = \App\Recruitment::where([
            ['is_confirm','=','1'],
            ['updated_at','>=',$season->start_date],
            ['updated_at','<=',$season->end_date]
        ])
        ->distinct()
        ->get();

        $companies_list = array();
        //get student infomations through registration->user_id
        foreach ($enterprises_recruitments as $recruitment) {
            $company = \App\User::join('enterprises','user_id','=','users.id')
                ->join('companies','company_id','=','companies.id')
                ->where('user_id','=',$recruitment->user_id)
                ->select('companies.name','address')
                ->first();
            array_push($companies_list, $company);
        }
        // dd($student_registrations);
        $all_season_id = \App\Season::getAllSeasonIDs();

        return view('internship.companies-in-season',compact('companies_list','all_season_id'));
    }


}
