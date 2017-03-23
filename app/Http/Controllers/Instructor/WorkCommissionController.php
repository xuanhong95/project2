<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WorkCommissionController extends Controller
{
    //
    public function commitWork($student_id)
    {
        $student = \App\StudentInfo::join('users','users.id','=','user_id')
            ->where('user_id',$student_id)
            ->select('name','student_number','class')
            ->first();

        $allocation= \App\Allocation::where('student_id',$student_id)
            ->orderBy('id','desc')
            ->first();

        $form = \DataForm::create();
        $form->add('content','Work content:','redactor')->rule('required');
        $form->add('output_requirement','Required output','redactor')->rule('required');
        $form->add('completed_deadline','Completed deadline','redactor')->rule('required');
        $form->submit('Submit');
        $form->saved(function() use($form,$student_id){
            $allocation= \App\Allocation::where('student_id',$student_id)
                ->orderBy('id','desc')
                ->first();

            $input=\Input::all();
            $content = $input['content'];
            $requirement = $input['output_requirement'];
            $completed_deadline = $input['completed_deadline'];

            if(count( $content )==1){
                $task = new \App\TaskForm;
                $task->id_allocation = $allocation->id;
                $task->content = $input['content'];
                $task->output_requirement = $input['output_requirement'];
                $task->completed_deadline = $input['completed_deadline'];
                $task->save();
            }
            else{
                for($i=0; $i< count( $content ); $i++){
                    $task = new \App\TaskForm;
                    $task->id_allocation = $allocation->id;
                    $task->content = $content[$i];
                    $task->output_requirement = $requirement[$i];
                    $task->completed_deadline = $completed_deadline[$i];
                    $task->save();
                }
            }

            $form->message('Submitted!');
        });
        $form->build();


        return view('instructor.commit-work',compact('form','student'));
    }
}
