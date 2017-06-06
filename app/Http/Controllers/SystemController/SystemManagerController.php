<?php

namespace App\Http\Controllers\SystemController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SystemManagerController extends Controller
{
	public function manageAccount(){
		$old_key = "";
		if(\Request::isMethod('post')){
			if(empty(\Request::get('keyword'))){
				$users = \App\User::orderBy('user_type', 'asc');
			}
			else{
				$users = \App\User::where('email', \Request::get('keyword'));
				$old_key = \Request::get('keyword');
			}
		}
		else{
			$users = \App\User::orderBy('user_type', 'asc');
		}

		$grid = \DataGrid::source($users);


		$grid->add('{{\App\User::getUsernameByID($id)}}', 'Tên')->link('/system-manager/edit-account/{{$id}}');
		$grid->add('{{$email}}', 'Email');
		$grid->add('{{\App\User::getTypeNameByID($user_type)}}', 'Tài khoản');
		$grid->add('created_at', 'Ngày tạo');
		$grid->paginate(5);
		return view('system.manage_account', compact('grid', 'form', 'old_key'));
	}

	public function editAccount($id){
		$role = ['0'=>'Student', '1'=>'Instructor Teacher',
				'2'=>'Enterprise Instructor', '3'=>'Enterprise',
				'4'=>'Internship Manager', '5'=>'System Manager'];
		$user = \App\User::find($id);
		$form = \DataForm::source($user);
		$form->text('name', 'Name')->mode('readonly');
		$form->add('user_type', 'User Role', 'select')->options($role);
		$form->submit("Save");

		$form->saved(function() use ($form){
			$form->message('Saved');
			$form->link('/system-manager/manage-account','Back');
		});
		$form->build();

		return view('system.edit_account',compact('form'));
	}
}
