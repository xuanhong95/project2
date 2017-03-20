<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;

class RecruitmentController extends \App\Http\Controllers\Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRecruitments()
    {
        $lastSeason=\App\Season::orderBy('id','desc')->first();
        $recruitments=\App\Recruitment::join('enterprises', 'recruitments.user_id', '=', 'enterprises.user_id')
                                        ->join('companies', 'companies.id','=','enterprises.company_id')
                                        ->where('recruitments.season','=',$lastSeason->id)
                                        ->select('recruitments.id','companies.name','recruitments.is_confirm')
                                        ->get();
        // dd($recruitments);
        return view('manager.recruitments',compact('recruitments','lastSeason'));
    }

    public function readRecruitment($recruitment_id)
    {
        //get related objects with recruitment
        $recruitment=\App\Recruitment::where('id',$recruitment_id)->first();

        $enterprise_info=\App\Enterprise::where('user_id',$recruitment->user_id)->first();

        $enterprise_account=\App\User::where('id',$enterprise_info->user_id)->first();

        $company=\App\Company::where('id',$enterprise_info->company_id)->first();

        $recruitment_contents=\App\RecruitmentContent::where('recruitment_id',$recruitment_id)->get();



        $form = \DataForm::create();

        //Table Company Data
        $form->add('name', 'Tên công ty', 'text')->insertValue($company->name)->mode('readonly');

        $form->add('address', 'Địa chỉ', 'text')->insertValue($company->address)->mode('readonly');

        //Table User Data
        $form->add('enterprise', 'Cán bộ phụ trách', 'text')->insertValue($enterprise_account->name)->mode('readonly');
        $form->add('email', 'Email', 'text')->placeholder("pxhong@donuts.biz.vn")->insertValue($enterprise_account->email)->mode('readonly');

        //Table Enterprise Data
        $form->add('phone', 'Điện thoại', 'text')->placeholder("0947383678")->insertValue($enterprise_info->phone)->mode('readonly');

        //Table recruitment Data
        $form->add('quantity', 'Số lượng', 'text')->attributes(['style' => 'width: 10%; margin-top: -7px'])->insertValue($recruitment->quantity)->mode('readonly');
        $form->add('season', 'Season', 'text')->insertValue($recruitment->season)->mode('readonly');

        $form->build();


        return view('manager.read-recruitment',compact('form','recruitment_contents'));
    }

    public function getConfirmedRecruitments()
    {
        return \App\Recruitment::whereNot('is_confirm',null)->get();
    }

    public function getUnconfirmedRecruitments()
    {
        return \App\Recruitment::where('is_confirm',null)->get();
    }

    public function acceptRecruitment($id){
        $acceptedRecruitment=\App\Recruitment::where('id',$id)->first();
        $acceptedRecruitment->is_confirm=1;
        $acceptedRecruitment->save();
        return redirect()->route('manager-recruitments');
    }

    public function denyRecruitment($id){
        $deniedRecruitment=\App\Recruitment::where('id',$id)->first();
        $deniedRecruitment->is_confirm=0;
        $deniedRecruitment->save();
        return redirect()->route('manager-recruitments');
    }
}
