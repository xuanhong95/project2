<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CompanyController extends Controller
{
    public function anyRegister(){
    	$form = \DataForm::create();
    	$form->add('name', 'Tên công ty', 'text')->placeholder("Donuts Co,. Ltd.");
    	$form->add('address', 'Địa chỉ', 'text')->placeholder("243 Đê La Thành");
    	$form->add('enterprise_instructor', 'Cán bộ phụ trách', 'text')->placeholder("Anh Hồng đẹp trai");
    	$form->add('phone', 'Điện thoại', 'text')->placeholder("0947383678");
    	$form->add('email', 'Email', 'text')->placeholder("pxhong@donuts.biz.vn");
    	$form->add('position', 'Vị trí', 'redactor')->placeholder("Web Developer")->attributes(['name'=>'position[]']);
    	$form->add('content', 'Nội dung', 'redactor')->placeholder("Tuyển dụng lập trình web")->attributes(['name'=>'content[]']);
    	$form->add('require', 'Yêu cầu', 'redactor')->placeholder("Biết PHP")->attributes(['name'=>'require[]']);
    	$form->submit('Register');

		$form->saved(function () use ($form) {
			dd(\Input::all());
		});
    	$form->build();
    	return view('company.company_register', compact('form'));
    }
}
