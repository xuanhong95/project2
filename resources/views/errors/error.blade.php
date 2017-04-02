@extends('layouts.app')
@section('content')
<div class="container" style="margin:80px">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h2>Error</h2>
        </div>
        <div class="panel-body">
            <h3>{!! $error !!}</h3>
        </div>
        <div class="panel-footer">
            <a href="{!! $link !!}" role="button" class="btn btn-default">Back</a>
        </div>
    </div>
</div>
@endsection
