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
            $student_improvements = \App\Improvement::where('id_allocation',$allocation->id)
            ->get();

            if(is_null($student_technicals) && is_null($student_tasks)
                && is_null($student_attitudes) && is_null($student_improvements)){


            }

            $form = \DataForm::create();

            $form->add('student_name','Name','text')->insertValue($student_name->name)
                ->mode('readonly');

            //Table tech
            $form->add('point_tech0',$technical_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_tech1',$technical_criterias[1]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_tech2',$technical_criterias[2]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_tech3',$technical_criterias[3]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_tech4',$technical_criterias[4]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_tech5',$technical_criterias[5]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_tech6',$technical_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');

            $form->add('comment_tech','Nhận xét','redactor')->attributes(['name' => 'comment_tech[]']);


            //Table task
            $form->add('point_task0',$task_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_task1',$task_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_task2',$task_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_task3',$task_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_task4',$task_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_task5',$task_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');

            $form->add('comment_task','Nhận xét','redactor')->rule('required');

            //Table attitude
            $form->add('point_attitude0',$attitude_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_attitude1',$attitude_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_attitude2',$attitude_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_attitude3',$attitude_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_attitude4',$attitude_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_attitude5',$attitude_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');

            $form->add('comment_attitude','Nhận xét','redactor')->rule('required');


            $form->add('point_improvement0',$improvement_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_improvement1',$improvement_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');
            $form->add('point_improvement2',$improvement_criterias[0]->criteria,'radiogroup')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->rule('required');

            $form->add('comment_improvement','Nhận xét','redactor')->rule('required');

            $form->add('general_appreciation_id',"Đánh giá chung",'select')
                ->option('A','A')->option('B','B')->option('C','C')
                ->option('D','D')->option('E','E')->option('F','F')
                ->rule('required');
            $form->add('is_continue_receive',"nhận tiếp",'checkbox')
                ->rule('required');


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
            $form->saved(function () use ($form, $allocation, $company_appreciations){
                $input = \Input::all();
                dd($input['comment_tech']);
                for( $i = 0 ; $i < 7; $i++){
                    $tech_appre = new \App\TechnicalLevel;
                    $tech_appre->id_allocation = $allocation->id;
                    $tech_appre->criteria_id = $i+1;
                    $tech_appre->point = $input['point_tech'.$i];
                    $tech_appre->point = $input['comment_tech'][$i];
                    $tech_appre->save();
                }

                for( $i = 0 ; $i < 6; $i++){
                    $appre = new \App\Task;
                    $appre->id_allocation = $allocation->id;
                    $appre->criteria_id = $i+1;
                    $appre->point = $input['point_task'.$i];
                    $appre->point = $input['comment_task'][$i];
                    $appre->save();
                }

                for( $i = 0 ; $i < 6; $i++){
                    $appre = new \App\Attitude;
                    $appre->id_allocation = $allocation->id;
                    $appre->criteria_id = $i+1;
                    $appre->point = $input['point_attitude'.$i];
                    $appre->point = $input['comment_attitude'][$i];
                    $appre->save();
                }

                for( $i = 0 ; $i < 3; $i++){
                    $appre = new \App\Improvement;
                    $appre->id_allocation = $allocation->id;
                    $appre->criteria_id = $i+1;
                    $appre->point = $input['point_improvement'.$i];
                    $appre->point = $input['comment_improvement'][$i];
                    $appre->save();
                }

                $company_appreciations->general_appreciation_id = $input['general_appreciation_id'];
                $company_appreciations->is_continue_receive = $input['is_continue_receive'];
                $company_appreciations->missing_knownledge = $input['missing_knownledge'];
                $company_appreciations->necessary_knownledge = $input['necessary_knownledge'];
                $company_appreciations->is_language_necessary = $input['is_language_necessary'];
                $company_appreciations->is_language_met = $input['is_language_met'];
                $company_appreciations->procedure_improvement = $input['procedure_improvement'];
                $company_appreciations->save();

                $form->message('Send');
            });
            $form->build();

            return view('instructor.feedback',compact('form','student_name'));
        }
    }
