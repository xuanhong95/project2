<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;

use App\Http\Requests;

class FeedbackController extends \App\Http\Controllers\Controller
{

    //
    public function showFeedbacks()
    {
        $feedbacks = \App\StudentFeedback::join('allocations','student_feedbacks.user_id','=','allocations.student_id')
        ->join('companies','allocations.company_id','=','companies.id')
        ->where( 'student_feedbacks.user_id','=',\Auth::id() )
        ->select('student_feedbacks.id','companies.name','student_feedbacks.season','is_confirmed')
        ->get();

        return view('student.feedbacks',compact('feedbacks'));
    }

    public function createFeedback()
    {
        $lastSeason = \App\Season::orderBy('id','desc')->first();
        if( is_null( $lastSeason )){
            return "There are not any season created";
        }

        //Test if last season openning..
        if( \App\Season::is_openningSeason($lastSeason) ){

            //get company which student intern in
            $company=\App\Allocation::join('companies','companies.id','=','allocations.company_id')
            ->where([
                ['student_id','=',\Auth::id()],
                ['season','=',$lastSeason->id]
                ])->select('companies.name','season')
                ->first();

                if( is_null( $company ) ) return "You are not in any companies!";

                $form = \DataForm::create();
                $form->add('action','Action','text')->rule('required');
                $form->add('feedback_reason','Reason','redactor')->rule('required');
                $form->submit('Send');

                $form->saved(function() use($form){
                    $feedback = new \App\StudentFeedback;
                    $input = \Input::all();

                    $feedback->user_id = \Auth::id();
                    $feedback->action = $input['action'];
                    $feedback->feedback_reason = $input['feedback_reason'];
                    $feedback->save();

                    $form->message('Sent');
                    $form->link( route('student-feedback'),'Back');
                });
                $form->build();

                return view('student.create-feedback',compact('form','company','lastSeason'));
            }
            else{
                return "There are not any openning season";
            }
        }

        public function showFeedback($id_feedback)
        {
            $feedbackInfo = \App\StudentFeedback::join(
                    'allocations','student_feedbacks.user_id','=','allocations.student_id')
            ->join('companies','allocations.company_id','=','companies.id')
            ->where( 'student_feedbacks.id', '=', $id_feedback )
            ->select('companies.name','student_feedbacks.season',
                'action','feedback_reason','is_confirmed','confirm_reason')
            ->first();

            if( is_null( $feedbackInfo->is_confirmed ) ) $confirm_value = "Unapproved";
                else $confirm_value = $feedbackInfo->is_confirmed = 1 ? "Accepted":"Declined";

            $form = \DataForm::create();
            $form->add('company_name','Company:','text')->insertValue( $feedbackInfo->name )
                ->mode('readonly');
            $form->add('season','Season:','text')->insertValue( $feedbackInfo->season."" )
                ->mode('readonly');
            $form->add('action','Action:','text')->insertValue( $feedbackInfo->action )
                ->mode('readonly');
            $form->add('feedback_reason','Reason:','redactor')->insertValue( $feedbackInfo->feedback_reason)
                ->mode('readonly');
            $form->add('is_confirmed','Confirmation:','text')->insertValue( $confirm_value )->mode('readonly');
            $form->add('confirm_reason','Comment:','redactor')
                ->insertValue( $feedbackInfo->confirm_reason )
                ->mode('readonly');
            $form->build();

            return view('student.feedback-show',compact('form'));
        }
    }
