@extends('layouts.app')

@section('content')
<style media="screen">
    btn-toolbar{
        margin-left:
    }
</style>
@include('layouts.left-sidebar')
<div class="container-fluid" style="margin-top:30px">
    <div class="col-md-10 col-md-offset-1 well">
        <div class="page-header col-md-offset-1">
            <h3>Profile</h3>
        </div>
        <div class="col-md-8 col-md-offset-1">
            {!! $form !!}
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    $('#dob').datepicker({
        changeMonth:true,
        changeYear:true,
        yearRange:'1960:',
        dateFormat:'dd/mm/yy',
        defaultDate:'1/6/1995'
    });
</script>
@endsection
