@extends('layouts.app')

@section('content')
@include('layouts.left-sidebar')
    <div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
        <div class="page-header col-md-offset-1">
            <h3>New Feedback</h3>
        </div>
        <div class="col-md-10 col-md-offset-1 well">
            <div class="">
                <h4>Season:{!! $lastSeason->id !!}</h4>
            </div>
            <div class="col-md-8 col-md-offset-2">
                {!! $form !!}
            </div>
        </div>
    </div>
@endsection
