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

	public function anyIndex(){
		dd('index');
	}

	public function anyShowCv(){
		$source = \App\User::join('student_infos', 'users.id', '=', 'student_infos.user_id')
							->where('users.id', '1')
							->get(['users.name', 'users.email',
								'student_infos.class', 'student_infos.student_number',
								]);
		//dd($source);
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
}
