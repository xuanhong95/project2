@extends('layouts.app')
@section('content')
<style media="screen">
    .margin-left-seasons{
        margin-left: 60px;
    }
</style>
<div class="container" style="margin-top:70px">

    <div class="col-md-10" style="margin-bottom:30px">
        <a href="/teacher/seasons/create"  class="btn btn-primary">Start new Season...</a>
    </div>

    <div class="col-md-10 col-md-offset-1 well">
        <legend>Seasons:</legend>
        @if(count($seasons)==0)
            <div class="col-md-6 col-md-offset-3">
                <h2>There aren't any available seasons</h2>
            </div>
        @else
            @foreach($seasons as $season)
                <div class="" >
                    <div class="col-md-3 btn btn-lg btn-info margin-left-seasons">
                        <h4>Season {!! $season->id !!}</h4>
                        <h5>Status: ({!! $season->is_openning !!})</h5>
                    </div>
                </div>

            @endforeach
        @endif
    </div>

</div>
@endsection
