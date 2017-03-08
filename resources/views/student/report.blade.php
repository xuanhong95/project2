@extends('layouts.app')

@section('content')
<style media="screen">
#time_from,#time_to{
    width: 30%;
    display: inline-block;
    margin-right: 20px;
}
.row-limit{
    min-height:30px;
    height:3em;
}
</style>
<div class="container" style="margin-top:70px">
    <div class="col-md-10 col-md-offset-1">
        <h2>Báo Cáo Thực Tập</h2>
        <div class="well" >
            {!! $form->header !!}
            <div class="form-group">
                <label for="dob" class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                    {!! $form->message !!}
                </div>
            </div>
            <!-- Start Thông tin sinh viên -->

            <legend >Thông tin sinh viên</legend>
            <div class="" style="background:#fff">

                <div class="form-group">
                    <label for="student_name" class="col-sm-3 control-label">Họ và tên:</label>
                    <div class="col-sm-5">
                        {!! $form->field('student_name') !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="student_name" class="col-sm-3 control-label">Mã số sinh viên:</label>
                    <div class="col-sm-5">
                        {!! $form->field('student_number') !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="student_phone" class="col-sm-3 control-label">Số điện thoại:</label>
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

                <div class="form-group">
                    <label for="company_address" class="col-sm-3 control-label">Địa chỉ đến thực tập: <Ghi đầy đủ tên công ty, địa chỉ></label>
                        <div class="col-sm-5">
                            {!! $form->field('company_address') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="company_guide" class="col-sm-3 control-label">Người phụ trách/hướng dẫn tại cơ sở thực tập:</label>
                        <div class="col-sm-5">
                            {!! $form->field('company_guide') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Thời gian được cử đi thực tập: </label>
                        <div class="col-sm-5">
                            <label for="time_from">từ:</label>
                            {!! $form->field('time_from') !!}
                            <label for="time_to">đến:</label>
                            {!! $form->field('time_to') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="guide_teacher" class="col-sm-3 control-label">Giáo viên phụ trách:</label>
                        <div class="col-sm-5">
                            {!! $form->field('guide_teacher') !!}
                        </div>
                    </div>
                    <br>
                    <br>
                    <hr>
                </div>

                <!-- End Thông tin sinh viên -->
                <br><br>
                <!-- Start Nội dung báo cáo -->
                <legend>Nội dung báo cáo</legend>

                <div class="" style="background:#fff">
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
                    <br>
                    <br>
                </div>

                <!-- End Nội dung báo cáo -->

                {!! $form->footer !!}
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
