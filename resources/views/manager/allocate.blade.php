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
                <tr id="{{ $allocation->student_id }}" class="hasCompany">
                    <td><h4>{{ \App\StudentInfo::getStudentNumberByID( $allocation->student_id ) }}</h4></td>
                    <td><h4>{{ \App\User::getUserNameByID( $allocation->student_id ) }}</h4></td>
                    <td>
                        <select class="instructor form-control" name="">
                            <option value="{{ $allocation->instructor_id }}">{{ \App\User::getUserNameByID( $allocation->instructor_id ) }}</option>
                            <?php $instructorsInCompany = \App\EnterpriseInstructor::getInstructorsInCompany($allocation->company_id) ?>
                            @foreach( $instructorsInCompany as $instructor )
                            <option value="{{ $instructor->user_id }}">{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="teacher  form-control" name="">
                            <option value="{{ $allocation->teacher_id }}">{{ \App\User::getUserNameByID( $allocation->teacher_id ) }}</option>
                            <?php $teachers = \App\Teacher::getAllTeachers() ?>
                            @foreach( $teachers as $teacher )
                            <option value="{{ $teacher->user_id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>

                    </td>
                    <td>
                        <span class="glyphicon"></span>
                    </td>
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
            <tr id="{{ $student->user_id }}" class="notCompany">
                <td>
                    {{ $student->student_number }}
                </td>
                <td>
                    {{ $student->name }}
                </td>
                <td>
                    <select class="leftCompany form-control">
                        <option value="0">--Choose Company--</option>
                        @foreach( $companiesInSeason as $company )
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                    <td>
                        <select class="leftInstructor form-control" name="">
                            <option value="0">--Choose Instructor--</option>
                        </select>
                    </td>
                    <td>
                        <select class="leftTeacher form-control" name="">
                            <option value="0">--Choose Teacher--</option>
                        </select>
                    </td>
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
    $(".hasCompany").on('change',"select", function(){
        var studentDiv = $(this).closest(".hasCompany");
        console.log(studentDiv);
        $.ajax({
            url:"{{ route('allocate') }}",
            currentElement : $(this),
            data: {
                student_id: studentDiv.attr("id"),
                company_id: studentDiv.closest(".collapse").attr("id"),
                instructor_id: studentDiv.find(".instructor").val(),
                teacher_id: studentDiv.find(".teacher").val(),
                season: {{ $lastSeason }}
            },
            success:function(result){
                console.log("success");
                this.currentElement.next("span").addClass("glyphicon-ok");
                if(this.currentElement.hasClass("company")){
                    console.log("has class company");
                    var inInstructorCombobox = this.currentElement.closest(".instructor");
                    var inCompanyId = this.currentElement[0].value;
                    loadInstructors( inInstructorCombobox, inCompanyId );
                }
            },
            error:function(result){
                this.currentElement.next("span").addClass("glyphicon-remove");
            }
        });
    });

    function loadInstructors( inInstructorCombobox, inCompanyId ){
        console.log("loadInstructors");
        $.ajax({
            url: "{{ route('getInstructorsInCompany') }}",
            combobox: inInstructorCombobox,
            data:{
                company_id : inCompanyId,
            },
            success: function( instructors ){
                var html = "<option value='0'>--Choose Instructor--</option>/n";
                for( instructor of instructors ){
                    html += '<option value="'+instructor.attr("user_id")+'">'+instructor.attr("name")+'</option>/n';
                }
                this.combobox.text(html);
            },
            error:function(result){
                console.log(result);
                $(this).next("span").addClass("glyphicon-remove");
            }
        });
    }
});
</script>
@endsection
