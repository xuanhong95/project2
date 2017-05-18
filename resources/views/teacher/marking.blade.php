@extends('layouts.app')
@section('content')
@include('layouts.left-sidebar')
<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
    <!-- page header -->
    <div class="page-header col-md-offset-1">
        <h3>Marking</h3>
    </div>
    <div class="col-md-10 col-md-offset-1 well">
        @if( $students == null)
            <p><h3>There's no student to mark</h3></p>
        @else
        <table class="table table-striped table-hover table-bordered table-responsive">
            <tr>
                <th>No</th>
                <th>Student number</th>
                <th>Name</th>
                <th>Class</th>
                <th>Progress point</th>
                <th>Exam point</th>
            </tr>
            @foreach( $students as $student )
                <tr>
                    <td></td>
                    <td>{{ $student->student_number }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->class }}</td>
                    <td><input type="text" name="progress_point/{{ $student->user_id }}" value=""></td>
                    <td><input type="text" name="exam_point/{{ $student->user_id }}" value=""></td>
                </tr>
            @endforeach
        </table>
        @endif
        <div class="col-md-3 pull-right">
            <input type="submit" name="" value="Submit">
        </div>
    </div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="/js/jquery.numeric.js"></script>
<script type="text/javascript">
    $("input").numeric();
</script>
@endsection
