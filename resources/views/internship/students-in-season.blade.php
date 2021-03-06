@extends('layouts.app')

@section('content')
<div class="container" style="background:#f8f8f8;margin-bottom:30px">
    <div class="page-header col-md-offset-1">
        <h3>Students</h3>
    </div>
    <div class="col-md-10 col-md-offset-1 well">
        <div class="">
            <label for="season">Season: </label>
            <select class="" id="season">
                @foreach( $all_season_id as $season_id )
                    <option value="{!! $season_id->id !!}">{!! $season_id->id !!}</option>
                @endforeach
            </select>
        </div>
        <div class="row col-md-10 col-md-offset-1" style="margin-top:10px">
            @foreach( $students as $student)
                <div class="btn btn-default col-md-12" style="margin-top:3px">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="text-center text-primary">
                                <h4><strong>{!! $student->name !!}</strong></h4>
                            </div>
                            <div class="">
                                <div class="col-md-6">
                                    <h5>Class: {!! $student->class !!}</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>Student number: {!! $student->student_number !!}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-3 pull-right" style="margin-top:15px">
            <a href="{!! route('homepage') !!}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

    $('#season').on('change',function(){
        window.location('{!! route("students-in-season") !!}/'+$(this).val());
    });
</script>
@endsection
