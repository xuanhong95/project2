<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{

    public function feedbackStudent($student_id)
    {
        $student_name = \App\User::getUserNameByID( $student_id );

        $season_id = \App\Season::getOpenningSeasonID();

        $allocation_id = \App\Allocation::getIDByStudentIDSeason( $student_id, $season_id);

        $company_appreciations = \App\CompanyAppreciation::getRecordByAllocationID( $allocation_id );

        if(is_null($company_appreciations)){
            $company_appreciations = new \App\CompanyAppreciation;
            $company_appreciations->id_allocation = $allocation_id;
            $company_appreciations->general_appreciation_id = 2;
            $company_appreciations->missing_knownledge = "1&&";
            $company_appreciations->save();

            $company_appreciations = \App\CompanyAppreciation::getRecordByAllocationID( $allocation_id );
        }

        $student_technicals = \App\TechnicalLevel::where('id_allocation',$allocation_id)
            ->get();
        $student_tasks = \App\Task::where('id_allocation',$allocation_id)
            ->get();
        $student_attitudes = \App\Attitude::where('id_allocation',$allocation_id)
            ->get();
        $student_improvements = \App\Improvement::where('id_allocation',$allocation_id)
            ->get();

// dd($student_technicals);

            $form = \DataForm::create();

            $form->add('student_name','Name','text')->insertValue($student_name)
                ->mode('readonly');

            //Table tech
            $form->add('point_tech0',"criteria1",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_technicals->isEmpty() ?'A': $student_technicals[0]->point );
            $form->add('point_tech1',"criteria2",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_technicals->isEmpty() ?'A': $student_technicals[1]->point );
            $form->add('point_tech2',"criteria3",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_technicals->isEmpty() ?'A': $student_technicals[2]->point );
            $form->add('point_tech3',"criteria4",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_technicals->isEmpty() ?'A': $student_technicals[3]->point );
            $form->add('point_tech4',"criteria5",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_technicals->isEmpty() ?'A': $student_technicals[4]->point );
            $form->add('point_tech5',"criteria6",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_technicals->isEmpty() ?'A': $student_technicals[5]->point );
            $form->add('point_tech6',"criteria7",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_technicals->isEmpty() ?'A': $student_technicals[6]->point );

            $form->add('comment_tech','Nhận xét','redactor')
                ->placeholder('nhận xét...')
                ->attributes(['name' => 'comment_tech[]']);


            //Table task
            $form->add('point_task0',"criteria1",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_tasks->isEmpty() ?'A': $student_tasks[0]->point );
            $form->add('point_task1',"criteria2",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_tasks->isEmpty() ?'A': $student_tasks[1]->point );
            $form->add('point_task2',"criteria3",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_tasks->isEmpty() ?'A': $student_tasks[2]->point );
            $form->add('point_task3',"criteria4",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_tasks->isEmpty() ?'A': $student_tasks[3]->point );
            $form->add('point_task4',"criteria5",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_tasks->isEmpty() ?'A': $student_tasks[4]->point );
            $form->add('point_task5',"criteria6",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_tasks->isEmpty() ?'A': $student_tasks[5]->point );

            $form->add('comment_task','Nhận xét','redactor')
                ->placeholder('nhận xét...')
                ->attributes(['name'=>'comment_task[]']);

            //Table attitude
            $form->add('point_attitude0',"criteria1",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_attitudes->isEmpty() ?'A': $student_attitudes[0]->point );
            $form->add('point_attitude1',"criteria2",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_attitudes->isEmpty() ?'A': $student_attitudes[1]->point );
            $form->add('point_attitude2',"criteria3",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_attitudes->isEmpty() ?'A': $student_attitudes[2]->point );
            $form->add('point_attitude3',"criteria4",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_attitudes->isEmpty() ?'A': $student_attitudes[3]->point );
            $form->add('point_attitude4',"criteria5",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_attitudes->isEmpty() ?'A': $student_attitudes[4]->point );
            $form->add('point_attitude5',"criteria6",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_attitudes->isEmpty() ?'A': $student_attitudes[5]->point );

            $form->add('comment_attitude','Nhận xét','redactor')
                ->placeholder('nhận xét...')
                ->attributes(['name'=>'comment_attitude[]']);


            $form->add('point_improvement0',"criteria1",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_improvements->isEmpty() ?'A': $student_improvements[0]->point );
            $form->add('point_improvement1',"criteria2",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_improvements->isEmpty() ?'A': $student_improvements[1]->point );
            $form->add('point_improvement2',"criteria3",'select')
                ->option('A','Xuất sắc')->option('B','Tốt')->option('C','Khá')
                ->option('D','Bình thường')->option('F','Kém')->option('X','Không ý kiến')
                ->insertValue( $student_improvements->isEmpty() ?'A': $student_improvements[2]->point );

            $form->add('comment_improvement','Nhận xét','redactor')
                ->placeholder('nhận xét...')
                ->attributes(['name'=>'comment_improvement[]']);

            $form->add('general_appreciation_id',"Đánh giá chung",'select')
                ->option('A','A')->option('B','B')->option('C','C')
                ->option('D','D')->option('E','E')->option('F','F')
                ->insertValue($company_appreciations->general_appreciation_id);

            $form->checkbox('is_continue_receive',"nhận tiếp")
                ->insertValue($company_appreciations->is_continue_receive);

            $missing_knownledge = explode("&&",$company_appreciations->missing_knownledge) ;
            $other_missing_knownledge = array_key_exists('5',$missing_knownledge)?
                end($missing_knownledge)
                :null;

            $form->add('missing_knownledge',"Kiến thức thiếu",'checkboxgroup')
                ->option('1','Kiến thức cơ sở (giải thuật, toán, …) ?')
                ->option('2','Ngôn ngữ lập trình ?')
                ->option('3','Phần mềm ?')
                ->option('4','Phần cứng ?')
                ->option('5','Khác ')
                ->insertValue($missing_knownledge);
            $form->add('other_missing_knownledge','missing_knownledge','redactor')
                ->placeholder('Kiến thức còn thiếu...')
                ->insertValue($other_missing_knownledge);
            $form->add('necessary_knownledge',"kiến thức cần",'redactor')
                ->placeholder('Nhóm kiến thức cần chú trọng...')
                ->insertValue($company_appreciations->necessary_knownledge);
            $form->checkbox('is_language_necessary',"Ngoại ngữ thiết yếu k?")
                ->insertValue($company_appreciations->is_language_necessary);
            $form->checkbox('is_language_met',"đáp ứng k?")
                ->insertValue($company_appreciations->is_language_met);
            $form->add('shortcoming',"thiếu sót",'redactor')
                ->placeholder('Thiếu sót của sinh viên...')
                ->insertValue($company_appreciations->shortcoming);
            $form->add('advantage','ưu điểm','redactor')
                ->placeholder('Ưu điểm của sinh viên...')
                ->insertValue($company_appreciations->advantage);
            $form->add('procedure_improvement','cải tiến','redactor')
                ->placeholder('Các cải tiến trong quy trình thực tập..')
                ->insertValue($company_appreciations->procedure_improvement);

            $form->submit('Send');
            $form->saved(function () use ($form, $allocation_id, $company_appreciations,
                $student_technicals, $student_tasks, $student_attitudes, $student_improvements)
            {

                $input = \Input::all();

                $first_set = false;
                if($student_technicals->isEmpty()){
                    $first_set = true;
                }

                // dd($input);
                $tech_comment = $input['comment_tech'];
                for( $i = 0 ; $i < 7; $i++){
                    $tech_appre = $first_set? new \App\TechnicalLevel:$student_technicals[$i];
                    $tech_appre->id_allocation = $allocation_id;
                    $tech_appre->criteria_id = $i+1;
                    $tech_appre->point = $input['point_tech'.$i];
                    $tech_appre->comment = $tech_comment[$i];
                    $tech_appre->save();
                }

                $task_comment = $input['comment_task'];
                for( $i = 0 ; $i < 6; $i++){
                    $appre = $first_set? new \App\Task : $student_tasks[$i];
                    $appre->id_allocation = $allocation_id;
                    $appre->criteria_id = $i+1;
                    $appre->point = $input['point_task'.$i];
                    $appre->comment = $task_comment[$i];
                    $appre->save();
                }

                $attitude_comment = $input['comment_attitude'];
                for( $i = 0 ; $i < 6; $i++){
                    $appre =$first_set? new \App\Attitude : $student_attitudes[$i];
                    $appre->id_allocation = $allocation_id;
                    $appre->criteria_id = $i+1;
                    $appre->point = $input['point_attitude'.$i];
                    $appre->comment = $attitude_comment[$i];
                    $appre->save();
                }

                $improvement_comment = $input['comment_improvement'];
                for( $i = 0 ; $i < 3; $i++){
                    $appre = $first_set? new \App\Improvement : $student_improvements[$i];
                    $appre->id_allocation = $allocation_id;
                    $appre->criteria_id = $i+1;
                    $appre->point = $input['point_improvement'.$i];
                    $appre->comment = $improvement_comment[$i];
                    $appre->save();
                }

                if( empty( $input['is_continue_receive'] ) ){
                    $input['is_continue_receive'] = 0;
                }

                if( empty( $input['is_language_necessary'] ) ){
                    $input['is_language_necessary'] = 0;
                }

                if( empty( $input['is_language_met'] ) ){
                    $input['is_language_met'] = 0;
                }

                $input['missing_knownledge'] = implode( "&&",$input['missing_knownledge'])
                    ."&&".$input['other_missing_knownledge'];

                $company_appreciations->general_appreciation_id = $input['general_appreciation_id'];
                $company_appreciations->is_continue_receive = $input['is_continue_receive'];
                $company_appreciations->missing_knownledge = $input['missing_knownledge'];
                $company_appreciations->necessary_knownledge = $input['necessary_knownledge'];
                $company_appreciations->is_language_necessary = $input['is_language_necessary'];
                $company_appreciations->is_language_met = $input['is_language_met'];
                $company_appreciations->procedure_improvement = $input['procedure_improvement'];
                $company_appreciations->advantage = $input['advantage'];
                $company_appreciations->shortcoming = $input['shortcoming'];
                $company_appreciations->save();

                $form->message('Send');
            });
            $form->build();

            return view('instructor.feedback',compact('form','student_name','missing_knownledge'));
        }
    }
