<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function anyIndex()
    {
        return view('home');
    }

    public function viewTopicList(){
        $list_topic = \App\Recruitment::join('enterprises', 'recruitments.user_id', '=', 'enterprises.user_id')
                                        ->where('recruitments.is_confirm', 1)
                                        ->orderBy('recruitments.id', 'desc')
                                        ->get();
//        dd($list_topic);
        return view('home.topics', compact('list_topic'));
    }
}
