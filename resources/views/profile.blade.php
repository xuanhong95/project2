@extends('layouts.app')
@section('content')

<div class="container" style="margin-top:70px">

    <div class="col-md-10 col-md-offset-1 well">
        <legend>Profile:</legend>
        <!-- Student Profile -->
        {!! $form->header !!}

        @if(\Auth::user()->user_type==0)
        <div class="form-group">
            <label for="dob" class="col-sm-3 control-label"></label>
            <div class="col-sm-6 ">
                {!! $form->message !!}
            </div>
        </div>

        <div class="form-group">
            <label for="class" class="col-sm-3 control-label">Class:</label>
            <div class="col-sm-6 ">
                {!! $form->field('class') !!}
            </div>
        </div>
        <div class="form-group">
            <label for="student_number" class="col-sm-3 control-label">Student Number:</label>
            <div class="col-sm-6 ">
                {!! $form->field('student_number') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="is_male" class="col-sm-3 control-label">Gender:</label>
            <div class="col-sm-6 ">
                {!! $form->field('is_male') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="dob" class="col-sm-3 control-label">Date of Birth:</label>
            <div class="col-sm-6 ">
                {!! $form->field('dob') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="address" class="col-sm-3 control-label">Address:</label>
            <div class="col-sm-6 ">
                {!! $form->field('address') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">Phone:</label>
            <div class="col-sm-6 ">
                {!! $form->field('phone') !!}
            </div>
        </div>

        <div class="form-group">
            <label for="have_laptop" class="col-sm-3 control-label">Laptop:</label>
            <div class="col-sm-6">
                {!! $form->field('have_laptop') !!}
            </div>
        </div>

        <div class="form-group ">
            <div class="col-md-offset-8">
                {!! $form->footer !!}
            </div>

        </div>
        @elseif(\Auth::user()->user_type==1)
        @elseif(\Auth::user()->user_type==2)
        @elseif(\Auth::user()->user_type==3)
        @elseif(\Auth::user()->user_type==4)
        @elseif(\Auth::user()->user_type==5)
        @endif

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
