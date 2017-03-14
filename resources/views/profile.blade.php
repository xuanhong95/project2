@extends('layouts.app')
@section('content')
<style media="screen">
    btn-toolbar{
        margin-left:
    }
</style>

<div class="container" style="margin-top:70px">
    <div class="col-md-10 col-md-offset-1 well">
        <legend>Profile:</legend>
        <div class="col-md-8 col-md-offset-1">
            {!! $form !!}            
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
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
