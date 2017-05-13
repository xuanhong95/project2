@extends('layouts.app')
@section('content')
@include('layouts.left-sidebar')
<style media="screen">
    .in{
        display: table;
    }
</style>
<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
    <!-- page header -->
    <div class="page-header col-md-offset-1">
        <h3>Allocation status</h3>
    </div>
    <!-- end page header -->

    <!-- Companies with their accepted interns -->
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
    <!-- End accepted interns -->

    <!-- left students -->
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
                <td>
                    <select id="{{ $student->user_id}}">
                        <option value="0">--Choose--</option>
                        @foreach( $companiesInSeason as $company )
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                    <span class="glyphicon"></span>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
    $("select").on('change', function(){
        var currentSelect = $(this);
        $.ajax({
            url:"{{ route('allocate') }}",
            currentElement : currentSelect,
            data: {
                student_id: $(this).attr("id"),
                company_id: $(this).val()
            },
            success:function(result){
                this.currentElement.next("span").addClass("glyphicon-ok");
            },
            error:function(result){
                this.currentElement.next("span").addClass("glyphicon-remove");
            }
        });
    });
});
</script>
@endsection
