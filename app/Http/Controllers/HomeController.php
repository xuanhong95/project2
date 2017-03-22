<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function anyIndex()
    {
        return view('home');
    }

    public function viewTopicList(){
        $list_topic = \App\Recruitment::join('enterprises', 'enterprises.user_id', '=', 'recruitments.user_id')
                                        ->where('recruitments.is_confirm', 1)
                                        ->orderBy('recruitments.id', 'desc')
                                        ->get(['recruitments.id','enterprises.company_id',
                                                'recruitments.user_id', 'recruitments.quantity']);
        return view('home.topics', compact('list_topic'));
    }

    public function viewTopic($recruitment_id){
        $topic = \App\Recruitment::where('recruitments.id',$recruitment_id)->first();

        $enterprise_info=\App\Enterprise::where('user_id',$topic->user_id)->first();

        $enterprise_account=\App\User::where('id',$enterprise_info->user_id)->first();

        $company=\App\Company::where('id',$enterprise_info->company_id)->first();

        $recruitment_contents=\App\RecruitmentContent::where('recruitment_id',$recruitment_id)->get();

        $student_apply = \App\StudentApply::where('user_id', \Auth::id())
                                            ->where('recruitment_id', $recruitment_id)
                                            ->first();

        return view('home.topic_detail', compact('topic', 'enterprise_info',                                     'enterprise_account', 'student_apply',
                                                 'company', 'recruitment_contents'));
    }
}
