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
Route::get('/login',function(){
    return view('auth.login');
});
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'manage' => 'ManageController',
    'add-info' => 'AddInfoController',
    'company' => 'CompanyController',
]);
Route::get('/student-report','ManageController@showStudentReport');
Route::get('/topics', 'HomeController@viewTopicList');

Route::group(['prefix'=>'manager','middleware'=>'auth','namespace'=>'Manager'],function(){

    Route::any('seasons','SeasonController@showSeasons')
        ->name('seasons');
    Route::any('seasons/create','SeasonController@showCreateSeason')
        ->name('create-season');
    Route::any('seasons/{season}','SeasonController@showSeasonInfo')
        ->name('edit-season');
    Route::any('recruitments','RecruitmentController@showRecruitments')
        ->name('manager-recruitments');
    Route::any('recruitments/{id}','RecruitmentController@readRecruitment')
        ->name('read-recruitment');
    Route::any('recruitments/{id}/accept','RecruitmentController@acceptRecruitment')
        ->name('accept-recruitment');
    Route::any('recruitments/{id}/deny','RecruitmentController@denyRecruitment')
        ->name('deny-recruitment');
});

Route::group(['middleware'=>'auth','prefix'=>'company'],function(){

    Route::any('register','CompanyController@register')
        ->name('create-recruitment');

    Route::group(['namespace'=>'Enterprise'],function(){

        Route::any('recruitments','RecruitmentController@showRecruitments')
            ->name('enterprise-recruitment');

    });

});
