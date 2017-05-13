<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\rapyd;
use App\Http\Requests;

class AddInfoController extends Controller
{

	// public function __construct()
	// {
	// 	$this->middleware('auth');
	// }


	public function anyShowCv($id){
		if (!\Auth::user()){
			return redirect('/');
		}

		$avail_company = \App\AvailableCompany::where('user_id', $id)->first();
		$source = \App\User::getStudentSourceCompanyAvailable($avail_company, $id);

		$english_certi = \App\StudentEnglishCertificate::where('user_id', $id)->first();
		$registration = \App\Registration::where('user_id', $id)->first();
		$skill_list = \App\StudentProgrammingLanguage::where('user_id', $id)->get(['id', 'language_id', 'level']);

		$form = \DataForm::source($source);

		$form->text('name','Name')->insertValue($source[0]->name)->mode('readonly');
		$form->text('class', 'Lớp')->insertValue($source[0]->class)->mode('readonly');
		$form->text('student_number', 'Mã số sinh viên')->insertValue($source[0]->student_number)->mode('readonly');
		$form->add('is_male', 'Giới tính', 'select')->options(['0' => '--select--', '1' => 'Nam', '2' => 'Nữ'])->rule('not_in:0')->insertValue($source[0]->is_male)->mode('readonly');
		$form->add('have_laptop', 'Có Laptop', 'checkbox')->insertValue($source[0]->have_laptop);
		$form->add('address', 'Địa chỉ', 'textarea')->insertValue($source[0]->address);
		$form->add('phone', 'Số điện thoại', 'text')->insertValue($source[0]->phone);
		$form->text('email', 'Email')->insertValue($source[0]->email)->mode('readonly');
		$form->add('other_description', 'Kỹ năng đã có', 'textarea')->placeholder('Những kỹ năng, kiến thức bạn đã có (Kỹ năng quản trị hệ thống, mạng, các chứng chỉ, kỹ năng mềm, ...)');

		if(empty($english_certi)){
			$form->add('certificate_id', 'Chứng chỉ tiếng anh', 'select')->options(['' => '--select--', '1' => 'IELTS', '2' => 'TOEFL', '3' => 'TOEIC']);
			$form->add('point', 'Điểm tiếng anh', 'text');
		}
		else{
			$form->add('certificate_id', 'Chứng chỉ tiếng anh', 'select')->options(['' => '--select--', '1' => 'IELTS', '2' => 'TOEFL', '3' => 'TOEIC'])->insertValue($english_certi->certificate_id);
			$form->add('point', 'Điểm tiếng anh', 'text')->insertValue($english_certi->point);
		}

		$form->add('language_id', 'Ngôn ngữ lập trình', 'select')->options(['' => '--select--', '1' => 'C', '2' => 'C++', '3' => 'C#', '4' => 'PHP'])->attributes(['name' => 'language_id[]', 'class' => "skill-select"]);

		if(empty($registration)){
			$form->add('desire_skill', 'Kỹ năng muốn học hỏi', 'textarea')->placeholder('Nhập càng chi tiết càng tốt');
		}
		else{
			$form->add('desire_skill', 'Kỹ năng muốn học hỏi', 'textarea')->placeholder('Nhập càng chi tiết càng tốt')->insertValue($registration->wished_skill);
		}



		if(empty($avail_company)){
			$form->add('cpn_name', 'Company Name', 'text');
			$form->add('cpn_address', 'Company Address', 'text');
			$form->add('cpn_instructor', 'Company Instructor', 'text');
			$form->add('cpn_phone', 'Company Phone', 'text');
			$form->add('cpn_email', 'Company Email', 'text');
			$form->add('cpn_start_date', 'Company Start Date', 'text')->placeholder('From');
			$form->add('cpn_end_date', 'Company End Date', 'text')->placeholder('To');
		}
		else{
			$form->add('cpn_name', 'Company Name', 'text')->insertValue($source[0]->cpn_name);
			$form->add('cpn_address', 'Company Address', 'text')->insertValue($source[0]->cpn_address);
			$form->add('cpn_instructor', 'Company Instructor', 'text')->insertValue($source[0]->cpn_instructor);
			$form->add('cpn_phone', 'Company Phone', 'text')->insertValue($source[0]->cpn_phone);
			$form->add('cpn_email', 'Company Email', 'text')->insertValue($source[0]->cpn_email);
			$form->add('cpn_start_date', 'Company Start Date', 'text')->placeholder('From')->insertValue($source[0]->cpn_startdate);
			$form->add('cpn_end_date', 'Company End Date', 'text')->placeholder('To')->insertValue($source[0]->cpn_enddate);
		}
		$form->submit('Save');

		$form->saved(function () use ($form, $english_certi, $avail_company, $registration) {
			$input = \Input::all();
			//dd($input);
			$student_info = \App\StudentInfo::where('user_id', \Auth::id())->first();
			$student_info->have_laptop = $input['have_laptop'];
			$student_info->address = $input['address'];
			$student_info->phone = $input['phone'];
			$student_info->save();

			if(empty($english_certi)){
				$english_certi = new \App\StudentEnglishCertificate();
				$english_certi->user_id = \Auth::id();
				$english_certi->certificate_id = $input['certificate_id'];
				$english_certi->point = $input['point'];
				$english_certi->save();
			}
			else{
				$english_certi->certificate_id = $input['certificate_id'];
				$english_certi->point = $input['point'];
				$english_certi->save();
			}

			if(empty($avail_company)){
				$avail_company = new \App\AvailableCompany();
				$avail_company->user_id = \Auth::id();
				$avail_company->name = $input['cpn_name'];
				$avail_company->instructor = $input['cpn_instructor'];
				$avail_company->phone = $input['cpn_phone'];
				$avail_company->email = $input['cpn_email'];
				$avail_company->start_date = $input['cpn_start_date'];
				$avail_company->end_date = $input['cpn_end_date'];
				$avail_company->save();
			}
			else{
				$avail_company->user_id = \Auth::id();
				$avail_company->name = $input['cpn_name'];
				$avail_company->instructor = $input['cpn_instructor'];
				$avail_company->phone = $input['cpn_phone'];
				$avail_company->email = $input['cpn_email'];
				$avail_company->start_date = $input['cpn_start_date'];
				$avail_company->end_date = $input['cpn_end_date'];
				$avail_company->save();
			}

			if(empty($registration)){
				$registration = new \App\Registration();
				$registration->user_id = \Auth::id();
				$registration->wished_skill = $input['desire_skill'];
				$registration->season = \App\Season::getLastSeasonID();
				$registration->save();
			}
			else{
				$registration->wished_skill = $input['desire_skill'];
				$registration->season = \App\Season::getLastSeasonID();
				$registration->save();
			}

			$skills = $input['language_id'];
			$skill_list = \App\StudentProgrammingLanguage::where('user_id', \Auth::id())->get();
			foreach($skill_list as $skill){
				$skill->delete();
			}

			for($i = 0; $i < count($skills); $i++){
				$new_skill = new \App\StudentProgrammingLanguage();
				$new_skill->user_id = \Auth::id();
				$new_skill->language_id = $skills[$i];
				$new_skill->level = $input["optradio" . ($i+1)];
				$new_skill->save();
			}


			// for($i = 0; $i < count($skills); $i++){
			// 	$skill_list = \App\StudentProgrammingLanguage::where('user_id', \Auth::id())->lists('language_id')->all();

			// 	if(count($skill_list) < 6){
			// 		if(!in_array($skills[$i], $skill_list)){
			// 			$new_skill = new \App\StudentProgrammingLanguage();
			// 			$new_skill->user_id = \Auth::id();
			// 			$new_skill->language_id = $skills[$i];
			// 			$new_skill->level = $input["optradio" . ($i+1)];
			// 			$new_skill->save();
			// 		}
			// 		else{
			// 			$edit_skill = \App\StudentProgrammingLanguage::where('language_id', $skills[$i])->first();
			// 			$edit_skill->level = $input["optradio" . ($i+1)];
			// 			$edit_skill->save();
			// 		}
			// 	}
			// }
			\Session::flash('message', 'Saved');
			$form->link('/', 'Back');
		});
		$form->build();
		return view('student.cv', compact('form', 'avail_company', 'skill_list'));
	}


