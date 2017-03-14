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
		$source = \App\User::join('student_infos', 'users.id', '=', 'student_infos.user_id')
		->where('users.id', $id)
		->get(['users.name', 'users.email',
		'student_infos.class', 'student_infos.student_number',
	]);

	$form = \DataForm::source($source);

	$form->text('name','Name')->insertValue($source[0]->name)->mode('readonly');
	$form->text('class', 'Lớp')->insertValue($source[0]->class)->mode('readonly');
	$form->text('student_number', 'Mã số sinh viên')->insertValue($source[0]->student_number)->mode('readonly');
	$form->add('is_male', 'Giới tính', 'select')->options(['0' => '--select--', '1' => 'Nam', '2' => 'Nữ'])->rule('not_in:0');
	$form->add('have_laptop', 'Có Laptop', 'checkbox');
	$form->add('address', 'Địa chỉ', 'text');
	$form->add('phone', 'Số điện thoại', 'text');
	$form->text('email', 'Email')->insertValue($source[0]->email)->mode('readonly');
	$form->add('certificate_id', 'Chứng chỉ tiếng anh', 'select')->options(['0' => '--select--', '1' => 'IELTS', '2' => 'TOEFL', '3' => 'TOEIC'])->rule('not_in:0');
	$form->add('language_id', 'Ngôn ngữ lập trình', 'select')->options(['0' => '--select--', '1' => 'C', '2' => 'C++', '3' => 'C#', '4' => 'PHP'])->rule('not_in:0');
	$form->add('point', 'Điểm tiếng anh', 'text');
	$form->add('desire_skill', 'Kỹ năng muốn học hỏi', 'textarea')->placeholder('Nhập càng chi tiết càng tốt');
	$form->submit('Save');

	$form->saved(function () use ($form) {
		dd(\Input::all());
	});
	$form->build();
	return view('student.cv', compact('form'));
}

public function anyPersonalInfo($id){
	if (!\Auth::user()){
		return redirect('/');
	}

	$source = \App\User::join('student_infos', 'users.id', '=', 'student_infos.user_id')
	->where('users.id', '1')
	->get(['users.name', 'users.email',
	'student_infos.class', 'student_infos.student_number',
	'student_infos.is_male', 'student_infos.phone',
]);

$form = \DataForm::source($source);

$form->add('name', 'Name', 'text')->insertValue($source[0]->name)->rule('required');
$form->add('class', 'Class', 'select')->options(['VUWIT12B' => 'VUWIT12B', 'LTU12A' => 'LTU12A'])->insertValue($source[0]->class);
$form->add('student_number', 'MSSV', 'text')->insertValue($source[0]->student_number)->rule('required');
$form->add('phone', 'Số điện thoại', 'text')->insertValue($source[0]->phone);
$form->add('is_male', 'Giới tính', 'select')->options(['0' => 'Nam', '1' => 'Nữ'])->insertValue($source[0]->is_male);
$form->add('dob', 'Ngày sinh', 'text')->insertValue($source[0]->dob)->rule('required');

$form->submit('Save');
$form->saved(function () use ($form, $id) {
	$input = \Input::all();

	$student_info = \App\StudentInfo::where('user_id', $id)->first();
	$student_info->birthday = $input['dob'];
	$student_info->phone = $input['phone'];
	$student_info->is_male = $input['is_male'];
	$student_info->student_number = $input['student_number'];
	$student_info->class = $input['class'];
	$student_info->save();

	$user = \App\User::where('id', $id)->first();
	$user->name = $input['name'];
	$user->save();

	\Session::flash('message', 'Thành Công');
});
$form->build();
return view('student.add_personal_info', compact('form'));
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
		// if profile is still null,add default
		if(is_null($info)){
			\DB::table('teachers')->insertGetId([
				'user_id'=>\Auth::user()->id,
			]);
		}
		$name=\DB::table('users')->where('id',$user_id)->first();

		$form=\DataForm::create();
		$form->add('name','Name:','text')->insertValue($name->name);
		$form->add('subject','Subject:','text')->insertValue($info->subject);
		$form->submit('Save');

		$form->saved(function() use ($form){
			$input=\Input::all();

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

		$info=\DB::table('enterprise_instructors')->where('user_id',$user_id)->first();
		// if profile is still null,add default
		if(is_null($info)){
			\DB::table('enterprise_instructors')->insertGetId([
				'user_id'=>\Auth::user()->id,
			]);
		}
		$name=\DB::table('users')->where('id',$user_id)->first();
		$list_companies=\DB::table('companies')->select('id','name')->orderBy('name','esc')->get();

		$form=\DataForm::create();
		$form->add('name','Name','text')->insertValue($name->name);
		$form->add('company','Company:','select')->option('','--Choose--')->option($list_companies)->insertValue($info->name);
		$form->add('phone','Phone:','text')->insertValue($info->phone);
		$form->submit('Save');

		$form->saved(function() use ($form){
			$input=\Input::all();

			$info=\App\EnterpriseInstructor::where('user_id',\Auth::user()->id)->first();
			$info->company_id=$input['company'];
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
			]);
		}

		$name=\DB::table('users')->where('id',$user_id)->first();

		$form=\DataForm::create();
		$form->add('name','Name','text')->insertValue($name->name);
		$form->add('phone','Phone:','text')->insertValue($info->phone);
		$form->submit('Save');

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
		}
		$name=\DB::table('users')->where('id',$user_id)->first();


		$form=\DataForm::create();
		$form->add('name','Name','text')->insertValue($name->name);
		$form->add('phone','Phone:','text')->insertValue($info->phone);

		$form->submit('Save');

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
		}
		$name=\DB::table('users')->where('id',$user_id)->first()->name;


		$form=\DataForm::create();
		$form->add('name','Name','text')->insertValue($name);
		$form->add('phone','Phone:','text')->insertValue($info->phone);

		$form->submit('Save');

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
