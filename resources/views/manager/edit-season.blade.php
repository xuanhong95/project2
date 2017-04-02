@extends('layouts.app')
@extends('layouts.left-sidebar')

@section('content-with-sidebar')

<div class="container-fluid" style="margin-top:30px">
    <div class="col-md-8 col-md-offset-2 well">
        {!! $form->header !!}
        <div class="page-header col-md-offset-1">
            <h3>Season {!! $season !!}</h3>
        </div>
        <div class="form-group">

            <div class="col-sm-6 ">
                {!! $form->message !!}
            </div>
        </div>

        <div class="form-group">
            <label for="start_date" class="col-sm-3 control-label">Ngày bắt đầu:</label>
            <div class="col-sm-6">
                {!! $form->field('start_date') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="register_deadline" class="col-sm-3 control-label">Hạn đăng ký:</label>
            <div class="col-sm-6">
                {!! $form->field('register_deadline') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="submit_result_deadline" class="col-sm-3 control-label">Hạn nộp điểm:</label>
            <div class="col-sm-6">
                {!! $form->field('submit_result_deadline') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="remark_deadline" class="col-sm-3 control-label">Hạn phúc khảo:</label>
            <div class="col-sm-6">
                {!! $form->field('remarking_deadline') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="end_date" class="col-sm-3 control-label">Ngày kết thúc:</label>
            <div class="col-sm-6">
                {!! $form->field('end_date') !!}
            </div>
        </div>
        <br>
        <br>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <a href="{!! route('seasons')!!}" class="btn btn-default ">Back</a>
            </div>
            <div class="col-sm-4 col-sm-offset-2">
                {!! $form->footer !!}
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
$('#start_date, #register_deadline, #submit_result_deadline, #remark_deadline, #end_date').datepicker({
    changeMonth:true,
    changeYear:true,
    dateFormat:'yy/mm/dd',
    yearRange:'1980:2050',
});
</script>
@endsection
