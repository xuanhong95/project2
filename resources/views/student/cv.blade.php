@extends('layouts.app')
<style>
    #have_laptop{
        margin-top: 8px;
    }
    input[type=checkbox]{
        transform: scale(1.2);
    }
    td{
        height:40px;
    }
    table{
        border-collapse: collapse;
    }
    #add-button:hover{
        cursor: pointer;
    }
    .pull-left{
        float: right!important;
    }
    .form-group{
        margin-top: 5px;
        margin-bottom: 5px!important;
    }
</style>
@section('content')
<div class="container" style='margin-top:70px'>
    @if(Session::has('message'))
    <div class="alert alert-success">
        {!! Session::get('message') !!}
    </div>
    @endif
    <div class="form-group">
        {!! $form->header !!}
        <div class="row" >
            <center><h1>Phiếu đăng ký nguyện vọng thực tập</h1></center>
            <div style="margin-top: 20px">
               <table class="col-md-10 col-md-offset-1"  style="border:1px solid black">
                <tr>
                    <td class="col-md-3" style="border:1px solid black">Họ và tên
                    </td>
                    <td class="col-md-5" style="border:1px solid black">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! $form->field('name') !!}
                            </div>
                        </div>
                    </td>
                    <td class="col-md-4" style="border:1px solid black">
                        <div class="form-group">
                            <div class="col-sm-4" style="text-align: right;">
                                <label style="margin-top:5px; margin-bottom: 0px">
                                    Lớp:
                                </label>
                            </div>
                            <div class="col-sm-7 required {{ $form->field('class')->has_error }}">
                                {!! $form->field('class') !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3" style="border:1px solid black">Số hiệu sinh viên
                    </td>
                    <td class="col-md-5" style="border:1px solid black">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! $form->field('student_number') !!}
                            </div>
                        </div>
                    </td>
                    <td class="col-md-4" style="border:1px solid black">
                        <table>
                            <tr>
                                <div class="form-group">
                                    <div class="col-sm-4" style="text-align: right;">
                                        <label style="margin-top:5px; margin-bottom: 0px">
                                            Giới tính:
                                        </label>
                                    </div>
                                    <div class="col-sm-7 required {{ $form->field('is_male')->has_error }}">
                                        {!! $form->field('is_male') !!}
                                    </div>
                                </div>
                            </tr>
                            <br>
                            <tr>
                                <div class="form-group">
                                    <div class="col-sm-4" style="text-align: right;">
                                        <label style="margin-top:5px; margin-bottom: 0px">
                                            Có laptop:
                                        </label>
                                    </div>
                                    <div class="col-sm-7 required {{ $form->field('have_laptop')->has_error }}">
                                        {!! $form->field('have_laptop') !!}
                                    </div>
                                </div>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3" style="border:1px solid black">Địa chỉ nơi đang ở
                    </td>
                    <td class="col-md-5" style="border:1px solid black">
                        <div class="form-group">
                            <div class="col-sm-12 required {{ $form->field('address')->has_error }}">
                                {!! $form->field('address') !!}
                            </div>
                        </div>
                    </td>
                    <td class="col-md-4" style="border:1px solid black">
                        <table>
                            <tr>
                                <div class="form-group">
                                    <div class="col-sm-4" style="text-align: right;">
                                        <label style="margin-top:5px; margin-bottom: 0px">
                                            Điện thoại:
                                        </label>
                                    </div>
                                    <div class="col-sm-7 required {{ $form->field('phone')->has_error }}">
                                        {!! $form->field('phone') !!}
                                    </div>
                                </div>
                            </tr>
                            <br>
                            <tr>
                                <div class="form-group">
                                    <div class="col-sm-4" style="text-align: right;">
                                        <label style="margin-top:5px; margin-bottom: 0px">
                                            Email:
                                        </label>
                                    </div>
                                    <div class="col-sm-7 required {{ $form->field('email')->has_error }}">
                                        {!! $form->field('email') !!}
                                    </div>
                                </div>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3" style="border:1px solid black">Khả năng tiếng anh
                        <td class="col-md-9" colspan="2" style="border:1px solid black">
                            <div class="form-group">
                                <div class="col-sm-3" style="text-align: right;">
                                    <label style="margin-top:5px; margin-bottom: 0px">
                                        Tên chứng chỉ:
                                    </label>
                                </div>
                                <div class="col-sm-3 required {{ $form->field('certificate_id')->has_error }}">
                                    {!! $form->field('certificate_id') !!}
                                </div>
                                <div class="col-sm-2" style="text-align: right;">
                                    <label style="margin-top:5px; margin-bottom: 0px">
                                        Điểm:
                                    </label>
                                </div>
                                <div class="col-sm-3 required {{ $form->field('point')->has_error }}">
                                    {!! $form->field('point') !!}
                                </div>
                            </div>
                        </td>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3" style="border:1px solid black">Những kiến thức, kỹ năng đã có
                        <td class="col-md-9" colspan="2" style="border:1px solid black">Kỹ năng lập trình:
                            <table class="col-md-12 add-line"  style="text-align: center; margin: 20px 0px">
                                <tr>
                                    <td class="col-md-3" rowspan="2" style="border:1px solid black; height: 30px">Ngôn ngữ
                                    </td>
                                    <td class="col-md-9" colspan="3" style="border:1px solid black; padding: 0px 0px; height: 30px;">Mức độ sử dụng
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black"> Biết
                                    </td>
                                    <td style="border: 1px solid black"> Có thể sử dụng
                                    </td>
                                    <td style="border: 1px solid black"> Thành thạo
                                    </td>
                                </tr>
                                <tr class="skill-point">
                                    <td style="border: 1px solid black">
                                        <div class="col-sm-12 required {{ $form->field("language_id")->has_error }}">
                                            {!! $form->field("language_id") !!}
                                        </div>
                                    </td>
                                    <td style="border: 1px solid black">
                                        <input type="radio" id='regular' name="optradio1" value="1">
                                    </td>
                                    <td style="border: 1px solid black">
                                        <input type="radio" id='regular' name="optradio1" value="2">
                                    </td>
                                    <td style="border: 1px solid black">
                                        <input type="radio" id='regular' name="optradio1" value="3">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: right; border: none;">
                                        <img id="add-button" src="/images/addcontent.png"/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3" style="border:1px solid black">Những kiến thức, kỹ năng muốn học hỏi
                    </td>
                    <td class="col-md-9" colspan="2" style="border:1px solid black">
                        <div class="col-sm-12 required {{ $form->field("desire_skill")->has_error }}" style="margin-top:5px; margin-bottom:5px">
                            {!! $form->field("desire_skill") !!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3" style="border:1px solid black">Ghi đầy đủ thông tin sau nếu sinh viên đã có địa chỉ thực tập
                    </td>
                    <td class="col-md-9" colspan="2" style="border:1px solid black">
                        <p>Tên đầy đủ của cơ quan, công ty:</p>
                        <p>Địa chỉ:</p>
                        <p>Người phụ trách</p>
                        <p>Điện thoại:</p>
                        <p>Email:</p>
                        <p>Thời gian thực tập:</p>
                        <p>Từ: đến: </p>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-12" colspan="3" style="border:1px solid black">Nếu sinh viên chưa thực tập ở công ty nào thì mục trên ghi "Không có".<br> 
                        Viện Đào tạo Quốc tế sẽ căn cứ trên kỹ năng của sinh viên và yêu cầu của doanh nghiệp để phân công. 
                        Sinh viên phải cam kết tuân thủ theo phân công của Viện.
                    </td>
                </tr>
            </table>
            <div class="form-group">
                <div class="col-md-2 col-md-offset-10" style="margin-top: 15px">
                    {!! $form->footer !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="/js/jquery.numeric.js"></script>
<script>
    var count_skill = 1;
    
    $('#add-button').click(function(){
        count_skill++;
        var html = '<tr class="skill-point"><td style="border: 1px solid black"> <div class="col-sm-12 required {{ $form->field("language_id")->has_error }}">{!! $form->field("language_id") !!}</div> </td> <td style="border: 1px solid black"><input type="radio" id="regular" name="optradio'+ count_skill + '" value="1"></td><td style="border: 1px solid black"><input type="radio" id="regular" name="optradio'+ count_skill +'" value="2"></td><td style="border: 1px solid black"><input type="radio" id="regular" name="optradio'+ count_skill +'" value="3"></td></tr>';
        
        if(count_skill == 5){
            $('#add-button').addClass('hidden');
        }
        $('.add-line tr:last').before(html);
    });

    $("#phone").numeric();
</script>
@endsection