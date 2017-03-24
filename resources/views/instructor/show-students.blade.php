@extends('layouts.app')
@section('content')
<div class="container" style="margin-top:70px">
    <div class="col-md-10 col-md-offset-1 well">
        <legend>Students</legend>
        <div class="col-md-12 btn btn-default">
            @foreach( $students as $student)
            <div class="col-md-12">
                <div class="col-md-6 row">
                    <div class="row">
                        <h4 class="text-center"><a href="#"><strong>{!! $student->name !!}</strong></a></h4>
                    </div>
                    <div class="text-center row">
                        <div class="col-md-6">
                            <p>Class: {!! $student->class !!}</p>
                        </div>
                        <div class="col-md-6">
                            <p>Student number: {!! $student->student_number !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{!! route('commit-work',['student_id'=>$student->user_id]) !!}"
                                role="button" class="btn btn-info">Works</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{!! route('instructor-feedback',['student_id'=>$student->user_id]) !!}"
                                role="button" class="btn btn-info">Feedback</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
