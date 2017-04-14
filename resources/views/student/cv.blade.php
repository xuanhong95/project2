@extends('layouts.app')

<style>
    input[type=checkbox]{
        transform: scale(1.2);
    }
    table{
        border-collapse: collapse;
    }
    td{
        height:40px;
    }
    tbody{
        background:#d6d6d6;
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
    .textarea-height{
        margin-bottom: 0px!important;
        margin-top: 0px!important;
    }
    .textarea-width{
        padding-left: 0px!important;
        padding-right: 0px!important;
    }
    textarea{
        max-height: 7em;
        resize: none;
        overflow: auto;
    }
    p{
        margin: 0px 0px 0px 0px!important;
    }
    td{
        border: 1px solid black;
    }
    .name_field{
        padding-left: 7px!important;
    }

    .form-control{
        border-radius: 0px!important;
    }
    #add-button:hover{
        cursor: pointer;
    }
</style>
@section('content')
@include('layouts.left-sidebar')
<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
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
                    <td class="col-md-3">Họ và tên
                    </td>
                    <td class="col-md-5">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! $form->field('name') !!}
                            </div>
                        </div>
                    </td>
                    <td class="col-md-4">
                        <div class="form-group">
                            <div class="col-sm-5" style="text-align: right;">
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
                    <td class="col-md-3" rowspan="2">Số hiệu sinh viên
                    </td>
                    <td class="col-md-5" rowspan="2">
                        <div class="form-group">
                            <div class="col-md-12">
                                {!! $form->field('student_number') !!}
                            </div>
                        </div>
                    </td>
                    <td class="col-md-4">
                        <div class="form-group">
                            <div class="col-sm-5" style="text-align: right;">
                                <label style="margin-top:5px; margin-bottom: 0px">
                                    Giới tính:
                                </label>
                            </div>
                            <div class="col-sm-7 required {{ $form->field('is_male')->has_error }}">
                                {!! $form->field('is_male') !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <div class="col-sm-5" style="text-align: right;">
                                <label style="margin-top:5px; margin-bottom: 0px">
                                    Có laptop:
                                </label>
                            </div>
                            <div class="col-sm-7 required {{ $form->field('have_laptop')->has_error }}">
                                {!! $form->field('have_laptop') !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3" rowspan="2">Địa chỉ nơi đang ở
                    </td>
                    <td class="col-md-5" rowspan="2">
                        <div class="form-group textarea-height">
                            <div class="col-sm-12 required {{ $form->field('address')->has_error }} textarea-width">
                                {!! $form->field('address') !!}
                            </div>
                        </div>
                    </td>
                    <td class="col-md-4">
                        <div class="form-group">
                            <div class="col-sm-5" style="text-align: right;">
                                <label style="margin-top:5px; margin-bottom: 0px">
                                    Điện thoại:
                                </label>
                            </div>
                            <div class="col-sm-6 required {{ $form->field('phone')->has_error }}">
                                {!! $form->field('phone') !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
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
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3">Khả năng tiếng anh
                        <td class="col-md-9" colspan="2">
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
                    <td class="col-md-3">Những kiến thức, kỹ năng đã có
                        <td class="col-md-9" colspan="2">Kỹ năng lập trình:
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
                                @for($i=0;$i<count($skill_list)-1;$i++)
                                <tr class="skill-point">
                                    <td style="border: 1px solid black">
                                        <div class="col-sm-12 required {{ $form->field("language_id")->has_error }}">
                                            {!! $form->field("language_id") !!}
                                        </div>
                                    </td>
                                    <td style="border: 1px solid black">
                                        <input type="radio" id='regular' name="optradio{{$i+2}}" value="1">
                                    </td>
                                    <td style="border: 1px solid black">
                                        <input type="radio" id='regular' name="optradio{{$i+2}}" value="2">
                                    </td>
                                    <td style="border: 1px solid black">
                                        <input type="radio" id='regular' name="optradio{{$i+2}}" value="3">
                                    </td>
                                </tr>
                                @endfor
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
                    <td class="col-md-3">Những kiến thức, kỹ năng muốn học hỏi
                    </td>
                    <td class="col-md-9" colspan="2">
                        <div class="form-group textarea-height">
                            <div class='col-sm-12 required {{ $form->field("desire_skill")->has_error }} textarea-width'>
                                {!! $form->field("desire_skill") !!}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3">Đã có công ty thực tập
                    </td>
                    <td class="col-md-9" colspan="2">
                        <div>
                            @if(!empty($avail_company->name))
                            <input type="checkbox" id="have_company" checked="true" value="1">
                            @else
                            <input type="checkbox" id="have_company" value="1">
                            @endif
                        </div>
                        <div id="div_company" class="hidden" style="margin-top:10px">
                            <div class="form-group">
                                <div class="col-sm-3" style="text-align: right;">
                                    <label>
                                        Tên đầy đủ của cơ quan, công ty:
                                    </label>
                                </div>
                                <div class="col-sm-8 required {{ $form->field('cpn_name')->has_error }}">
                                    {!! $form->field('cpn_name') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3" style="text-align: right;">
                                    <label style="margin-top:5px; margin-bottom: 0px">
                                        Địa chỉ:
                                    </label>
                                </div>
                                <div class="col-sm-8 required {{ $form->field('cpn_address')->has_error }}">
                                    {!! $form->field('cpn_address') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3" style="text-align: right;">
                                    <label style="margin-top:5px; margin-bottom: 0px">
                                        Người phụ trách:
                                    </label>
                                </div>
                                <div class="col-sm-8 required {{ $form->field('cpn_instructor')->has_error }}">
                                    {!! $form->field('cpn_instructor') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3" style="text-align: right;">
                                    <label style="margin-top:5px; margin-bottom: 0px">
                                        Điện thoại:
                                    </label>
                                </div>
                                <div class="col-sm-8 required {{ $form->field('cpn_phone')->has_error }}">
                                    {!! $form->field('cpn_phone') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3" style="text-align: right;">
                                    <label style="margin-top:5px; margin-bottom: 0px">
                                        Email:
                                    </label>
                                </div>
                                <div class="col-sm-8 required {{ $form->field('cpn_email')->has_error }}">
                                    {!! $form->field('cpn_email') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3" style="text-align: right;">
                                    <label style="margin-top:5px; margin-bottom: 0px">
                                        Thời gian thực tập
                                    </label>
                                </div>
                                <div class="col-sm-4 required {{ $form->field('cpn_start_date')->has_error }}">
                                    {!! $form->field('cpn_start_date') !!}
                                </div>
                                <div class="col-sm-4 required {{ $form->field('cpn_end_date')->has_error }}">
                                    {!! $form->field('cpn_end_date') !!}
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-12" colspan="3">Nếu sinh viên chưa thực tập ở công ty nào thì mục trên ghi "Không có".<br>
                        Viện Đào tạo Quốc tế sẽ căn cứ trên kỹ năng của sinh viên và yêu cầu của doanh nghiệp để phân công.
                        Sinh viên phải cam kết tuân thủ theo phân công của Viện.
                    </td>
                </tr>
            </table>
            <div class="">
                <div class="col-md-2 col-md-offset-10" style="margin-top: 15px">
                    {!! $form->footer !!}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="/js/jquery.numeric.js"></script>
<script>
    var count_skill = $('.skill-point').size();
    var student_programming_language = {!! $skill_list !!};

    for(var i = 0; i < student_programming_language.length; i++){
        $.each(student_programming_language[i], function(key, value){
            if(key=="language_id")
                $('.skill-select:eq('+i+')').val(value);
            if(key=="level")
                $('input[name="optradio'+(i+1)+ '"][value="'+ value +'"]').prop("checked", true);
        });
    }

    $('#add-button').click(function(){
        count_skill++;
        var html = '<tr class="skill-point"><td style="border: 1px solid black"> <div class="col-sm-12 required {{ $form->field("language_id")->has_error }}">{!! $form->field("language_id") !!}</div> </td> <td style="border: 1px solid black"><input type="radio" id="regular" name="optradio'+ count_skill + '" value="1"></td><td style="border: 1px solid black"><input type="radio" id="regular" name="optradio'+ count_skill +'" value="2"></td><td style="border: 1px solid black"><input type="radio" id="regular" name="optradio'+ count_skill +'" value="3"></td></tr>';

        if(count_skill == 5){
            $('#add-button').addClass('hidden');
        }
        $('.add-line tr:last').before(html);
    });

    $("#phone").numeric();

    $(document).ready(function(){
        if($('#have_company').val() == 1)
            $('#div_company').removeClass('hidden');
    });

    $('#have_company').click(function(){
        $('#div_company').toggleClass('hidden');
    });

</script>
@endsection
