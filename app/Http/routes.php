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
    'company' => 'CompanyController',
	]);
Route::get('/student-report','ManageController@showStudentReport');
Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'manager','middleware'=>'auth'],function(){

    Route::group(['namespace'=>'Manager'],function(){

        Route::any('seasons','SeasonController@showSeasons')
                ->name('seasons');
        Route::any('seasons/create','SeasonController@showCreateSeason')
                ->name('create-season');
        Route::any('seasons/{season}','SeasonController@showSeasonInfo')
                ->name('edit-season');
    });
});
