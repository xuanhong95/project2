<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    //
    public function feedbackStudent($student_id)
    {
        $student_name = \App\User::where('id',$student_id)->select('name')->first();

        $technical_criterias = \App\TechnicalLevelCriteria::get();
        $task_criterias = \App\TaskCriteria::get();
        $attitude_criterias = \App\AttitudeCriteria::get();
        $improvement_criterias = \App\ImprovementCriteria::get();

        $openningSeason = \App\Season::orderBy('id','desc')->first();
        if( is_null($openningSeason)){
            return "There's no openning season.";
        }

        $allocation = \App\Allocation::where([
            ['season','=',$openningSeason->id],
            ['student_id','=',$student_id]
            ])->first();

        $company_appreciations = \App\CompanyAppreciation::where('id_allocation',$allocation->id)
        ->first();


        if(is_null($company_appreciations)){
            $company_appreciations = new \App\CompanyAppreciation;
            $company_appreciations->id_allocation = $allocation->id;
            $company_appreciations->general_appreciation_id = 2;
            $company_appreciations->save();

            $company_appreciations = \App\CompanyAppreciation::where('id_allocation',$allocation->id)
            ->first();
        }

            $student_technicals = \App\TechnicalLevel::where('id_allocation',$allocation->id)
            ->get();
            $student_tasks = \App\Task::where('id_allocation',$allocation->id)
            ->get();
            $student_attitudes = \App\Attitude::where('id_allocation',$allocation->id)
            ->get();
            $student_attitudes = \App\Improvement::where('id_allocation',$allocation->id)
            ->get();

            if(is_null($student_technicals) && is_null($student_tasks)
                && is_null($student_attitudes) && is_null($student_improvements)){


            }

            $form = \DataForm::create();

            $form->add('student_name','Name','text')->insertValue($student_name->name)
                ->mode('readonly');

            //Technical table
            $form->add('point',$technical_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ;
            $form->add('comment','Nhận xét','redactor');

            $form->add('general_appreciation_id',"Đánh giá chung",'select')
                ->option('A','A')->option('B','B')->option('C','C')
                ->option('D','D')->option('E','E')->option('F','F');
            $form->add('is_continue_receive',"nhận tiếp",'checkbox');
            $form->add('missing_knownledge',"Kiến thức thiếu",'checkboxgroup')
                ->option('1','Kiến thức cơ sở (giải thuật, toán, …) ?')
                ->option('2','Ngôn ngữ lập trình ?')
                ->option('3','Phần mềm ?')
                ->option('4','Phần cứng ?')
                ->option('5','Khác ');
            $form->add('necessary_knownledge',"kiến thức cần",'redactor');
            $form->add('is_language_necessary',"Ngoại ngữ thiết yếu k?",'checkbox');
            $form->add('is_language_met',"đáp ứng k?",'checkbox');
            $form->add('shortcoming',"thiếu sót",'redactor');
            $form->add('advantage','ưu điểm','redactor');
            $form->add('procedure_improvement','cải tiến','redactor');

            $form->submit('Send');
            $form->build();

            return view('instructor.feedback',compact('form','student_name'));
        }
    }
