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
        $technical_criterias = \App\TechnicalLevelCriteria::get();
        $task_criterias = \App\TaskCriteria::get();
        $attitude_criterias = \App\AttitudeCriteria::get();
        $improvement_criterias = \App\ImprovementCriteria::get();

        $openningSeason = \App\Season::orderBy('id','desc')->first();
        if( is_null($openningSeason)){
            return "There's no openning season.";
        }

        $allocation = \App\Allocation::where([
            ['season','=',$openningSeason],
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

        $student_technical = \App\TechnicalLevel::where('id_allocation',$allocation->id)
            ->first();
        $student_task = \App\Task::::where('id_allocation',$allocation->id)
            ->first();
        $student_attitude = \App\Attitude::where('id_allocation',$allocation->id)
            ->first();
        $student_improvement = \App\Improvement::where('id_allocation',$allocation->id)
            ->first();

        $technical_form = \DataForm::source($student_technical);
        $technical_form->add('related_technical',$technical_criterias[0],'radiogroup')
            ->option(1,'Xuất sắc')->option(1,'A')->option(1,'A')->option(1,'A')->option(1,'A')->option(1,'A')
    }
}
