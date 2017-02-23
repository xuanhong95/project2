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
}
