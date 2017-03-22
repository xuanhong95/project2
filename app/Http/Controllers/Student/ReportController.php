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

		$student_allocation = \App\Allocation::where('student_id',\Auth::id())
			->orderBy('allocations.id','desc')
			->first();

		$company = \App\Company::where('id',$student_allocation->company_id)->first();
		$teacher = \App\User::where('id',$student_allocation->teacher_id)->first();
		$instructor = \App\User::where('id',$student_allocation->instructor_id)->first();
		$season = \App\Season::where('id',$student_allocation->season)->first();

		if( is_null( $student_allocation ) ){
			return "You are not in any companies!";
		}
		if( \App\Season::is_closedSeason( $season ) ){
			return "Season ".$student_allocation->season." closed!";
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
		$form->add('company_name','Company:','text')
			->insertValue($company->name)
			->mode('readonly');
		$form->add('company_address','Address:','text')
			->insertValue($company->address)
			->mode('readonly');
		$form->add('company_guide','Enterprise Instructor:','text')
			->insertValue( $instructor->name )
			->mode('readonly');
		$form->add('time_from','From:','text')
			->insertValue( $season->start_date )
			->mode('readonly');
		$form->add('time_to','To:','text')
			->insertValue( $season->end_date )
			->mode('readonly');
		$form->add('guide_teacher','Instructor Teacher','text')
			->insertValue( $teacher->name )
			->mode('readonly');
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
			$student_allocation = \App\Allocation::where('student_id',\Auth::id())
				->orderBy('id','desc')
				->first();

			$input=\Input::all();

			$student_report->id_allocation = $student_allocation->id;
			$student_report->purpose = $input['work_purpose'];
			$student_report->job_content = $input['work_content'];
			$student_report->result = $input['result'];
			$student_report->advantage = $input['student_advantage'];
			$student_report->shortcoming = $input['student_shortcoming'];
			$student_report->save();

			$form->message('Submitted');
			$form->link(route('homepage'),'Back');
		});


		$form->build();
		return view('student.report',compact('form','student_info'));
	}
}
