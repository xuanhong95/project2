@extends('layouts.app')
@section('content')
@include('layouts.left-sidebar')
<link rel="stylesheet" href="/css/toastr.min.css">
<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
    <!-- page header -->
    <div class="page-header col-md-offset-1">
        <h3>Allocation status</h3>
    </div>
    <!-- end page header -->

    <!-- Companies with their accepted interns -->
    <div class="col-md-10 col-md-offset-1 well">
        <legend>Companies with students</legend>
        @foreach( $internshipStatus->companies as $company)
        <div class="btn btn-default btn-block" data-toggle="collapse" data-target="#{{ $company->id }}" >
            <h3>{{ $company->name }}</h3>
        </div>

        <div id="{{ $company->id }}" class="collapse" >
            <table  class="table table-responsive table-striped table-hover table-bordered">
                <tr>
                    <th>Student number</th>
                    <th>Name</th>
                    <th>Enterprise instructor</th>
                    <th>Teacher</th>
                </tr>
                @foreach( $company->studentInstructor as $roles)
                <tr id="{{ $roles->student->user_id }}" class="hasCompany">
                    <td><h4>{{ $roles->student->student_number }}</h4></td>
                    <td><h4>{{ $roles->student->name }}</h4></td>
                    <td>
                        <h4>{{$roles->instructor->name}}</h4>
                    </td>
                    <td>
                        <h4>{{$roles->teacher->name}}</h4>
                    </td>
                </tr>
                @endforeach

            </table>
        </div>

        @endforeach
    </div>
    <!-- End accepted interns -->

    <!-- left students -->
    <div class="col-md-10 col-md-offset-1 well">
        <legend>Non-company students</legend>
        <table class="table table-striped table-hover table-bordered">
            <tr>
                <th class="col-md-3">Student number</th>
                <th>Name</th>
            </tr>
            @foreach( $noCompanyStudents as $student)
            <tr id="{{ $student->user_id }}" class="noCompany">
                <td>
                    {{ $student->student_number }}
                </td>
                <td>
                    {{ $student->name }}
                </td>
            </tr>
            @endforeach
        </table>

    </div>
    <!-- end left student -->

    <div class="col-md-3 col-md-offset-1" style="margin-bottom: 20px;">
        <a href="{{ route('allocations') }}" class="btn btn-default btn-lg">Back</a>
    </div>
</div>
@endsection
