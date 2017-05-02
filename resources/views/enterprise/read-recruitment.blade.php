@extends('layouts.app')

<style media="screen">
    textarea{
        resize: none;
    }
</style>
@section('content')
@include('layouts.left-sidebar')
<div class="col-md-10" style="background:#f8f8f8;min-height:100%;">
    <div class="form-group">
        {!! $form->header !!}
        <div class="form-group">
            <div class="col-md-12">
                {!! $form->message !!}
            </div>
        </div>
        <div class="row">
            <!-- Edit button -->
            <div class="col-md-12" style="margin-bottom:20px">
                <!-- Start modal -->
                <div class="col-md-12">
                    <button id="edit-modal" type="button" class="btn btn-default pull-right" data-toggle="modal"
                            data-target="#modal">Edit
                    </button>
                </div>

                <div id="modal" class="modal fade" role="dialog" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="col-md-12">
                                    <h4 class="modal-title"><strong>Are you sure to edit?</strong></h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <h4><strong> This recruitment may be approved again.</strong></h4>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-2 col-md-offset-3">
                                    <a id="edit-button" href="{{ route('create-recruitment')}}" type="button" class="btn btn-default">Yes</a>
                                </div>
                                <div class="col-md-2 col-md-offset-2">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end modal -->
            <!-- end edit-button -->

            <!-- start form -->
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
                    <table class="col-md-12 table table-striped table-bordered"  >
                        <tr>
                            <th class="col-md-3 name_field"> Tên công ty
                            </th>
                            <th class="col-md-3 name_field" colspan="3">{!! $form->field('name') !!}
                            </th>
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
                    <strong id="quantity" style="display: inline-flex;">
                        <p>2. Số lượng sinh viên có thể tiếp nhận:
                            &nbsp</p>{!! $form->field('quantity') !!}
                            <p>&nbspsinh viên</p>
                        </strong>
                </div>

                <div class="col-md-10 col-md-offset-1" style="margin-top: 15px">
                    <strong>3. Nội dung và công việc yêu cầu: </strong>
                    <table class="col-md-12 add-line table table-striped table-bordered text-center">
                        <tr>
                            <th class="col-md-3">Vị trí</th>
                            <th class="col-md-5">Nội dung</th>
                            <th class="col-md-4">Yêu cầu</th>
                        </tr>
                        @foreach( $recruitment_contents as $recruitment_content)
                        <tr style="text-indent:15px;">
                            <td class="col-md-3"><textarea row="5" col="10" class="position" readonly>{!! $recruitment_content->position !!}</textarea></td>
                            <td class="col-md-5"><textarea type="text" class="job_description" readonly>{!! $recruitment_content->job_description !!}</textarea></td>
                            <td class="col-md-4"><textarea type="text" class="requirement" readonly>{!! $recruitment_content->requirement !!}</textarea></td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <div class="col-md-10 col-md-offset-1" style="margin-top: 15px">
                    <strong>4. Register Season: </strong>
                    <div class="form-group" style="margin-top:15px">
                        <label for="season" class="col-md-1">Season:</label>
                        <div class="col-md-1">
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


    </div>
    <div class="col-md-12" style="margin-bottom:30px">
        <div class="col-md-3 col-md-offset-1">
            <a href="{!! route('manager-recruitments') !!}"
                    role="button" class="btn btn-default btn-lg">
                Back
            </a>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/jquery.numeric.js"></script>
<script>
$("#phone").numeric();
$("#quantity").numeric();

$('#edit-button').on('click',function(){
    $('#quantity, .position, .job_description, .requirement').attr("readonly",false);
    $('#edit-modal').hide();
});
</script>
@endsection
