<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'manage' => 'ManageController',
	'add-info' => 'AddInfoController',
	]);
Route::get('/student-report','ManageController@showStudentReport');
Route::get('/home', 'HomeController@index');
Route::get('/teacher/seasons','TeacherController@showSeasons');
Route::post('/teacher/seasons/create',[
    'as'=>'createNewSeason',
    'uses'=>'TeacherController@showCreateSeasonPage'
]);
Route::get('/teacher/seasons/create',[
    'as'=>'createNewSeason',
    'uses'=>'TeacherController@showCreateSeasonPage'
]);
