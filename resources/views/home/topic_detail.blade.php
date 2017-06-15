@extends('layouts.app')

<style>
    img{
        float:left;
        width: 60px;
        height: 60px;
        margin-left: -19px;
        margin-top: -2px;
    }
    .btn-view-detail{
        padding:10px 15px;
        background: #5f5f5f;
        color: white;
        border-radius: 4px;
        float: right;
        margin-bottom: 10px;
        margin-right: 20px;
    }
    td, th{
        border: 1px solid black;
        padding-left: 0px!important;
        padding-right: 0px!important;
        text-align: center!important;
    }
    th{
        background: #00bcd4;
    }
    .value{
        color: red;
    }
    li{
        line-height: 30px;
    }
    .applied{
        cursor: not-allowed!important;
    }
</style>
@section('content')
<div class="container" style="background:#f8f8f8;margin-bottom:30px">
    <div class="col-md-10 col-md-offset-1 well">
        <div class="page-header col-md-offset-1">
            <h3>Thông tin tuyển dụng</h3>
        </div>
        <div class="company-info">
            <h4>I - Thông tin công ty</h4>
            <ul class="col-md-offset-1">
                <li><label>Tên công ty:</label> <span class="value"> {{\App\Company::getCompanyNameByID($company->id)}} </span></li>
                <li><label> Phone: </label> <span class="value"> {{$company->phone}}</span></li>
                <li><label> Address: </label> <span class="value"> {{$company->address}}</span></li>
                <li><label> Đại diện doanh nghiệp: </label> <span class="value"> {{$enterprise_account->name}}</span></li>
                <li><label> Email: </label> <span class="value"> {{$enterprise_account->email}}</span></li>
            </ul>
        </div>
        <div class="recruit-info">
            <h4>I - Thông tin tuyển dụng</h4>
            <div class="col-md-offset-1">
                <p>- <label> Số lượng tuyển dụng:</label> <span class="value"> {{$topic->quantity}} </span>sinh viên</p>
                <table class="col-md-11">
                    <tr>
                        <th> Vị trí </th>
                        <th> Nội dung </th>
                        <th> Yêu cầu </th>
                    </tr>
                    @foreach($recruitment_contents as $content)
                    <tr>
                        <td>{{$content->position}}</td>
                        <td>{{$content->job_description}}</td>
                        <td>{{$content->requirement}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        @if(\Auth::user()->user_type == 0 || \Auth::user()->user_type == 6)
        <div class="recruit-info col-md-12" style="padding:20px 0px 0px 0px">
            <h4>III - Sinh viên đăng ký</h4>
            <label class="col-md-offset-1"> Chọn vị trí bạn ứng tuyển: </label>
            <select id="apply_position" style="max-width: 150px">
                @foreach($recruitment_contents as $content)
                    <option value="{{$content->position}}">{{$content->position}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-md-offset-8" style="margin-top: 20px">
            <div class="col-md-6">
                <a href="/topics"
                role="button" class="btn btn-default btn-lg">
                    Back
                </a>
            </div>
            <div class="col-md-6">
                <input type="button"
                    class="btn btn-success btn-lg {{empty($student_apply)?'apply':'applied'}}"
                    value="{{empty($student_apply)?'Apply':'Applied'}}">
            </div>
        </div>
        @endif

    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>

    $('.apply').click(function(){
        $.ajax({
            url : "/student/apply-job",
            type : "POST",
            data : {
               position : $('#apply_position').val(),
               user_id : {{\Auth::id()}},
               recruitment_id : {{$topic->id}}
            },
            success : function (result){
                window.location.reload();
            },
            error : function(){
                console.log('error roi hihi');
            }
        });
    });
</script>
@endsection
