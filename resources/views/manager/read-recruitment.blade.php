@extends('layouts.app')
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
@section('content')
<div class="container" style="margin-top:70px;">
    <div class="col-md-10 col-md-offset-1 well">


        <div class="form-group">
            {!! $form->header !!}
            <div class="form-group">
                <div class="col-md-12">
                    {!! $form->message !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1 well">
                    <div style="text-align: center">
                        <h3>PHIẾU ĐĂNG KÝ THAM GIA</h3>
                        <h3>CHƯƠNG TRÌNH THỰC TẬP DOANH NGHIỆP</h3>
                    </div>
                    <div class="description-block">
                        <h4><em> Thời gian thực tập </em></h4>
                        <ul>
                            <li class="col-md-offset-1">Thời gian: 15 tuần (Kế hoạch cụ thể do Cơ sở thực tập xây dựng</li>
                            <li class="col-md-offset-1">Thời lượng: 160 giờ full-time hoặc tương đương </li>
                        </ul>
                        <p>Quý vị vui lòng điền đầy đủ thông tin theo mẫu dưới đây:</p>
                        <p><em>(Chúng tôi cam kết những thông tin dưới đây chỉ được sử dụng bởi Viện Đào tạo Quốc tế, trường Đại học Bách khoa Hà Nội)</em></p>
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
                                position: relative; text-indent:15px">
                                {!! $form->field('enterprise') !!}
                            </td>
                            <td class="col-md-3 name_field">Điện thoại</td>
                            <td class="col-md-3" style="text-indent:15px">{!! $form->field('phone') !!}</td>
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
                        @foreach( $recruitment_contents as $recruitment_content)
                        <tr style="text-indent:15px;">
                            <td class="col-md-3" >{!! $recruitment_content->position !!}</td>
                            <td class="col-md-5" >{!! $recruitment_content->job_description !!}</td>
                            <td class="col-md-4" >{!! $recruitment_content->requirement !!}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <div class="col-md-10 col-md-offset-1" style="margin-top: 15px">
                    <strong>4. Register Season: </strong>
                    <div class="form-group" style="margin-top:15px">
                        <label for="season" class="col-md-1">Season:</label>
                        <div class="col-md-3">
                            {!! $form->field('season') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group ">
            <div class="col-sm-2 col-sm-offset-10">
                {!! $form->footer !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-3 col-md-offset-1">
                <a href="{!! route('manager-recruitments') !!}"
                role="button" class="btn btn-default btn-lg">
                    Back
                </a>
            </div>
            <div class="col-md-3 col-md-offset-1">
                <a href="{!! route('accept-recruitment',['id' => $recruitment_contents[0]->recruitment_id]) !!}"
                    role="button" class="btn btn-success btn-lg">
                    Accept
                </a>
            </div>
            <div class="col-md-3 col-md-offset-1">
                <a href="{!! route('deny-recruitment',['id' => $recruitment_contents[0]->recruitment_id]) !!}"
                    role="button" class="btn btn-warning btn-lg">
                    Deny
                </a>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/jquery.numeric.js"></script>
<script>
$("#phone").numeric();
$("#quantity").numeric();
</script>
@endsection
