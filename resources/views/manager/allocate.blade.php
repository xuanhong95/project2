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
            <h3>Company: {{ $company->name }}</h3>
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
                        <select class="instructor form-control" name="">
                            @foreach( $company->instructors as $instructor )
                            <option value="{{ $instructor->user_id }}"
                                <?php echo $instructor == $roles->instructor?"selected":""; ?>
                                >{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="teacher  form-control" name="">
                            @foreach( $teachers as $teacher )
                            <option value="{{ $teacher->user_id }}"
                                <?php echo $teacher == $roles->teacher?"selected":"" ?>
                                >{{ $teacher->name }}</option>
                            @endforeach
                        </select>

                    </td>
                    <td>
                        <span class="glyphicon"></span>
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
            @foreach( $noCompanyStudents as $student)
            <tr id="{{ $student->user_id }}" class="noCompany">
                <td>
                    {{ $student->student_number }}
                </td>
                <td>
                    {{ $student->name }}
                </td>
                <td>
                    <select class="company form-control">
                        <option value="0">--Choose Company--</option>
                        @foreach( $companies as $company )
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                    <td>
                        <select class="instructor form-control" name="">
                            <option value="0">--Choose Instructor--</option>
                        </select>
                    </td>
                    <td>
                        <select class="teacher form-control" name="">
                            <option value="">--Choose Teacher--</option>
                            @foreach( $teachers as $teacher )
                            <option value="{{ $teacher->user_id }}">{{ $teacher->name }}</option>
                            @endforeach
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
<script src = "/js/toastr.min.js"></script>
<script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

$(function(){
    $(".hasCompany").on('change',"select", function(){
        var studentDiv = $(this).closest(".hasCompany");
        $.ajax({
            url:"{{ route('allocate') }}",
            method: "post",
            currentElement : $(this),
            data: {
                student_id: studentDiv.attr("id"),
                company_id: studentDiv.closest(".collapse").attr("id"),
                instructor_id: studentDiv.find(".instructor").val(),
                teacher_id: studentDiv.find(".teacher").val(),
                season: {{ $season->id }},
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(result){

                toastr.success("Success");
            },
            error:function(result){
                this.currentElement.next("span").addClass("glyphicon-remove");
            }
        });
    });

    $(".noCompany").on("change","select",function(){
        var studentDiv = $(this).closest(".noCompany");
        $.ajax({
            url:"{{ route('allocate') }}",
            method: "post",
            containerDiv : studentDiv,
            company_id: studentDiv.find(".company").val(),
            data: {
                student_id: studentDiv.attr("id"),
                company_id: studentDiv.find(".company").val(),
                instructor_id: studentDiv.find(".instructor").val(),
                teacher_id: studentDiv.find(".teacher").val(),
                season: {{ $season->id }},
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(result){
                this.containerDiv.find("span").addClass("glyphicon-ok");
                if(this.containerDiv.context.className.includes("company")){
                    console.log("has class company");
                    var inInstructorCombobox = this.containerDiv.find(".instructor");
                    var inCompanyId = this.company_id;
                    loadInstructors( inInstructorCombobox, inCompanyId );
                }else{
                    toastr.success("Success");
                }

            },
            error:function(result){
                this.currentElement.next("span").addClass("glyphicon-remove");
                toastr.error("Error");
            }
        });
    });

    function loadInstructors( inInstructorCombobox, inCompanyId ){
        $.ajax({
            url: "{{ route('getInstructorsOfCompany') }}",
            method: "post",
            combobox: inInstructorCombobox,
            data:{
                company_id : inCompanyId,
            },
            success: function( instructors ){
                console.log(instructors);
                var html = "<option value='0'>--Choose Instructor--</option>\n";
                for( instructor of instructors ){
                    html += '<option value="'+instructor.user_id+'">'+instructor.name+'</option>\n';
                }
                this.combobox.html(html);
                console.log(this.combobox);
                toastr.success("Success");
            },
            error:function(result){
                $(this).next("span").addClass("glyphicon-remove");
            }
        });
    }
});
</script>
@endsection
