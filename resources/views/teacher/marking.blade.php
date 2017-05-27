@extends('layouts.app')
<style>
    .accept_point{
        color: green;
    }
    .decline_point{
        color: red;
    }
    .accept_point:hover,
    .decline_point:hover{
        cursor: pointer;
    }
</style>
@section('content')
@include('layouts.left-sidebar')

<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
    <!-- page header -->
    <div class="page-header col-md-offset-1">
        <h3>Marking</h3>
    </div>
    <div class="col-md-10 col-md-offset-1 well">
        @if( $resultOfStudents == null)
        <p><h3>There's no student to mark</h3></p>
        @else
        {{$message}}

        @if(\Auth::user()->user_type == 4)
        <form action="{{ route('edit-point') }}" method="post">
        @else
        <form action="{{ route('teacher-marking') }}" method="post">
        @endif
            {{ csrf_field() }}
        <table class="table table-striped table-hover table-bordered table-responsive">
            <tr>
                <th>No</th>
                <th>Student number</th>
                <th>Name</th>
                <th>Class</th>
                <th>Progress point</th>
                <th>Exam point</th>
            </tr>

                @foreach( $resultOfStudents as $key=>$result )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $result->student_number }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->class }}</td>
                        @if(!empty($result->edit_progress_point))
                        <td><div><input type="text" class="form-control" name="progress_point/{{ $result->user_id }}" id="progress_point_{{$result->id}}" value="{{ $result->progress_point }}">
                             <span class="wait-approve-text-{{$result->id}}">({{$result->edit_progress_point}} waiting for approve)</span>
                        </div>
                        </td>
                        @else
                        <td><input type="text" class="form-control" name="progress_point/{{ $result->user_id }}" value="{{ $result->progress_point }}"></td>
                        @endif

                        @if(!empty($result->edit_exam_point))
                        <td>
                            <div><input type="text" class="form-control" name="exam_point/{{ $result->user_id }}" id="exam_point_{{$result->id}}" value="{{ $result->exam_point }}">
                            <span class="wait-approve-text-{{$result->id}}">({{$result->edit_exam_point}} waiting for approve)</span>
                            </div>
                        </td>
                        @else
                        <td><input type="text" class="form-control" name="exam_point/{{ $result->user_id }}" value="{{ $result->exam_point }}"></td>
                        @endif
                    </tr>

                    @if(!empty($result->edit_progress_point) || !empty($result->edit_exam_point))
                    @if(\Auth::user()->user_type == 1)
                    <tr style="text-align: center; font-weight: bold">
                        <td colspan="6">
                           <p> Waiting for approve </p>
                        </td>
                    </tr>
                    @elseif(\Auth::user()->user_type == 4)
                    <tr style="text-align: center; font-weight: bold">
                        <td colspan="4">
                           <p> Waiting for approve </p>
                        </td>
                        <td>
                            <span id="{{$result->id}}" class="accept_point">Accept</span>
                            <span class='message'></span>
                        </td>
                        <td>
                            <span id="{{$result->id}}" class="decline_point">Decline</span>
                            <span class='message'></span>
                        </td>
                    </tr>
                    @endif
                    @endif

                @endforeach
            </table>
            @endif
            <div class="col-md-3 col-md-offset-1">
                <a href="{{ route('homepage') }}" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i>Back</a>
            </div>
            <div class="col-md-3 pull-right">
                <input type="submit" class="btn btn-default" value="Submit">
            </div>
        </form>
    </div>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/jquery.numeric.js"></script>
<script type="text/javascript">
    $("input").numeric();

    $('.accept_point').click(function(event) {
    event.preventDefault();

    var element_id = $(this).attr('id'),
        _this   = this,
        message_span = $(this).siblings('.message');

    var html_loading    = '<span><i class="fa fa-spin fa-spinner"></i></span>',
        html_success    = '<span class="alert-success">Success</span>',
        html_error      = '<span class="alert-danger">Error</span>';

    $(html_loading).appendTo($(message_span));
    $.ajax({
        type: 'GET',
        url: "/teacher/marking/accept/" + element_id,
        success: function (data) {
            $('#progress_point_' + element_id).val(data[0]);
            $('#exam_point_' + element_id).val(data[1]);
            $.map($('.wait-approve-text-' + element_id), function(e){
                $(e).remove();
            });
            $(_this).parent().parent().remove();
            $(message_span).children($(html_loading)).remove();
            $(html_success).appendTo($(message_span));
            $(message_span).children($(html_success)).fadeOut(1000);
        },
        error: function (){
            $(_this).siblings($(html_loading)).remove();
            $(html_error).appendTo($(message_span));
        }
        });
    });

    $('.decline_point').click(function(event) {
    event.preventDefault();

    var element_id = $(this).attr('id'),
        _this   = this,
        message_span = $(this).siblings('.message');

    var html_loading    = '<span><i class="fa fa-spin fa-spinner"></i></span>',
        html_success    = '<span class="alert-success">Success</span>',
        html_error      = '<span class="alert-danger">Error</span>';

    $(html_loading).appendTo($(message_span));
    $.ajax({
        type: 'GET',
        url: "/teacher/marking/decline/" + element_id,
        success: function (data) {
            $.map($('.wait-approve-text-' + element_id), function(e){
                $(e).remove();
            });
            $(_this).parent().parent().remove();
            $(message_span).children($(html_loading)).remove();
            $(html_success).appendTo($(message_span));
            $(message_span).children($(html_success)).fadeOut(1000);
        },
        error: function (){
            $(_this).siblings($(html_loading)).remove();
            $(html_error).appendTo($(message_span));
        }
        });
    });


</script>
@endsection
