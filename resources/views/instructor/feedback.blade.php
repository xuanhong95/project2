@extends('layouts.app')

@section('content')
<style media="screen">
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
td{
    padding: 5px;
}
.no-padding{
    padding: 0px;
}
tr{
    max-height: 50px;
}
textarea{
    max-height: 50px;
    resize : none;
    padding: 0;
    text-align: left;
}
</style>
@include('layouts.left-sidebar')
    <div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
        <div class="col-md-10 col-md-offset-1 well">
            <div class="page-header col-md-offset-1">
                <h2>Feedback</h2>
            </div>
            <div class="col-md-10 col-md-offset-1 row">
            <form class="" action="{{ route('instructor-feedback',['student_id'=>$student->user_id])}}" method="post">
                {{ csrf_field() }}
            </div>
            @if(Session::has("message"))
            <div class="col-md-3 pull-right">
                <h4 class="text-success">{!! Session::get('message') !!}</h4>
            </div>
            @endif
            <div class="col-md-10 col-md-offset-1 row">
                <label for="student_name" class="col-md-2">Sinh viên:</label>
                <div class="col-md-6" style="top: -5px">
                    <strong>{{ $student->name }}</strong>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="row col-md-10 col-md-offset-1">
                <h4>A- Nhận xét về sinh viên thực tập</h4>
                <div class="row">
                    <legend><h5>1.Trình độ kỹ thuật</h5></legend>
                    <table class="col-md-12 table table-striped table-bordered">
                        <tr class="text-center">
                            <th class="col-md-6">Tiêu chí</td>
                            <th class="col-md-2">Điểm</td>
                            <th>Nhận xét</td>
                        </tr>
                        @foreach( $technicalLevelRecords as $record )
                        <tr>
                            <td>{{ $record->criteria }}</td>
                            <td>
                                <select class="form-control" name="technicalLevel-{{ $record->criteria_id }}">
                                    <option value="A" <?php echo $record->point == 'A'?'selected':''  ?>>Excellent</option>
                                    <option value="B" <?php echo $record->point == 'B'?'selected':''  ?>>Good</option>
                                    <option value="C" <?php echo $record->point == 'C'?'selected':''  ?>>Medium</option>
                                    <option value="D" <?php echo $record->point == 'D'?'selected':''  ?>>Nomal</option>
                                    <option value="F" <?php echo $record->point == 'F'?'selected':''  ?>>Bad</option>
                                    <option value="X" <?php echo $record->point == 'X'?'selected':''  ?>>No idea</option>
                                </select>
                            </td>
                            <td class="no-padding">
                                <textarea type="text" class="form-control"
                                    name="technicalLevelComment-{{ $record->criteria_id }}" cols="50" rows="10" placeholder="comment..."
                                    >{{ $record->comment}}</textarea>
                            </td>

                        </tr>
                        @endforeach

                    </table>
                </div>
                <br>
                <br>
                <div class="row">
                    <legend><h5>2.Công việc đã thực hiện</h5></legend>
                    <table class="col-md-12 table table-striped table-bordered" >
                        <tr class="text-center">
                            <th class="col-md-6">Tiêu chí</td>
                            <th class="col-md-2">Điểm</td>
                            <th>Nhận xét</td>
                        </tr>
                        @foreach( $taskRecords as $record )
                        <tr>
                            <td>{{ $record->criteria }}</td>
                            <td>
                                <select class="form-control" name="task-{{ $record->criteria_id }}" value="{{ $record->point }}">
                                    <option value="A" <?php echo $record->point == 'A'?'selected':''  ?>>Excellent</option>
                                    <option value="B" <?php echo $record->point == 'B'?'selected':''  ?>>Good</option>
                                    <option value="C" <?php echo $record->point == 'C'?'selected':''  ?>>Medium</option>
                                    <option value="D" <?php echo $record->point == 'D'?'selected':''  ?>>Nomal</option>
                                    <option value="F" <?php echo $record->point == 'F'?'selected':''  ?>>Bad</option>
                                    <option value="X" <?php echo $record->point == 'X'?'selected':''  ?>>No idea</option>
                                </select>
                            </td>
                            <td class="no-padding">
                                <textarea type="text" class="form-control"
                                    name="taskComment-{{ $record->criteria_id }}" cols="50" rows="10" placeholder="comment..."
                                >{{ $record->comment}}</textarea>
                            </td>

                        </tr>
                        @endforeach

                    </table>
                </div>
                <br>
                <br>
                <div class="row">
                    <legend><h5>3.Thái độ, ý thức</h5></legend>
                    <table class="col-md-12 table table-striped table-bordered" >
                        <tr class="text-center">
                            <th class="col-md-6">Tiêu chí</td>
                            <th class="col-md-2">Điểm</td>
                            <th>Nhận xét</td>
                        </tr>
                        @foreach( $attitudeRecords as $record )
                        <tr>
                            <td>{{ $record->criteria }}</td>
                            <td>
                                <select class="form-control" name="attitude-{{ $record->criteria_id }}" value="{{ $record->point }}">

                                    <option value="A" <?php echo $record->point == 'A'?'selected':''  ?>>Excellent</option>
                                    <option value="B" <?php echo $record->point == 'B'?'selected':''  ?>>Good</option>
                                    <option value="C" <?php echo $record->point == 'C'?'selected':''  ?>>Medium</option>
                                    <option value="D" <?php echo $record->point == 'D'?'selected':''  ?>>Nomal</option>
                                    <option value="F" <?php echo $record->point == 'F'?'selected':''  ?>>Bad</option>
                                    <option value="X" <?php echo $record->point == 'X'?'selected':''  ?>>No idea</option>
                                </select>
                            </td>
                            <td class="no-padding">
                                <textarea type="text" class="form-control"
                                    name="attitudeComment-{{ $record->criteria_id }}" cols="50" rows="10" placeholder="comment..."
                                >{{ $record->comment}}</textarea>
                            </td>

                        </tr>
                        @endforeach
                    </table>
                </div>
                <br>
                <br>
                <div class="row">
                    <legend><h5>4.Tiến bộ trong quá trình thực tập</h5></legend>
                    <table class="col-md-12 table table-striped table-bordered" >
                        <tr class="text-center">
                            <th class="col-md-6">Tiêu chí</td>
                            <th class="col-md-2">Điểm</td>
                            <th>Nhận xét</td>
                        </tr>
                        @foreach( $improvementRecords as $record )
                        <tr>
                            <td>{{ $record->criteria }}</td>
                            <td>
                                <select class="form-control" name="improvement-{{ $record->criteria_id }}" value="{{ $record->point }}">

                                    <option value="A" <?php echo $record->point == 'A'?'selected':''  ?>>Excellent</option>
                                    <option value="B" <?php echo $record->point == 'B'?'selected':''  ?>>Good</option>
                                    <option value="C" <?php echo $record->point == 'C'?'selected':''  ?>>Medium</option>
                                    <option value="D" <?php echo $record->point == 'D'?'selected':''  ?>>Nomal</option>
                                    <option value="F" <?php echo $record->point == 'F'?'selected':''  ?>>Bad</option>
                                    <option value="X" <?php echo $record->point == 'X'?'selected':''  ?>>No idea</option>
                                </select>
                            </td>
                            <td class="no-padding">
                                <textarea type="text" class="form-control"
                                    name="improvementComment-{{ $record->criteria_id }}" cols="50" rows="10" placeholder="comment..."
                                        >{{ $record->comment}}</textarea>
                            </td>

                        </tr>
                        @endforeach

                    </table>
                </div>
                <br>
                <br>
                <div class="row">
                    <legend><h5>5.Đánh giá chung về khóa thực tập</h5></legend>
                    <table>
                        <tr>
                            <td class="col-md-10 col-xs-8">Kết quả chung :<br>
                                A : sinh viên chủ động hoàn thành các công việc, kết quả xuất sắc <br>
                                B : sinh viên đáp ứng đầy đủ các yêu cầu công việc, kết quả tốt <br>
                                C : sinh viên có khả năng trung bình, kết quả đạt yêu cầu <br>
                                D : sinh viên chưa đạt hết các mục tiêu đặt ra, nhưng có cố gắng, nỗ lực, <br>
                                F : ý thức học tập của sinh viên kém, không đạt yêu cầu <br>
                            </td>
                            <td>
                                <select class="form-control" name="generalAppreciation">
                                    <option value="A" <?php echo $appreciation->general_appreciation_id == 'A'?'selected':''  ?>>A</option>
                                    <option value="B" <?php echo $appreciation->general_appreciation_id == 'B'?'selected':''  ?>>B</option>
                                    <option value="C" <?php echo $appreciation->general_appreciation_id == 'C'?'selected':''  ?>>C</option>
                                    <option value="D" <?php echo $appreciation->general_appreciation_id == 'D'?'selected':''  ?>>D</option>
                                    <option value="D" <?php echo $appreciation->general_appreciation_id == 'F'?'selected':''  ?>>FS</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Quý vị có muốn tiếp tục nhận sinh viên thực tập đợt sau không ?</td>
                            <td class="text-center">
                                <select class="form-control" name="continueReceive">
                                    <option value="1" <?php echo $appreciation->is_continue_receive == "1"?'selected':'' ?>>Yes</option>
                                    <option value="0" <?php echo $appreciation->is_continue_receive == "0"?'selected':'' ?>>No</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>


            <div class="col-md-10 col-md-offset-1" style="margin-top:30px">
                <h4>B- Đóng góp cho chương trình đào tạo (những ý kiến trong mục
                    này của quý vị sẽ giúp chúng tôi cải tiến chương trình đào tạo,
                    và sẽ không sử dụng để đánh giá kết quả thực tập của sinh viên)
                </h4>
                <div class="row">
                    <br>
                    <div class="col-md-12 form-group">
                        <label for="missing_knownledge" class="col-md-16">1.Trong 2 tuần đầu của kỳ thực tập, sinh viên
                            chưa nắm vững các nhóm kiến thức nào?</label>
                        <div class="col-md-11 col-md-offset-1">
                            <?php $missingKnownledge = json_decode($appreciation->missing_knownledge) == null?[]:json_decode($appreciation->missing_knownledge);
                                ?>
                            <input type="checkbox" name="missingKnownledge[]" value="1"
                                <?php echo in_array("1",$missingKnownledge)?'checked':'' ?>>
                            Kiến thức cơ sở (giải thuật, toán, …)&nbsp;?&nbsp;&nbsp;
                            <input type="checkbox" name="missingKnownledge[]" value="2"
                                <?php echo in_array("2",$missingKnownledge)?'checked':'' ?>>
                            Ngôn ngữ lập trình ?&nbsp;&nbsp;
                            <input type="checkbox" name="missingKnownledge[]" value="3"
                                <?php echo in_array("3",$missingKnownledge)?'checked':'' ?>>
                            Phần mềm&nbsp;?&nbsp;&nbsp;
                            <input type="checkbox" name="missingKnownledge[]" value="4"
                                <?php echo in_array("4",$missingKnownledge)?'checked':'' ?>>
                            Phần cứng&nbsp;?&nbsp;&nbsp;
                            <input type="checkbox" name="missingKnownledge[]" value="5" id="otherKnownledge"
                                <?php echo in_array("5",$missingKnownledge)?'checked':'' ?>>
                            Khác&nbsp;&nbsp;&nbsp;

                        </div>
                    </div>
                    <div class="col-md-11 form-group col-md-offset-1
                    <?php echo in_array("5",$missingKnownledge)?'':"hide" ?>
                    " id="expand">
                        <label for="other_missing_knownledge">Các nhóm kiến thức khác là:</label>
                        <div class="col-md-11 col-md-offset-1">
                            <textarea name="otherMissingKnowledge" class="form-control" rows="8" cols="80" placeholder="Others..."

                            >{{ $appreciation->other_missing_knownledge}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 form-group">
                        <label for="necessary_knownledge">2.Theo quý vị, nhà trường cần chú trọng đào tạo thêm nhóm
                            kiến thức nào cho sinh viên ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            <textarea name="necessaryKnowledge"
                                class="form-control" rows="8" cols="80" placeholder="Necessary knowledges..."

                                >{{ $appreciation->necessary_knownledge}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="is_language_necessary">3.Ngoại ngữ phải là yêu cầu thiết yếu trong công
                            việc tại cơ sở thực tập hay không ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            <input type="checkbox" name="isLanguageNecessary" value="1"
                                <?php echo $appreciation->is_language_necessary == "1"?'checked':'' ?>> Có
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="is_language_met">4.Nếu có, trình độ tiếng Anh / Pháp của sinh viên c
                            ó đáp ứng yêu cầu không ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            <input type="checkbox" name="isLanguageMet" value="1"
                                <?php echo $appreciation->is_language_met == "1"?'checked':'' ?>> Có
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="shortcoming">5.Vui lòng chỉ ra một số thiếu sót của sinh viên trong quá trình thực tập ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            <textarea name="shortcoming" class="form-control" rows="8" cols="80" placeholder="Shortcomings.."
                                >{{ $appreciation->shortcoming}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="advantage">6.Vui lòng chỉ ra các ưu điểm của sinh viên trong quá trình thực tập ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            <textarea name="advantages" class="form-control" rows="8" cols="80" placeholder="Advantages..."
                                >{{ $appreciation->advantage}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="procedure_improvement">7.Theo quý vị, có cần cải tiến quy trình thực tập không ?
                            Cải tiến như thế nào ?</label>
                        <div class="col-md-11 col-md-offset-1">
                            <textarea name="procedureImprovement" class="form-control" rows="8" cols="80" placeholder="Improvements..."
                                >{{ $appreciation->procedure_improvement}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="col-md-2 col-md-offset-1">
                        <a href="{!! route('instructor-students') !!}"
                        class="btn btn-default" role="button"><i class="glyphicon glyphicon-chevron-left"></i>Back</a>
                    </div>

                    <div class="col-md-2 col-md-offset-5">

                        <button type="summit" class="btn btn-default"><i class="glyphicon glyphicon-save"></i>Submit</button>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
    $(function(){
         $("#otherKnownledge").on('click',function(){
                 $("#expand").toggleClass('hide');
                 $("#expand textarea").val("");

        });
    });

    </script>
@endsection
