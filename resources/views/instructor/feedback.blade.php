@extends('layouts.app');
@section('content')
<style media="screen">
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-indent:10px;
}
textarea{
    max-height: 50px;
}
</style>
    <div class="container" style="margin-top:70px">
        <div class="col-md-10 col-md-offset-1 well">
            <legend>Feedback:</legend>
            <div class="col-md-10 col-md-offset-1 row">
                {!! $form->header !!}
            </div>
            <div class="col-md-10">
                <h4 class="text-success">{!! $form->message !!}</h4>
            </div>
            <div class="col-md-10 col-md-offset-1 row">
                <label for="student_name" class="col-md-2">Sinh viên:</label>
                <div class="col-md-6">
                    <strong>{!! $form->field('student_name') !!}</strong>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="row col-md-10 col-md-offset-1">
                <h4>A- Nhận xét về sinh viên thực tập</h4>
                <div class="row">
                    <legend><h5>1.Trình độ kỹ thuật</h5></legend>
                    <table class="col-md-12" >
                        <tr class="text-center">
                            <td class="col-md-3">Tiêu chí</td>
                            <td class="col-md-5">Điểm</td>
                            <td>Nhận xét</td>
                        </tr>
                        <tr>
                            <td>Trình độ kỹ thuật liên quan đến đề tài thực tập</td>
                            <td>{!! $form->field('point_tech0') !!}</td>
                            <td>{!! $form->field('comment_tech') !!}</td>

                        </tr>
                        <tr>
                            <td>Khả năng nắm bắt các kỹ thuật mới</td>
                            <td>{!! $form->field('point_tech1') !!}</td>
                            <td>{!! $form->field('comment_tech') !!}</td>

                        </tr>
                        <tr>
                            <td>Mức độ làm chủ kỹ thuật, công nghệ sau khi đã được hướng dẫn</td>
                            <td>{!! $form->field('point_tech2') !!}</td>
                            <td>{!! $form->field('comment_tech') !!}</td>

                        </tr>
                        <tr>
                            <td>Khả năng phân tích</td>
                            <td>{!! $form->field('point_tech3') !!}</td>
                            <td>{!! $form->field('comment_tech') !!}</td>

                        </tr>
                        <tr>
                            <td>Phương pháp luận – cách thức tổ chức công việc</td>
                            <td>{!! $form->field('point_tech4') !!}</td>
                            <td>{!! $form->field('comment_tech') !!}</td>

                        </tr>
                        <tr>
                            <td>Óc sáng tạo</td>
                            <td>{!! $form->field('point_tech5') !!}</td>
                            <td>{!! $form->field('comment_tech') !!}</td>

                        </tr>
                        <tr>
                            <td>Trình độ ngoại ngữ phục vụ cho công việc</td>
                            <td>{!! $form->field('point_tech6') !!}</td>
                            <td>{!! $form->field('comment_tech') !!}</td>
                        </tr>
                    </table>
                </div>
                <br>
                <br>
                <div class="row">
                    <legend><h5>2.Công việc đã thực hiện</h5></legend>
                    <table class="col-md-12" >
                        <tr class="text-center">
                            <td>Tiêu chí</td>
                            <td>Điểm</td>
                            <td>Nhận xét</td>
                        </tr>
                        <tr>
                            <td>Khối lượng công việc đã thực hiện trong thời gian thực tập</td>
                            <td>{!! $form->field('point_task0') !!}</td>
                            <td>{!! $form->field('comment_task') !!}</td>

                        </tr>
                        <tr>
                            <td>Chất lượng công việc đã thực hiện trong thời gian thực tập</td>
                            <td>{!! $form->field('point_task1') !!}</td>
                            <td>{!! $form->field('comment_task') !!}</td>

                        </tr>
                        <tr>
                            <td>Khả năng tự hoàn thành công việc và cách giải quyết các vấn đề phát sinh</td>
                            <td>{!! $form->field('point_task2') !!}</td>
                            <td>{!! $form->field('comment_task') !!}</td>

                        </tr>
                        <tr>
                            <td>Viết tài liệu về công việc đã thực hiện</td>
                            <td>{!! $form->field('point_task3') !!}</td>
                            <td>{!! $form->field('comment_task') !!}</td>

                        </tr>
                        <tr>
                            <td>Thuyết trình</td>
                            <td>{!! $form->field('point_task4') !!}</td>
                            <td>{!! $form->field('comment_task') !!}</td>

                        </tr>
                        <tr>
                            <td>Tuân thủ các ràng buộc chất lượng công việc của cơ sở thực tập</td>
                            <td>{!! $form->field('point_task5') !!}</td>
                            <td>{!! $form->field('comment_task') !!}</td>

                        </tr>

                    </table>
                </div>
                <br>
                <br>
                <div class="row">
                    <legend><h5>3.Thái độ, ý thức</h5></legend>
                    <table class="col-md-12" >
                        <tr class="text-center">
                            <td>Tiêu chí</td>
                            <td>Điểm</td>
                            <td>Nhận xét</td>
                        </tr>
                        <tr>
                            <td>Đúng giờ</td>
                            <td>{!! $form->field('point_attitude0') !!}</td>
                            <td>{!! $form->field('comment_attitude') !!}</td>

                        </tr>
                        <tr>
                            <td>Vẻ ngoài (quần áo, tác phong nơi công sở, …)</td>
                            <td>{!! $form->field('point_attitude1') !!}</td>
                            <td>{!! $form->field('comment_attitude') !!}</td>

                        </tr>
                        <tr>
                            <td>Giữ gìn hình ảnh cho cơ sở thực tập và cho sản phẩm đã thực hiện trong quá trình làm việc</td>
                            <td>{!! $form->field('point_attitude2') !!}</td>
                            <td>{!! $form->field('comment_attitude') !!}</td>

                        </tr>
                        <tr>
                            <td>Làm việc nhóm</td>
                            <td>{!! $form->field('point_attitude3') !!}</td>
                            <td>{!! $form->field('comment_attitude') !!}</td>

                        </tr>
                        <tr>
                            <td>Quan hệ, giao tiếp với nhân viên, khách hàng của cơ sở thực tập</td>
                            <td>{!! $form->field('point_attitude4') !!}</td>
                            <td>{!! $form->field('comment_attitude') !!}</td>

                        </tr>
                        <tr>
                            <td>Tuân thủ các quy định làm việc của công ty và cam kết khi thực tập</td>
                            <td>{!! $form->field('point_attitude5') !!}</td>
                            <td>{!! $form->field('comment_attitude') !!}</td>
                        </tr>
                    </table>
                </div>
                <br>
                <br>
                <div class="row">
                    <legend><h5>4.Tiến bộ trong quá trình thực tập</h5></legend>
                    <table class="col-md-12" >
                        <tr class="text-center">
                            <td>Tiêu chí</td>
                            <td>Điểm</td>
                            <td>Nhận xét</td>
                        </tr>
                        <tr>
                            <td>Cải thiện năng lực, trình độ kỹ thuật</td>
                            <td>{!! $form->field('point_improvement0') !!}</td>
                            <td>{!! $form->field('comment_improvement') !!}</td>

                        </tr>
                        <tr>
                            <td>Cải thiện thái độ, ý thức</td>
                            <td>{!! $form->field('point_improvement1') !!}</td>
                            <td>{!! $form->field('comment_improvement') !!}</td>

                        </tr>
                        <tr>
                            <td>Cải thiện về phương pháp làm việc</td>
                            <td>{!! $form->field('point_improvement2') !!}</td>
                            <td>{!! $form->field('comment_improvement') !!}</td>
                        </tr>
                    </table>
                </div>
                <br>
                <br>
                <div class="row">
                    <legend><h5>5.Đánh giá chung về khóa thực tập</h5></legend>
                    <table>
                        <tr>
                            <td class="col-md-10">Kết quả chung :<br>
                                A : sinh viên chủ động hoàn thành các công việc, kết quả xuất sắc <br>
                                B : sinh viên đáp ứng đầy đủ các yêu cầu công việc, kết quả tốt <br>
                                C : sinh viên có khả năng trung bình, kết quả đạt yêu cầu <br>
                                D : sinh viên chưa đạt hết các mục tiêu đặt ra, nhưng có cố gắng, nỗ lực, <br>
                                F : ý thức học tập của sinh viên kém, không đạt yêu cầu <br>
                            </td>
                            <td>{!! $form->field('general_appreciation_id') !!}</td>
                        </tr>
                        <tr>
                            <td>Quý vị có muốn tiếp tục nhận sinh viên thực tập đợt sau không ?</td>
                            <td>Có: {!! $form->field('is_continue_receive') !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="col-md-10 col-md-offset-1">
                <h4>B- Đóng góp cho chương trình đào tạo (những ý kiến trong mục
                    này của quý vị sẽ giúp chúng tôi cải tiến chương trình đào tạo,
                    và sẽ không sử dụng để đánh giá kết quả thực tập của sinh viên)
                </h4>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="missing_knownledge" class="col-md-16">1.Trong 2 tuần đầu của kỳ thực tập, sinh viên
                            chưa nắm vững các nhóm kiến thức nào?</label>
                        <div class="col-md-11 col-md-offset-1">
                            {!! $form->field('missing_knownledge') !!}
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="necessary_knownledge">2.Theo quý vị, nhà trường cần chú trọng đào tạo thêm nhóm
                            kiến thức nào cho sinh viên ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            {!! $form->field('necessary_knownledge') !!}
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="is_language_necessary">3.Ngoại ngữ phải là yêu cầu thiết yếu trong công
                            việc tại cơ sở thực tập hay không ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            Có:  {!! $form->field('is_language_necessary') !!}
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="is_language_met">4.Nếu có, trình độ tiếng Anh / Pháp của sinh viên c
                            ó đáp ứng yêu cầu không ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            Có:  {!! $form->field('is_language_met') !!}
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="shortcoming">5.Vui lòng chỉ ra một số thiếu sót của sinh viên trong quá trình thực tập ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            {!! $form->field('shortcoming') !!}
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="advantage">6.Vui lòng chỉ ra các ưu điểm của sinh viên trong quá trình thực tập ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            {!! $form->field('advantage') !!}
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="procedure_improvement">7.Theo quý vị, có cần cải tiến quy trình thực tập không ?
                            Cải tiến như thế nào ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            {!! $form->field('procedure_improvement') !!}
                        </div>
                    </div>
                </div>
                {!! $form->footer !!}
            </div>

        </div>
    </div>
@endsection
