<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CompanyController extends Controller
{
    /*This function show all recruitments in lastSeason
        @return: view recruitments
        @return: $recruitments   :contain recruitment's general infos
    */
    public function showRecruitments()
    {
        $lastSeason=\App\Season::orderBy('id','desc')->first();
        $recruitments=\App\Recruitment::where('season',$lastSeason->id)->get();
        return view('recruitments',compact('recruitments'));
    }




    /*THis function provide infos of companies attending recruitment in Season
    *
    @param: $season :define the season to show companies, default is null
    @return: $companies_list :contain companies's infos in season
    @return: $all_season_id :id of all seasons
    */
    public function showCompanies($season_id = null)
    {
        if (is_null($season_id)){
            $season_id = \App\Season::getLastSeasonID();
        }

        $enterprises_recruitments = \App\Recruitment::where([
            ['is_confirm','=','1'],
            ['season','=',$season_id]
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




    /*This function return infos of chose recruitment in showTopicList
        @param: $topic_id   :define chose topic
        @return: view errors.error : topic_id is not valid
        @return: view recruitment-detail
        @return: $recruitment : contain general infos
        @return: $recruitment_contents :contain details infos
    */
    public function showTopicDetails($topic_id)
    {
        $recruitment = \App\Recruitment::where([
            ['id','=',$topic_id],
            ['is_confirm','=',1]
            ])->first();

        if(is_null($recruitment)){
            $error = "This topic was not created or confirmed";
            $link = route('view-topics');


            return view('errors.error',compact('error','link'));
        }
    }

    public function viewTimesheet()
    {
        $lastSeason = \App\Season::getLastSeasonID();

        $companiesInSeason = \App\Recruitment::getCompaniesInSeason( $lastSeason );

        return view('internship.timesheet',compact("lastSeason","companiesInSeason"));
    }

    public function getTimesheetsOfCompanyInSeason()
    {
        $input = \Input::all();

        $timesheetOfStudents = \App\Timesheet::join('allocations',"timesheets.id_allocation",'=','allocations.id')
            ->join('users', 'users.id', '=', 'allocations.student_id')
            ->join('student_infos', 'student_infos.user_id', '=', 'users.id')
            ->where([
                ["allocations.company_id", '=', $input['company_id']],
                ["allocations.season", '=', $input['season']]
            ])
            ->select("users.name","student_infos.student_number")
            ->get();

        return $timesheetOfStudents;
    }

}
