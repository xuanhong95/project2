@extends('layouts.app')
@section('content')
@include('layouts.left-sidebar')
    <div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
        <div class="page-header col-md-offset-1">
            <h3>Allocation status</h3>
        </div>
        <div class="col-md-10 col-md-offset-1 well">
            <legend>Companies with their interns</legend>
            @foreach( $companiesInSeason as $company)
                <div class="btn btn-default btn-block" data-toggle="collapse" data-target="#{{ $company->id }}" >
                    <h3>Company: {{ \App\Company::getCompanyNameByID( $company->id ) }}</h3>
                </div>
                
                <div id="{{ $company->id }}" class="collapse" >
                    <table  class="table table-responsive table-striped table-hover table-bordered">

                        @foreach( $allocations as $allocation)
                            @if( $company->id == $allocation->company_id )
                                <tr>
                                    <td ><h4>{{ \App\StudentInfo::getStudentNumberByID( $allocation->student_id ) }}</h4></td>
                                    <td ><h4>{{ \App\User::getUserNameByID( $allocation->student_id ) }}</h4></td>
                                </tr>
                            @endif
                        @endforeach

                    </table>
                </div>

            @endforeach
        </div>
        <div class="col-md-10 col-md-offset-1 well">
            <legend>Left Students</legend>
            <table class="table table-striped table-hover table-bordered">
                @foreach( $leftStudents as $student)
                    <tr>
                        <td>
                            {{ $student->student_number }}
                        </td>
                        <td>
                            {{ $student->name }}
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="">

            </div>
        </div>
        @if( \Auth::user()->user_type == 4 )
        <div class="col-md-4 pull-right" style="margin-bottom:20px">
            <a href="{{ route('manager-allocate') }}" class="btn btn-info btn-lg">Allocate
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
        @endif
    </div>
@endsection
