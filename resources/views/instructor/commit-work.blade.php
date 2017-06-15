@extends('layouts.app')

@section('content')
<style media="screen">
textarea{
    max-height: 100px;
    text-overflow: ellipsis;
    resize: none;
    overflow: auto;
}
</style>
<div class="container" style="background:#f8f8f8;margin-bottom:30px">
    <div class="page-headercol-md-offset-1">
        <h3>Commit work</h3>
    </div>
    <div class="col-md-10 col-md-offset-1 well">

        <div class="col-md-10 col-md-offset-1">
            <legend><h4>Student:</h4></legend>
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-md-10 md-offset-1">
                        <p>Name: <strong>{!! $student->name !!}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <p>Class: <b>{!! $student->class !!}</b></p>
                    </div>
                    <div class="col-md-6">
                        <p>Student number: <b>{!! $student->student_number !!}</b></p>
                    </div>
                </div>
            </div>
            <br>
            <legend><h4>Work Commission:</h4></legend>
            <div class="col-md-12">
                {!! $form->header !!}
                <div class="form-group col-md-12">
                    <label for="" class="control-label col-md-3"></label>
                    <div class="col-md-6">
                        {!! $form->message !!}
                    </div>
                </div>
                <div id="work">
                    <table class="table table-striped table-hover table-bordered table-responsive">
                        <tr>
                            <th>No</th>
                            <th>Work content</th>
                            <th>Required Output</th>
                            <th>Completed Deadline</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>{!! $form->field('content') !!}</td>
                            <td>{!! $form->field('output_requirement') !!}</td>
                            <td>{!! $form->field('completed_deadline') !!}</td>
                        </tr>
                    </table>
                </div>

                <div class="row" id="add-point">
                    <div class="col-md-1 col-md-offset-11">
                        <img id="add-button" src="/images/addcontent.png"/ class="img-responsive">
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-2">
                    <a href="{!! route('instructor-students') !!}" role="button" class="btn btn-default">Back</a>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-2">
                        {!! $form->footer !!}
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
        var html="<tr>\n"
        +"<td>"+count_work+"</td>\n"
        +"<td><textarea type='text' class='form-control' name='content' cols='50' rows='10'/></td>\n"
        +"<td><textarea type='text' class='form-control' name='content' cols='50' rows='10'/></td>\n"
        +"<td><textarea type='text' class='form-control' name='content' cols='50' rows='10'/></td>\n"
        +"</tr>\n";
        $('table').append(html);
    });
});
</script>
@endsection
