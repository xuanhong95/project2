<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Season;
use App\Allocation;
use App\Registration;
use App\Recruitment;
use App\StudentInfo;
use App\EnterpriseInstructor;
use App\Company;
use App\Teacher;

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

    public function viewTopic($recruitment_id)
    {
        $topic = \App\Recruitment::where('recruitments.id',$recruitment_id)->first();

        $enterprise_info = \App\Enterprise::where('user_id',$topic->user_id)->first();

        $enterprise_account=\App\User::where('id',$enterprise_info->user_id)->first();

        $company=\App\Company::where('id',$enterprise_info->company_id)->first();

        $recruitment_contents=\App\RecruitmentContent::where('recruitment_id',$recruitment_id)->get();

        $student_apply = \App\StudentApply::where('user_id', \Auth::id())
                                            ->where('recruitment_id', $recruitment_id)
                                            ->first();

        return view('home.topic_detail', compact('topic', 'enterprise_info','enterprise_account', 'student_apply',
                                                 'company', 'recruitment_contents'));
    }

    public function viewAllocation(Season $season = null)
    {
        if($season->exists == false){
            $season = Season::getLastSeason();
        }

        $companies = Company::getCompanies($season);
        $teachers = Teacher::getAllTeachers();
        $internshipStatus = Allocation::getInternshipStatus($season);
        $noCompanyStudents = StudentInfo::getNoCompanyStudents($season);
// dd($internshipStatus);
// dd($noCompanyStudents);
        return view('internship.allocations-status',
            compact("noCompanyStudents","companies","season","teachers",
                    "internshipStatus"));
    }

    public function viewResult(Season $season = null)
    {

        if($season->exists == false){
            $season = \App\Season::getLastSeason();
        }

        $students = \App\StudentInfo::getStudentsInSeason($season);

        $resultOfStudents = \App\Result::getResultOfStudents( $students );
        $message = null;

        if(\Request::isMethod("post")){
            foreach ($resultOfStudents as $key => $resultOfStudent) {
                $result = \App\Result::where("user_id",'=',$resultOfStudent->user_id)
                    ->orderBy("id","desc")
                    ->first();
                if($result == null){
                    $result = new \App\Result;
                    $result->user_id = $resultOfStudent->user_id;
                }
                $result->progress_point = $_POST["progress_point/".$resultOfStudent->user_id];
                $result->exam_point = $_POST["exam_point/".$resultOfStudent->user_id];
                $result->save();
            }
            return back();
        }

        return view('internship.result', compact("resultOfStudents","message"));
    }
}
