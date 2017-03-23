@extends('layouts.app')
@section('content')
<style media="screen">
textarea{
    max-height: 100px;
    text-overflow: ellipsis;
}
</style>
<div class="container" style="margin-top:70px">
    <div class="col-md-10 col-md-offset-1 well">
        <legend>Commit Work</legend>
        <div class="col-md-10 col-md-offset-1">
            <legend><h4>Student:</h4></legend>
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="row">
                        <div class="col-md-10 md-offset-1">
                            <p>Name: <strong>{!! $student->name !!}</strong></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Class: <b>{!! $student->class !!}</b></p>
                        </div>
                        <div class="col-md-6">
                            <p>Student number: <b>{!! $student->student_number !!}</b></p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <legend><h4>Work Commisstion:</h4></legend>
            <div class="col-md-12">
                {!! $form->header !!}
                <div class="form-group col-md-12">
                    <label for="" class="control-label col-md-3"></label>
                    <div class="col-md-6">
                        {!! $form->message !!}
                    </div>
                </div>

                <legend><h5>Work <strong>1</strong>:</h5></legend>
                <div id="work">
                    <div class="row">
                        <div class="form-group col-md-4" style="margin-left:10px">
                            <label for="content" class="control-label">Work content:</label>
                            {!! $form->field('content') !!}
                        </div>

                        <div class="form-group col-md-4" style="margin-left:10px">
                            <label for="output_requirement" class="control-label">Required Output:</label>
                            {!! $form->field('output_requirement') !!}
                        </div>

                        <div class="form-group col-md-4" style="margin-left:10px">
                            <label for="completed_deadline" class="control-label">Completed Deadline:</label>
                            {!! $form->field('completed_deadline') !!}
                        </div>
                    </div>
                </div>

                <div class="row" id="add-point">
                    <div class="col-md-1 col-md-offset-11">
                        <img id="add-button" src="/images/addcontent.png"/ class="img-responsive">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        {!! $form->footer !!}
                    </div>
                    <div class="col-md-4 col-md-offset-2">
                        <a href="{!! route('instructor-students') !!}" role="button" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
    var count_work=1;
    $('#add-button').on('click',function(){
        count_work++;
        var html="<legend><h5>Work <strong>"+count_work+"</strong>:</h5></legend>"+$('#work').html();
        $('#add-point').before(html);
    });
});
</script>
@endsection
