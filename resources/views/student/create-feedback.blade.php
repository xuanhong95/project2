@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top:70px">
        <div class="col-md-10 col-md-offset-1 well">
            <legend>New Feedback</legend>
            <div class="">
                <h4>Season:{!! $lastSeason->id !!}</h4>
            </div>
            <div class="col-md-8 col-md-offset-2">
                {!! $form !!}
            </div>
        </div>
    </div>
@endsection
