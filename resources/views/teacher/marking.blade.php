@extends('layouts.app')
@section('content')
@include('layouts.left-sidebar')

<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
    <!-- page header -->
    <div class="page-header col-md-offset-1">
        <h3>Marking</h3>
    </div>
    <div class="col-md-10 col-md-offset-1 well">
        @if( $resultOfStudents == null)
        <p><h3>There's no student to mark</h3></p>
        @else
        {{$message}}
        <form action="{{ route('teacher-marking') }}" method="post">
            {{ csrf_field() }}
        <table class="table table-striped table-hover table-bordered table-responsive">
            <tr>
                <th>No</th>
                <th>Student number</th>
                <th>Name</th>
                <th>Class</th>
                <th>Progress point</th>
                <th>Exam point</th>
            </tr>

                @foreach( $resultOfStudents as $key=>$result )

                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $result->student_number }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->class }}</td>
                        <td><input type="text" class="form-control" name="progress_point/{{ $result->user_id }}" value="{{ $result->progress_point }}"></td>
                        <td><input type="text" class="form-control" name="exam_point/{{ $result->user_id }}" value="{{ $result->exam_point }}"></td>
                    </tr>

                @endforeach
            </table>
            @endif
            <div class="col-md-3 col-md-offset-1">
                <a href="{{ route('homepage') }}" class="btn btn-default"><i class="glyphicon glyphicon-chevron-left"></i>Back</a>
            </div>
            <div class="col-md-3 pull-right">
                <input type="submit" class="btn btn-default" value="Submit">
            </div>
        </form>
    </div>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="/js/jquery.numeric.js"></script>
<script type="text/javascript">
$("input").numeric();
</script>
@endsection
