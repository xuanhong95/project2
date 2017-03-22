@extends('layouts.app')

@section('content')
<style media="screen">
#time_from,#time_to{
    width: 30%;
    display: inline-block;
    margin-right: 20px;
}
    textarea.form-control {
        max-height: 60px;
    }
</style>
<div class="container" style="margin-top:70px">

        <h2>Báo Cáo Thực Tập</h2>
        <div class="" >
            {!! $form->header !!}
            <div class="col-md-3 col-md-offset-3">
                    <h3>{!! $form->message !!}</h3>
            </div>
            <br><br>
            <!-- Start Thông tin sinh viên -->
            <div class="col-md-12">
                <div class="col-md-6">
                    <legend >Student Information</legend>
                    <div class="col-md-12" style="background:#fff">
                        <div class="col-md-8 col-md-offset-2">
                            <br>
                            <div class="form-group">
                                <label for="student_name" class="col-sm-3 control-label">Name:</label>
                                <div class="col-sm-5">
                                    {!! $form->field('student_name') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="student_name" class="col-sm-3 control-label">Student Number:</label>
                                <div class="col-sm-5">
                                    {!! $form->field('student_number') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="student_phone" class="col-sm-3 control-label">Phone:</label>
                                <div class="col-sm-5">
                                    {!! $form->field('student_phone') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="student_email" class="col-sm-3 control-label">Email:</label>
                                <div class="col-sm-5">
                                    {!! $form->field('student_email') !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <legend>Internship Information</legend>
                    <div class="col-md-12 well">
                        <div class="col-md-10 col-md-offset-2">
                            <div class="form-group">
                                <label for="company_address" class="col-sm-4 control-label">Company:</label>
                                <div class="col-sm-8">
                                    {!! $form->field('company_name') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="company_address" class="col-sm-4 control-label">Address:</label>
                                <div class="col-sm-8">
                                    {!! $form->field('company_address') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="company_guide" class="col-sm-4 control-label">Enterprise Instructor:</label>
                                <div class="col-sm-8">
                                    {!! $form->field('company_guide') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="control-label">Internship time:</label>
                                <div class="col-sm-10 col-sm-offset-2">
                                    
                                    <label for="time_from" class="col-sm-2">From:</label>
                                    <div class="col-sm-10">
                                        {!! $form->field('time_from') !!}
                                    </div>
                                    <label for="time_to" class="col-sm-2">To:</label>
                                    <div class="col-sm-10">
                                        {!! $form->field('time_to') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="guide_teacher" class="col-sm-4 control-label">Instructor Teacher:</label>
                                <div class="col-sm-8">
                                    {!! $form->field('guide_teacher') !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- End Thông tin sinh viên -->
            <!-- Start Nội dung báo cáo -->
            <div class="col-md-12">
                <legend>Nội dung báo cáo</legend>

                <div class="well" >
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="work_purpose" class="col-sm-3 control-label">Mục đích thực tập:</label>
                        <div class="col-sm-5">
                            {!! $form->field('work_purpose') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="work_content" class="col-sm-3 control-label">Nội dung công việc được giao:</label>
                        <div class="col-sm-5">
                            {!! $form->field('work_content') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="result" class="col-sm-3 control-label">Kết quả thực hiện:</label>
                        <div class="col-sm-5">
                            {!! $form->field('result') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Tự đánh giá kết quả thực tập: </label>
                    </div>
                    <div class="form-group">
                        <br>
                        <div class="col-md-5 col-md-offset-1">
                            <label for="student_advantage">Ưu điểm:</label>
                            {!! $form->field('student_advantage') !!}

                        </div>
                        <div class="col-md-5">
                            <label for="student_shortcoming">Nhược điểm:</label>
                            {!! $form->field('student_shortcoming') !!}
                        </div>
                    </div>


                </div>

                <!-- End Nội dung báo cáo -->
                <div class="col-md-3 col-md-offset-9">
                    {!! $form->footer !!}
                </div>
            </div>

        </div>

</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
var dateFormat = "mm/dd/yy",
from = $( "#time_from" )
.datepicker()
.on( "change", function() {
    to.datepicker( "option", "minDate", getDate( this ) );
}),
to = $( "#time_to" ).datepicker({
    defaultDate: "+3w",
    changeMonth: true,
})
.on( "change", function() {
    from.datepicker( "option", "maxDate", getDate( this ) );
});

function getDate( element ) {
    var date;
    try {
        date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
        date = null;
    }

    return date;
}
</script>
@endsection
