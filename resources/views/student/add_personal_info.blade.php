@extends('layouts.app')

@section('content')
<div class="container" style='margin-top:70px'>
    @if(Session::has('message'))
    <div class="alert alert-success">
        {!! Session::get('message') !!}
    </div>
    <script>
    var count = 3;
    function countDown(){
        var timer = document.getElementById("timer");
        if(count > 0){
            count--;
            timer.innerHTML = "Tự động chuyển về trang chủ trong trong <b>"+count+"</b> giây.";
            setTimeout("countDown()", 1000);
        }else{
            window.location.href = '/';
        }
    }
    </script>
    <div class="wrap">
        <p id="timer"><script type="text/javascript">countDown();</script></p>
    </div>
    @else
    <div class="form-group">
        {!! $form->header !!}
        <div class="row" >
            <center><h1>Cập nhật thông tin cá nhân</h1></center>
            <div style="margin-top: 50px">
                <div class="form-group">
                    <div class="col-sm-2" style="text-align: right;">
                        <label style="margin-top:5px; margin-bottom: 0px">
                            Tên:
                        </label>
                    </div>
                    <div class="col-md-7">
                        {!! $form->field('name') !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2" style="text-align: right;">
                        <label style="margin-top:5px; margin-bottom: 0px">
                            Lớp:
                        </label>
                    </div>
                    <div class="col-sm-7 required {{ $form->field('class')->has_error }}">
                        {!! $form->field('class') !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2" style="text-align: right;">
                        <label style="margin-top:5px; margin-bottom: 0px">
                            MSSV:
                        </label>
                    </div>
                    <div class="col-md-7 required {{ $form->field('student_number')->has_error }}">
                        {!! $form->field('student_number') !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2" style="text-align: right;">
                        <label style="margin-top:5px; margin-bottom: 0px">
                            Số điện thoại:
                        </label>
                    </div>
                    <div class="col-sm-7 required {{ $form->field('phone')->has_error }}">
                        {!! $form->field('phone') !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2" style="text-align: right;">
                        <label style="margin-top:5px; margin-bottom: 0px">
                            Giới tính:
                        </label>
                    </div>
                    <div class="col-sm-7 required {{ $form->field('is_male')->has_error }}">
                        {!! $form->field('is_male') !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2" style="text-align: right;">
                        <label style="margin-top:5px; margin-bottom: 0px">
                            Ngày sinh:
                        </label>
                    </div>
                    <div class="col-sm-7 required {{ $form->field('dob')->has_error }}">
                        {!! $form->field('dob') !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2 col-md-offset-10" style="margin-top: 15px">
                        {!! $form->footer !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="/js/jquery.numeric.js"></script>
<script type="text/javascript">
    $('#dob').datepicker();
</script>
@endsection
