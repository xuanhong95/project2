@extends('layouts.app')
@extends('layouts.left-sidebar')

@section('content-with-sidebar')
    <div class="container" style="margin-top:70px">
        <div class="col-md-10 col-md-offset-1 well">
            <div class="page-header col-md-offset-1">
                <h3>New Feedback</h3>
            </div>
            <div class="">
                <h4>Season:{!! $lastSeason->id !!}</h4>
            </div>
            <div class="col-md-8 col-md-offset-2">
                {!! $form !!}
            </div>
        </div>
    </div>
@endsection
