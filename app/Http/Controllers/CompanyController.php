<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CompanyController extends Controller
{
    public function anyRegister(){
        if(\Auth::user()->user_type != 3){
            return redirect('/');
        }

        $source = \App\Enterprise::where('user_id', \Auth::id())->first();

        $form = \DataForm::create();

        //Table Company Data
        $form->add('name', 'Tên công ty', 'text')->insertValue(\App\Company::getCompanyNameByID($source->company_id))->mode('readonly');

        $form->add('address', 'Địa chỉ', 'text')->insertValue(\App\Company::getCompanyAddressByID($source->company_id))->mode('readonly');

        //Table User Data
        $form->add('enterprise_instructor', 'Cán bộ phụ trách', 'text')->insertValue(\Auth::user()->name)->rule('required');
        $form->add('email', 'Email', 'text')->placeholder("pxhong@donuts.biz.vn")->insertValue(\Auth::user()->email)->mode('readonly');

        //Table Enterprise Data
        $form->add('phone', 'Điện thoại', 'text')->placeholder("0947383678")->insertValue($source->phone);

        //Table recruitment Data
        $form->add('quantity', 'Số lượng', 'text')->attributes(['style' => 'width: 10%; margin-top: -7px']);
        $form->add('season', 'Season', 'select')->options(['0'=>'1', '1' => '2']);

        //Table recruitment content Data
        $form->add('position', 'Vị trí', 'redactor')->placeholder("Web Developer")->attributes(['name'=>'position[]']);
        $form->add('content', 'Nội dung', 'redactor')->placeholder("Tuyển dụng lập trình web")->attributes(['name'=>'content[]']);
        $form->add('require', 'Yêu cầu', 'redactor')->placeholder("Biết PHP")->attributes(['name'=>'require[]']);

        $form->submit('Register');

        $form->saved(function () use ($form) {
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

            $recruit_table = new \App\Recruitment();
            $recruit_table->user_id = \Auth::id();
            $recruit_table->quantity = $input['quantity'];
            $recruit_table->season = $input['season'];
            $recruit_table->save();

            $this_recruitment = \App\Recruitment::orderBy('created_at', 'desc')->first();

            for($i = 0; $i < count($positions); $i++){
                $recruit_content_table = new \App\RecruitmentContent();
                $recruit_content_table->recruitment_id = $this_recruitment->id;
                $recruit_content_table->position = $positions[$i];
                $recruit_content_table->job_description = $contents[$i];
                $recruit_content_table->requirement = $requires[$i];
                $recruit_content_table->save();
            }

            $form->message('Saved');
            $form->link('/','Back');
        });
        $form->build();
        return view('company.company_register', compact('form'));
    }
}
