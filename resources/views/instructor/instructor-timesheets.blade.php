@extends('layouts.app')
@section('content')
@include('layouts.left-sidebar')
<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
    <div class="page-header col-md-offset-1">
        <h3>Timesheets</h3>
    </div>
    <div class="col-md-10 col-md-offset-1 well">
        @foreach( $studentsInSeason as $student)
            <div class="btn btn-default btn-block" data-toggle="collapse" data-target="#{{ $student->user_id }}" >
                <h3>Student: {{ \App\User::getUserNameByID( $student->user_id ) }}</h3>
            </div>

            <div id="{{ $student->user_id }}" class="collapse" >
                <div class="">
                    <label for="month">Month</label>
                    <select class="" name="">

                    </select>
                </div>
                <div class="" style="overflow:auto">
                    <table class="table table-responsive table-striped table-hover table-bordered">
                        <tr>
                            <th>Work content</th>
                            <th>Status</th>
                            @for( $i = 1; $i < 32; $i++)
                                <th>{{ $i }}</th>
                            @endfor
                        </tr>
                        @for( $i = 0; $i < count($taskForms); $i++)
                            @foreach( $taskForms[$i] as $taskForm)
                                @if($taskForm->student_id == $student->user_id)
                                <tr>
                                    <td rowspan="6">{{ $taskForm->content }}</td>
                                    <td>Enought time</td>
                                    @for( $day = 1; $day < 32; $day++)
                                        <td><input type="radio" name="{{ $day }}/{{ $taskForm->id }}" value="enough{{ $day }}"/></td>
                                    @endfor
                                </tr>
                                <tr>
                                    <td>Over time</td>
                                    @for( $day = 1; $day < 32; $day++)
                                        <td><input type="radio" name="{{ $day }}/{{ $taskForm->id }}" value="overtime{{ $day }}"/></td>
                                    @endfor
                                </tr>
                                <tr>
                                    <td>Sick leave</td>
                                    @for( $day = 1; $day < 32; $day++)
                                        <td><input type="radio" name="{{ $day }}/{{ $taskForm->id }}" value="sick{{ $day }}"/></td>
                                    @endfor
                                </tr>
                                <tr>
                                    <td>Leave</td>
                                    @for( $day = 1; $day < 32; $day++)
                                        <td><input type="radio" name="{{ $day }}/{{ $taskForm->id }}" value="leave{{ $day }}"/></td>
                                    @endfor
                                </tr>
                                <tr>
                                    <td>Leave without Absent</td>
                                    @for( $day = 1; $day < 32; $day++)
                                        <td><input type="radio" name="{{ $day }}/{{ $taskForm->id }}" value="withoutAbsent{{ $day }}"/></td>
                                    @endfor
                                </tr>
                                <tr>
                                    <td>Other reason</td>
                                    @for( $day = 1; $day < 32; $day++)
                                        <td><input type="radio" name="{{ $day }}/{{ $taskForm->id }}" value="other{{ $day }}"/></td>
                                    @endfor
                                </tr>
                                @endif
                            @endforeach
                        @endfor
                    </table>
                </div>

            </div>

        @endforeach
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('input').on('change',function(){
            $.ajax({
                url:,
                data:{

                },
                success:function(){},
                error:function(){}
            });
        });
    });
</script>
@endsection
