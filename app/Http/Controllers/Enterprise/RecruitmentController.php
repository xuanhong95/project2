<?php

namespace App\Http\Controllers\Enterprise;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RecruitmentController extends Controller
{
    public function showRecruitments()
    {
        $createRecruitmentEnable = \App\Recruitment::creatable( \Auth::id() );
        $recruitments = $this->getAllCompanyRecruitment(\Auth::id());

        return view('enterprise.recruitments', compact('recruitments','createRecruitmentEnable'));
    }

    /**
    *  This function return all recruitments created by enterprise
    * return: $recruitments :contain recruitments informations
    */
    public function getAllCompanyRecruitment()
    {
        return \App\Recruitment::getAllCompanyRecruitments(\Auth::id());
    }

    /**
    *  This function return recruitment in a season
    * param: $season_id     :id of choosen season, default = last sesson id.
    * return: $recruitment :contain recruitment information in season.
    */
    public function getCompanyRecruitmentSeason($season_id = null)
    {
        //set default season if input null
        if (is_null($season_id)) {
            $season = \App\Season::getLastSeason();
            $season_id = $season->id;
        }

        $recruitment = \App\Recruitment::getCompanyRecruitmentSeason($season_id, \Auth::id());

        return $recruitment;
    }

    /**
    * This function return view for enterprise to make recruitment
    * return: $form     :to get infos of recruitment
    * return: $season   :to define the season
    * return: $recruitment_content :to insertValue to content
    *        if recruitment in this seasons is created before
    */
    public function createRecruitment(){
        if(\Auth::user()->user_type != 3 && \Auth::user()->user_type != 6){
            return redirect('/');
        }
        $season = \App\Season::getOpenningSeasonID();
        if(is_null($season)){
            $error = "There's no openning season";
            $link = route('homepage');
            return view('errors.error',compact('error','link'));
        }

        $enterprise_info = \App\Enterprise::where('user_id', \Auth::id())->first();
        if(is_null($enterprise_info)){
            $error = "You need to update your profile first!!!";
            $link = route('homepage');
            return view('errors.error',compact('error','link'));
        }

        $recruitment_this_season = \App\Recruitment::where([
            ['user_id','=',\Auth::id()],
            ['season','=',$season]
            ])->first();
            // dd($recruitment_this_season);
            if(is_null($recruitment_this_season)){
                $recruitment_this_season = new \App\Recruitment();
                $recruitment_content = new \App\RecruitmentContent();
            }
            else{
                $recruitment_content = \App\RecruitmentContent::where('recruitment_id',$recruitment_this_season->id)
                ->get();
            }

            $form = \DataForm::create();

            //Table Company Data
            $form->add('name', 'Tên công ty', 'text')->insertValue(\App\Company::getCompanyNameByID($enterprise_info->company_id))->mode('readonly');

            $form->add('address', 'Địa chỉ', 'text')->insertValue(\App\Company::getCompanyAddressByID($enterprise_info->company_id))->mode('readonly');

            //Table User Data
            $form->add('enterprise_instructor', 'Cán bộ phụ trách', 'text')->insertValue(\Auth::user()->name)->rule('required');
            $form->add('email', 'Email', 'text')->placeholder("pxhong@donuts.biz.vn")->insertValue(\Auth::user()->email)->mode('readonly');

            //Table Enterprise Data
            $form->add('phone', 'Điện thoại', 'text')->placeholder("0947383678")->insertValue($enterprise_info->phone);

            //Table recruitment Data
            $form->add('quantity', 'Số lượng', 'text')
            ->attributes(['style' => 'width: 10%; margin-top: -7px'])
            ->insertValue($recruitment_this_season->quantity)
            ->rule('required');
            //Table recruitment content Data
            $form->add('position', 'Vị trí', 'redactor')->placeholder("Web Developer")->attributes(['name'=>'position[]']);
            $form->add('content', 'Nội dung', 'redactor')->placeholder("Tuyển dụng lập trình web")->attributes(['name'=>'content[]']);
            $form->add('require', 'Yêu cầu', 'redactor')->placeholder("Biết PHP")->attributes(['name'=>'require[]']);

            $form->submit('Register');

            $form->saved(function () use ($form,$season,$recruitment_this_season,$recruitment_content) {
                $input = \Input::all();
                $positions = $input['position'];
                $contents = $input['content'];
                $requires = $input['require'];

                $user_table = \App\User::where('id', \Auth::id())->first();
                $user_table->name = $input['enterprise_instructor'];
                $user_table->save();

                $enterprise_table = \App\Enterprise::where('user_id', \Auth::id())->first();
                $enterprise_table->phone = $input['phone'];
                $enterprise_table->save();

                $recruit_table = $recruitment_this_season;
                $recruit_table->user_id = \Auth::id();
                $recruit_table->quantity = $input['quantity'];
                $recruit_table->season = $season;
                $recruit_table->is_confirm = null;
                $recruit_table->save();

                $recruitment_this_season = \App\Recruitment::where([
                    ['user_id','=',\Auth::id()],
                    ['season','=',$season]
                    ])->first();

                    \App\RecruitmentContent::where('recruitment_id',$recruitment_this_season->id)
                    ->delete();

                    for($i = 1; $i < count($positions); $i++){
                        $recruit_content_table = new \App\RecruitmentContent();
                        $recruit_content_table->recruitment_id = $recruitment_this_season->id;
                        $recruit_content_table->position = $positions[$i];
                        $recruit_content_table->job_description = $contents[$i];
                        $recruit_content_table->requirement = $requires[$i];
                        $recruit_content_table->save();
                    }

                    $form->message('Saved');
                    $form->link('/','Back');
                });
                $form->build();


                return view('company.company_register', compact('form','season','recruitment_content'));
            }
            /**
            * This function return view of a recruitment created by enterprise
            * param: recruitment_id     : id of recruitment
            * return: view read-recruitment     : view
            * return: form      : form in view
            * return: recruitment_contents  :content of recruitment
            */
            public function readRecruitment($recruitment_id)
            {
                //get related objects with recruitment
                $recruitment = \App\Recruitment::where('id',$recruitment_id)->first();

                $enterprise_info = \App\Enterprise::where('user_id',$recruitment->user_id)->first();

                $enterprise_account = \App\User::where('id',$enterprise_info->user_id)->first();

                $company = \App\Company::where('id',$enterprise_info->company_id)->first();

                $recruitment_contents = \App\RecruitmentContent::where('recruitment_id',$recruitment_id)->get();


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

                return view('enterprise.read-recruitment',compact('form','recruitment','recruitment_contents'));
            }
        }
