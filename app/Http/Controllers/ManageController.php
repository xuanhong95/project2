<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\rapyd;
use App\Http\Requests;

class ManageController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function anyIndex(){
		dd('index');
	}

	public function anySetItem(){
		$form = \DataForm::create();
		$form->text('title','Title');
		$form->textarea('body','Body')->rule('required');
		$form->submit('Save');

		$form->saved(function() use ($form)
		{
			dd(\Input::all());
		});

		return view('manage.set_item', compact('form'));
	}
	public function showCV(){
		return view('cv');
	}

	public function showStudentReport(){
		$student=\DB::table('student_infos')
			->select('student_number','phone','class')
			->where('user_id','=',\Auth::user()->id)
			->first();

		$form=\DataForm::create();

		$form->add('student_name','Họ và tên','text')
			->insertValue(\Auth::user()->name)
			->mode('readonly');
		$form->add('student_number','Mã số sinh viên','text')
			->insertValue($student->student_number)
			->mode('readonly');
		$form->add('student_class','Lớp:','text')
			->insertValue($student->class)
			->mode('readonly');
		$form->add('student_phone','Số điện thoại:','text')
			->insertValue($student->phone)
			->mode('readonly');
		$form->add('student_email','Email:','text')
			->insertValue(\Auth::user()->email)
			->mode('readonly');
		$form->add('company_address','Địa chỉ đến thực tập: <Ghi đầy đủ tên công ty, địa chỉ>:','text');
		$form->add('company_guide','Người hướng dẫn tại cơ sở thực tập:','text');
		$form->add('time_from','từ','text');
		$form->add('time_to','đến','text');
		$form->add('guide_teacher','Giáo viên phụ trách','text');
		$form->add('work_purpose','Mục đích thực tập được giao','redactor');
		$form->add('work_content','Nội dung công việc được giao','redactor');
		$form->add('result','Kết quả thực tập','redactor');
		$form->add('student_advantage','Ưu điểm','redactor');
		$form->add('student_shortcoming','Nhược điểm','redactor');
		$form->submit('Nộp báo cáo');

		$form->build();
		return view('student.report',compact('form','student'));
	}
}
