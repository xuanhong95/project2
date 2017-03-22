<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\rapyd;
use App\Http\Requests;

class ReportController extends \App\Http\Controllers\Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function anyIndex(){
		dd('index');
	}

	public function showStudentReport(){
		$student_info=\DB::table('student_infos')
			->where('user_id','=',\Auth::user()->id)
			->select('student_number','phone','class')
			->first();

		if( is_null( $student_info ) ){
			return redirect()->route('profile');
		}

		$form=\DataForm::create( new \App\StudentReport);

		$form->add('student_name','Họ và tên','text')
			->insertValue(\Auth::user()->name)
			->mode('readonly');
		$form->add('student_number','Mã số sinh viên','text')
			->insertValue($student_info->student_number)
			->mode('readonly');
		$form->add('student_class','Lớp:','text')
			->insertValue($student_info->class)
			->mode('readonly');
		$form->add('student_phone','Số điện thoại:','text')
			->insertValue($student_info->phone)
			->mode('readonly');
		$form->add('student_email','Email:','text')
			->insertValue(\Auth::user()->email)
			->mode('readonly');
		$form->add('company_address','Address:','text')
			->rule('required');
		$form->add('company_guide','Enterprise Instructor:','text')
			->rule('required');
		$form->add('time_from','From:','text')
			->rule('required');
		$form->add('time_to','To:','text')
			->rule('required');
		$form->add('guide_teacher','Instructor Teacher','text')
			->rule('required');
		$form->add('work_purpose','Internship Purpose:','redactor')
			->rule('required');
		$form->add('work_content','Job Contents','redactor')
			->rule('required');
		$form->add('result','Result:','redactor')
			->rule('required');
		$form->add('student_advantage','Advantages:','redactor')
			->rule('required');
		$form->add('student_shortcoming','Shortcoming:','redactor')
			->rule('required');
		$form->submit('Submit');

		$form->saved(function() use($form){
			$student_report = new \App\StudentReport;
			$input=\Input::all();


			$form->message('Saved');
			$form->link('route('/')','Back');
		});


		$form->build();
		return view('student.report',compact('form','student_info'));
	}
}
