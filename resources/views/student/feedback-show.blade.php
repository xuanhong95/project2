@extends('layouts.app')

@section('content')
    <div class="container" style="background:#f8f8f8;margin-bottom:30px">
        <div class="col-md-10 col-md-offset-1 well">
            <div class="page-header col-md-offset-1">
                <h3>Feedback</h3>
            </div>
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
