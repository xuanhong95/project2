@extends('layouts.app')

@section('content')
<style media="screen">
.margin-seasons{
    margin-left: 30px;
    margin-bottom: 30px;
}
</style>
@include('layouts.left-sidebar')
<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
    <div class="page-header">
        <h3><strong>Seasons</strong></h3>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(count($seasons)==0)
            <div class="col-md-6 col-md-offset-3">
                <h2>There aren't any available seasons</h2>
            </div>
            @else
            @for ($i=count($seasons);$i>0;$i--)
            <div class="col-md-3 btn btn-lg margin-seasons
            {{ \App\Season::is_openningSeasonID($seasons[$i-1]->id)?'btn-success':'btn-warning' }}
            ">
            <a href="{!! route('edit-season',['season'=>$seasons[$i-1]->id]) !!}"
                style="color:white">
                <h4>Season {!! $seasons[$i-1]->id !!}</h4></a>
                <h5>Status: {{ \App\Season::getStatusSeasonID($seasons[$i-1]->id) }}</h5>
            </div>
            @endfor
            @endif
            <br>
        </div>
    </div>
    <div class="col-md-12">

        @if(\App\Season::is_closedSeasonID( end($seasons)->id ))
        <div class="col-md-2" style="margin-bottom:30px">
            <a href="{!! route('create-season') !!}"  class="btn btn-info">Start new Season...</a>
        </div>
        @endif
        <div class="col-md-2 pull-right">
            <a href="{{ route('homepage') }}" class="btn btn-default btn-lg">Back</a>
        </div>
    </div>
</div>
@endsection
