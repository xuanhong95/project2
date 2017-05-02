@extends('layouts.app')

@section('content')
@include('layouts.left-sidebar')
<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
    <div class="col-md-8 col-md-offset-2 well">
        {!! $form->header !!}
        <div class="page-header col-md-offset-1">
            <h3>Season {!! $season !!}</h3>
        </div>
        <div class="form-group">
            <label for="dob" class="col-sm-3 control-label"></label>
            <div class="col-sm-6 ">
                {!! $form->message !!}
            </div>
        </div>

        <div class="form-group">
            <label for="start_date" class="col-sm-3 control-label">Ngày bắt đầu:</label>
            <div class="col-sm-6 dateinput">
                {!! $form->field('start_date') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="register_deadline" class="col-sm-3 control-label">Hạn đăng ký:</label>
            <div class="col-sm-6 dateinput">
                {!! $form->field('register_deadline') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="submit_result_deadline" class="col-sm-3 control-label">Hạn nộp điểm:</label>
            <div class="col-sm-6 dateinput">
                {!! $form->field('submit_result_deadline') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="remarking_deadline" class="col-sm-3 control-label">Hạn phúc khảo:</label>
            <div class="col-sm-6 dateinput">
                {!! $form->field('remarking_deadline') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="end_date" class="col-sm-3 control-label">Ngày kết thúc:</label>
            <div class="col-sm-6 dateinput">
                {!! $form->field('end_date') !!}
            </div>
        </div>
        <br>
        <br>
        <div class="form-group ">
            <div class="col-sm-4 col-sm-offset-2">
                {!! $form->footer !!}
            </div>
            <div class="col-sm-4 col-sm-offset-2">
                <a href="{!! route('seasons') !!}" class="btn btn-default">Cancel</a>
            </div>
        </div>


    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    $('#start_date, #register_deadline, #submit_result_deadline, #remarking_deadline, #end_date').datepicker({
        changeMonth:true,
        changeYear:true,
        dateFormat:'yy-mm-dd',
        yearRange:':+1',
    });

    function hasError(element){
        //remove success classes
        element.closest(".form-group").removeClass("has-success");
        element.closest("span").removeClass("glyphicon-ok");

        //add error classes
        element.closest(".form-group").addClass("has-error");
        element.closest("span").addClass("glyphicon-remove");
        $("input[type = submit]").addClass("disabled");
    }

    function hasSuccess(element){
        // remove error classes
        element.closest(".form-group").removeClass("has-error");
        element.closest("span").removeClass("glyphicon-remove");
        $("input[type = submit]").removeClass("disabled");

        //add success classes
        element.closest(".form-group").addClass("has-success");
        element.closest("span").addClass("glyphicon-ok");
    }

    $('#start_date, #register_deadline, #submit_result_deadline, #remarking_deadline, #end_date').on("change",function(){
        // start_date must before register_deadline
        if($("#start_date").val() >= $("#register_deadline").val()){
            hasError($("#register_deadline"));
        }
        else{
            hasSuccess($("#register_deadline"));
        }

        //register_deadline must before submit_result_deadline
        if($("#register_deadline").val() >= $("#submit_result_deadline").val()){
            hasError($("#submit_result_deadline"));
        }
        else{
            hasSuccess($("#submit_result_deadline"))
        }

        //submit_result_deadline must before remarking_deadline
        if($("#submit_result_deadline").val() >= $("#remarking_deadline").val()){
            hasError($("#remarking_deadline"));
        }
        else{
            hasSuccess($("#remarking_deadline"));
        }

        //remarking_deadline must before end_date
        if($("#remarking_deadline").val() >= $("#end_date").val()){
            hasError($("#end_date"));
        }
        else{
            hasSuccess($("#end_date"));
        }
    });

</script>
@endsection
