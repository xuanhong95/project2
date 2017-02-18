<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\rapyd;
use App\Http\Requests;

class AddInfoController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function anyIndex(){
		dd('index');
	}

	public function anyAddCv(){
		dd(\Auth::user());
	}
}
