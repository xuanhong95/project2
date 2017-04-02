@extends('layouts.app')
@extends('layouts.left-sidebar')
<style>
    h3{
        margin-top: 0px!important;
    }
    p{
        margin: 0px 0px 0px 0px!important;
    }
    td, th{
        border: 1px solid black;
        padding-left: 0px!important;
        padding-right: 0px!important;
    }
    th{
        text-align: center!important;
    }
    .name_field{
        padding-left: 7px!important;
    }
    textarea{
        height:70px!important;
    }
    .form-control{
        border-radius: 0px!important;
    }
    #enterprise_instructor{
        position: absolute;
        height: 100%;
    }
    #add-button:hover{
        cursor: pointer;
    }
</style>
@section('content-with-sidebar')
<div class="container" style="margin-top:70px">
    <div class="form-group">
        {!! $form->header !!}
        @if(!$form->message)
        <div class="row">
            <div class="col-md-10 col-md-offset-1 well">
                <div style="text-align: center">
                    <h3>PHIẾU ĐĂNG KÝ THAM GIA</h3>
                    <h3>CHƯƠNG TRÌNH THỰC TẬP DOANH NGHIỆP</h3>
                </div>

                <div class="description-block col-md-offset-1">
                    <h4><em> Thời gian thực tập </em></h4>
                    <ul>
                        <li class="col-md-offset-1">Thời gian: 15 tuần (Kế hoạch cụ thể do Cơ sở thực tập xây dựng</li>
                        <li class="col-md-offset-1">Thời lượng: 160 giờ full-time hoặc tương đương </li>
                    </ul>
                    <p>Quý vị vui lòng điền đầy đủ thông tin theo mẫu dưới đây:</p>
                    <p><em>(Chúng tôi cam kết những thông tin dưới đây chỉ được sử dụng bởi Viện Đào tạo Quốc tế, trường Đại học Bách khoa Hà Nội)</em></p>
                </div>

                <div class="col-md-10 col-md-offset-1" style="margin-top: 15px">
                    <h3><strong>Season: {!! $season !!}</strong></h3>
                </div>
                <div class="col-md-10 col-md-offset-1" style="margin-top: 15px">
                    <strong>1. Thông tin chung </strong>
                    <table class="col-md-12"  style="border:1px solid black;">
                        <tr>
                            <td class="col-md-3 name_field"> Tên công ty
                            </td>
                            <td class="col-md-3 name_field" colspan="3">{!! $form->field('name') !!}
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-3 name_field"> Địa chỉ
                            </td>
                            <td class="col-md-3 name_field" colspan="3">{!! $form->field('address') !!}
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-3 name_field" rowspan="2">Họ tên cán bộ phụ trách thực tập</td>
                            <td class="col-md-3" rowspan="2"
                            style="vertical-align: top;
                            position: relative;">
                            {!! $form->field('enterprise_instructor') !!}
                        </td>
                        <td class="col-md-3 name_field">Điện thoại</td>
                        <td class="col-md-3">{!! $form->field('phone') !!}</td>
                    </tr>
                    <tr>
                        <td class="col-md-3 name_field">Email</td>
                        <td class="col-md-3 name_field">{!! $form->field('email') !!}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-10 col-md-offset-1" style="margin-top: 15px">
                <strong style="display: inline-flex;"><p>2. Số lượng sinh viên có thể tiếp nhận: &nbsp</p>{!! $form->field('quantity') !!}<p>&nbspsinh viên</p></strong>
            </div>

            <div class="col-md-10 col-md-offset-1" style="margin-top: 15px">
                <strong>3. Nội dung và công việc yêu cầu: </strong>
                <table class="col-md-12 add-line">
                    <tr>
                        <th class="col-md-3">Vị trí</th>
                        <th class="col-md-5">Nội dung</th>
                        <th class="col-md-4">Yêu cầu</th>
                    </tr>

                    <tr id="template" class="hide">
                        <td class="col-md-3" >{!! $form->field('position') !!}</td>
                        <td class="col-md-5" >{!! $form->field('content') !!}</td>
                        <td class="col-md-4" >{!! $form->field('require') !!}</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right; border: 0px; padding-top:10px">
                            <div class="pull-right btn-group">
                                <button type="button" id="reset-button" class="btn btn-default">Reset <i class="glyphicon glyphicon-repeat"></i></button>
                                <button type="button" id="add-button" class="btn btn-success">Add <i class="glyphicon glyphicon-plus"></i></button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
    @else
    <div class="form-group">
        <div class="col-md-12 alert alert-success">
            {!! $form->message !!}
        </div>
    </div>

    @endif
    <div class="form-group ">
        <div class="col-sm-2 col-sm-offset-10">
            {!! $form->footer !!}
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/jquery.numeric.js"></script>
<script>

    //construct
    var recruitment_contents = {!! $recruitment_content !!};
    // alert(recruitment_contents[0]['position']);
    if(recruitment_contents !== null){
        $.each(recruitment_contents, function(key,value){
            console.log(key);
            $('.add-line tr:last').before("<tr>"+$('#template').html()+"</tr>");

            $('.add-line tr:eq('+key+2+') td:eq(0) textarea').val(value['position']);
            $('.add-line tr:eq('+key+2+') td:eq(1) textarea').val(value['content']);
            $('.add-line tr:eq('+key+2+') td:eq(2) textarea').val(value['require']);
        });
    }
    else{
        $('#add-button').click();
    }

    // Button add
    var count_skill = 1;
    $('#add-button').click(function(){
        count_skill++;

        if(count_skill == 5){
            $('#add-button').addClass('hidden');
        }
        $('.add-line tr:last').before("<tr>"+$('#template').html()+"</tr>");
    });

    //Button reset
    $('#reset-button').on('click',function(){
        console.log('Work!');
        var tr_in_addline = $('.addline').find('tr');
        var count_tr_in_addline =  tr_in_addline.size();
        for(var i = 1; i < count_tr_in_addline-1; i++){
            tr_in_addline[i].remove();
        }
        $('.addline tr:eq(1) td').val('');
    });

    $("#phone").numeric();
    $("#quantity").numeric();
</script>
@endsection