	public function anyShowProfile(){
		$user_type=\Auth::user()->user_type;
		$user_id=\Auth::user()->id;

		if($user_type==0){
			$info=\DB::table('student_infos')->where('user_id',$user_id)->first();
		// if profile is still nul,add default
			if(is_null($info)){
				\DB::table('student_infos')->insertGetId([
					'user_id'=>\Auth::user()->id,
					]);
				$info=\DB::table('student_infos')->where('user_id',$user_id)->first();
			}

			$name=\DB::table('users')->where('id',$user_id)->first();

			$form=\DataForm::source($info);
			$form->add('name','Name','text')->insertValue($name->name);
			$form->add('class','Class','text')->insertValue($info->class);
			$form->add('student_number','Student Number','text')->insertValue($info->student_number);
			$form->add('is_male','Gender','radiogroup')->option('0','Nữ')->option('1','Nam')->insertValue($info->is_male);
			$form->add('address','Address','text')->insertValue($info->address);
			$form->add('phone','Phone','text')->insertValue($info->phone);
			$form->add('have_laptop','Laptop','checkbox')->insertValue($info->have_laptop);
			$form->add('dob','Birthday','text')->insertValue($info->birthday);
			$form->submit('Save');

			$form->saved(function() use ($form){
				$input=\Input::all();
				if(empty($input['have_laptop']))
					$input['have_laptop'] = 0;
				$info=\App\StudentInfo::where('user_id',\Auth::user()->id)->first();

				$info->class=$input['class'];
				$info->student_number=$input['student_number'];
				$info->is_male=$input['is_male'];
				$info->address=$input['address'];
				$info->phone=$input['phone'];
				$info->have_laptop=$input['have_laptop'];
				$info->birthday=$input['dob'];
				$info->save();

				$info_name=\App\User::where('id',\Auth::user()->id)->first();
				$info_name->name=$input['name'];
				$info_name->save();

				$form->message('Saved');
				$form->link('/','Back');
			});

			$form->build();
			return view('profile',compact('form'));

		// End student profile
	}else if($user_type==1){	//Start teacher profile

		$info=\DB::table('teachers')->where('user_id',$user_id)->first();
		// dd($info);
		// if profile is still null,add default
		if(is_null($info)){
			\DB::table('teachers')->insertGetId([
				'user_id'=>\Auth::user()->id,
				]);
			$info=\DB::table('teachers')->where('user_id',$user_id)->first();
		}
		$name=\DB::table('users')->where('id',$user_id)->first();

		$form=\DataForm::create();
		$form->add('name','Name:','text')->insertValue($name->name);
		$form->add('subject','Subject:','text')->insertValue($info->subject);
		$form->submit('Save');

		$form->saved(function() use ($form){
			$input=\Input::all();
			// dd($input);
			$info=\App\Teacher::where('user_id',\Auth::user()->id)->first();
			$info->subject=$input['subject'];
			$info->save();

			$info_name=\App\User::where('id',\Auth::user()->id)->first();
			$info_name->name=$input['name'];
			$info_name->save();

			$form->message('Saved');
			$form->link('/','Back');
		});

		$form->build();
		return view('profile',compact('form'));


	}else if($user_type==2){// create profile for enterprise instructor

		$info=\App\EnterpriseInstructor::where('user_id',$user_id)->first();
		// if profile is still null,add default
		if(is_null($info)){
			\DB::table('enterprise_instructors')->insertGetId([
				'user_id'=>\Auth::user()->id,
				'company_id'=>'1',
				]);
			$info=\App\EnterpriseInstructor::where('user_id',$user_id)->first();
		}
		$name=\App\User::where('id',$user_id)->first();
		$list_companies=\DB::table('companies')->select('id','name')->orderBy('name','esc')->get();
		// dd($list_companies);
		//Create form
		$form=\DataForm::create();
		$form->add('company','Company:','text')->insertValue($info->company)->mode('readonly');
		$form->add('name','Name:','text')->insertValue($name->name);
		$form->add('phone','Phone:','text')->insertValue($info->phone);
		$form->submit('Save');

		//Save data from input
		$form->saved(function() use ($form){
			$input=\Input::all();

			$info=\App\EnterpriseInstructor::where('user_id',\Auth::user()->id)->first();
			$info->phone=$input['phone'];
			$info->save();

			$info_name=\App\User::where('id',\Auth::user()->id)->first();
			$info_name->name=$input['name'];
			$info_name->save();

			$form->message('Saved');
			$form->link('/','Back');
		});

		$form->build();
		return view('profile',compact('form'));

	}else if($user_type==3){//Edit profile for ENTERPRISE

		$info=\DB::table('enterprises')->where('user_id',$user_id)->first();
		// if profile is still null,add default
		if(is_null($info)){
			\DB::table('enterprises')->insertGetId([
				'user_id'=>\Auth::user()->id,
				'company_id'=>'1',
				]);
			$info=\DB::table('enterprises')->where('user_id',$user_id)->first();
		}

		$name=\DB::table('users')->where('id',$user_id)->first();

		//Create Input Form
		$form=\DataForm::create();
		$form->add('company','Company:','text')->insertValue(\App\Company::getCompanyNameByID($info->company_id))->mode('readonly');
		$form->add('name','Name','text')->insertValue($name->name);
		$form->add('phone','Phone:','text')->insertValue($info->phone);
		$form->submit('Save');

		//Save Data from Input
		$form->saved(function() use ($form){
			$input=\Input::all();

			$info=\App\Enterprise::where('user_id',\Auth::user()->id)->first();
			$info->phone=$input['phone'];
			$info->save();

			$info_name=\App\User::where('id',\Auth::user()->id)->first();
			$info_name->name=$input['name'];
			$info_name->save();

			$form->message('Saved');
			$form->link('/','Back');
		});

		$form->build();
		return view('profile',compact('form'));

	}else if($user_type==4){//Edit profile of INTERSHIP MANAGER

		$info=\DB::table('managers')->where('user_id',$user_id)->first();
		// if profile is still null,add default
		if(is_null($info)){
			\DB::table('managers')->insertGetId([
				'user_id'=>\Auth::user()->id,
				]);
			$info=\DB::table('managers')->where('user_id',$user_id)->first();
		}
		$name=\DB::table('users')->where('id',$user_id)->first();

		//Create Input Form
		$form=\DataForm::create();
		$form->add('name','Name','text')->insertValue($name->name);
		$form->add('phone','Phone:','text')->insertValue($info->phone);
		$form->submit('Save');

		//Save Data from Input
		$form->saved(function() use ($form){
			$input=\Input::all();

			$info=\App\Manager::where('user_id',\Auth::user()->id)->first();
			$info->phone=$input['phone'];
			$info->save();

			$info_name=\App\User::where('id',\Auth::user()->id)->first();
			$info_name->name=$input['name'];
			$info_name->save();

			$form->message('Saved');
			$form->link('/','Back');
		});

		$form->build();
		return view('profile',compact('form'));

	}else if($user_type==5){

		$info=\DB::table('system_managers')->where('user_id',$user_id)->first();
		// if profile is still null,add default
		if(is_null($info)){
			\DB::table('system_managers')->insertGetId([
				'user_id'=>\Auth::user()->id,
				]);
			$info=\DB::table('system_managers')->where('user_id',$user_id)->first();
		}
		$name=\DB::table('users')->where('id',$user_id)->first()->name;

		//Create Input Form
		$form=\DataForm::create();
		$form->add('name','Name','text')->insertValue($name);
		$form->add('phone','Phone:','text')->insertValue($info->phone);
		$form->submit('Save');

		//Save Data from Input
		$form->saved(function() use ($form){
			$input=\Input::all();

			$info=\App\SystemManager::where('user_id',\Auth::user()->id)->first();
			$info->phone=$input['phone'];
			$info->save();

			$info_name=\App\User::where('id',\Auth::user()->id)->first();
			$info_name->name=$input['name'];
			$info_name->save();

			$form->message('Saved');
			$form->link('/','Back');
		});

		$form->build();
		return view('profile',compact('form'));
	}

	return view('profile',compact('form'));
}
}
