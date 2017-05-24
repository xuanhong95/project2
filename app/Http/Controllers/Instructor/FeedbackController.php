<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{

    public function feedbackStudent( $student_id )
    {
        $student = \App\StudentInfo::getStudentInfo( $student_id );

        $season_id = \App\Season::getLastSeasonID();

        $allocation = \App\Allocation::getAllocationStudentIDSeason( $student_id, $season_id);

        $appreciation = \App\CompanyAppreciation::getAppreciationByAllocationID( $allocation->id );

        if(is_null($appreciation)){
            $appreciation = new \App\CompanyAppreciation;
            $appreciation->id_allocation = $allocation->id;
            $appreciation->general_appreciation_id = 2;
            $appreciation->missing_knownledge = "";
            $appreciation->save();

            $appreciation = \App\CompanyAppreciation::getAppreciationByAllocationID( $allocation->id );
        }

        $technicalLevelRecords = \App\TechnicalLevel::getTechnicalLevelsWithCriterias( $allocation->id );
        $taskRecords = \App\Task::getTasksWithCriterias( $allocation->id );
        $attitudeRecords = \App\Attitude::getAttitudesWithCriterias( $allocation->id );
        $improvementRecords = \App\Improvement::getImprovementsWithCriterias( $allocation->id );
        // dd($technicalLevelRecords);
        $message = null;

        if(\Request::isMethod("post") && \Input::get("_token") == csrf_token() ){

            foreach ($technicalLevelRecords as $key => $record) {
                $technicalLevel = \App\TechnicalLevel::where("id",$record->id)->first();
                $technicalLevel->point = $_POST["technicalLevel-".$record->criteria_id];
                $technicalLevel->comment = $_POST["technicalLevelComment-".$record->criteria_id];
                $technicalLevel->save();

            }

            foreach ($taskRecords as $key => $record) {
                $task = \App\Task::where("id",$record->id)->first();
                $task->point = $_POST["task-".$record->criteria_id];
                $task->comment = $_POST["taskComment-".$record->criteria_id];
                $task->save();
            }

            foreach ($attitudeRecords as $key => $record) {
                $attitude= \App\Attitude::where("id",$record->id)->first();
                $attitude->point = $_POST["attitude-".$record->criteria_id];
                $attitude->comment = $_POST["attitudeComment-".$record->criteria_id];
                $attitude->save();
            }

            foreach ($improvementRecords as $key => $record) {
                $improvement= \App\Improvement::where("id",$record->id)->first();
                $improvement->point = $_POST["improvement-".$record->criteria_id];
                $improvement->comment = $_POST["improvementComment-".$record->criteria_id];
                $improvement->save();
            }

            $missingKnownledge = isset($_POST["missingKnownledge"])?$_POST["missingKnownledge"]:[];
            $necessaryKnownledge = isset($_POST["necessaryKnowledge"])?$_POST["necessaryKnowledge"]:"";
            $shortcoming = isset($_POST["shortcoming"])?$_POST["shortcoming"]:"";
            $advantages = isset($_POST["advantages"])?$_POST["advantages"]:"";
            $procedureImprovement = isset($_POST["procedureImprovement"])?$_POST["procedureImprovement"]:"";

            $appreciation = \App\CompanyAppreciation::where("id_allocation",$allocation->id)->first();
            $appreciation->missing_knownledge = json_encode($missingKnownledge);
            $appreciation->general_appreciation_id = $_POST["generalAppreciation"];
            $appreciation->is_continue_receive = $_POST["continueReceive"];
            $appreciation->necessary_knownledge = $necessaryKnownledge;
            $appreciation->is_language_necessary = $_POST["isLanguageNecessary"];
            $appreciation->is_language_met = $_POST["isLanguageMet"];
            $appreciation->shortcoming = $shortcoming;
            $appreciation->advantage = $advantages;
            $appreciation->procedure_improvement = $procedureImprovement;

            $appreciation->save();

            \Session::flash("message","Submitted");
            return \Redirect::back();
        }


        return view('instructor.feedback',compact('student',"appreciation" ,"technicalLevelRecords",
                                                "taskRecords", "attitudeRecords",
                                                "improvementRecords",'message'));
        }
    }
