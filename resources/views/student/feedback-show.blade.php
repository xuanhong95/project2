@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top:70px">
        <div class="col-md-10 col-md-offset-1 well">
            <legend>Feedback</legend>
            <div class="col-md-8 col-md-offset-2">
                {!! $form !!}
            </div>
            <div class="col-md-12 col-md-offset-1">
                <a href="{!! route('student-feedback') !!}" role="button"
                    class="btn btn-default">
                    Back
                </a>
            </div>
        </div>
    </div>
@endsection
