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
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'add-info' => 'AddInfoController',
    'company' => 'CompanyController',
]);

// Public routes

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::get('/login',function(){
    return view('auth.login');
});

//Need authentication routes

Route::any('profile','AddInfoController@anyShowProfile')
    ->name('profile');

Route::get('/topics', 'HomeController@viewTopicList')
    ->name('view-topics');

Route::get('/topics/{topic_id}', 'HomeController@viewTopic')
    ->name('view-topic-detail');

Route::get('/student/season{season?}','StudentController@showStudents')
    ->name('students-in-season');

Route::get('/companies/season{season?}','CompanyController@showCompanies')
    ->name('companies-in-season');


//Need type of user authentication routes

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

Route::group(['middleware'=>'auth','prefix'=>'enterprise'],function(){

    Route::group(['namespace'=>'Enterprise'],function(){

        Route::any('recruitments','RecruitmentController@showRecruitments')
            ->name('enterprise-recruitment');
        Route::any('create-new-recruitment','RecruitmentController@createRecruitment')
            ->name('create-recruitment');
        Route::any('recruitments/{recruitment_id}','RecruitmentController@readRecruitment')
            ->name('enterprise-read-recruitment');

    });
});

Route::group(['middleware'=>'auth','prefix'=>'student','namespace'=>'Student'],function(){

    Route::any('feedback','FeedbackController@showFeedbacks')
        ->name('student-feedback');
    Route::any('create-feedback','FeedbackController@createFeedback')
        ->name('create-feedback');
    Route::any('feedback/{id_feedback}','FeedbackController@showFeedback')
        ->name('show-feedback');
    Route::any('student-report','ReportController@showStudentReport')
        ->name('student-report');
    Route::any('apply-job','ApplyController@getApplyRequest');

});

Route::group(['middleware'=>'auth','prefix'=>'instructor','namespace'=>'Instructor'],function(){

    Route::any('students','InstructorController@showStudents')
        ->name('instructor-students');
    Route::any('commit-work/{student_id}','WorkCommissionController@commitWork')
        ->name('commit-work');
    Route::any('feedback/{student_id}','FeedbackController@feedbackStudent')
        ->name('instructor-feedback');
});
