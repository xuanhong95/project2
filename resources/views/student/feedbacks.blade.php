@extends('layouts.app')

@section('content')
    <div class="container" style="background:#f8f8f8;margin-bottom:30px">
        <div class="page-header col-md-offset-1">
            <h3>Feedback</h3>
        </div>
        <div class="col-md-offset-1 col-md-6">
            <a href="{!! route('create-feedback')!!}" role="button" class="btn btn-info">New Feedback...</a>
        </div>
        <div class="col-md-10 col-md-offset-1 well" style="margin-top:20px">

            <div class="col-md-10 col-md-offset-1" >
                @if( is_null($feedbacks))
                    <h1>There are not any feedbacks!</h1>
                @else
                    <div class="col-md-12" style="text-align:center">
                        <div class="col-md-3 col-md-offset-1">
                            <h4>Company</h4>
                        </div>
                        <div class="col-md-3 col-md-offset-5">
                            <h4>Status</h4>
                        </div>
                    </div>
                    @foreach( $feedbacks as $feedback )
                        <div class="col-md-12 btn btn-default" style="margin-top:3px"
                            onclick="location.href='{!! route('show-feedback',['id'=>$feedback->id]) !!}'">
                            <div class="col-md-5 ">
                                <h4>{!! $feedback->name !!}</h4>
                                <h5>Season: {!! $feedback->season !!}</h5>
                            </div>
                            <div class="col-md-3 col-md-offset-4">
                                <p>
                                    <?php
                                        if( is_null( $feedback->is_confirmed) ) echo "Unapproved";
                                        else echo $feedback->is_confirmed ? "Accepted":"Declined";
                                    ?>
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <br>
            <br>
            <div class="col-md-11 col-md-offset-1" style="margin-top:30px">
                <a href="{!! route('homepage') !!}" role="button" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>

@endsection
