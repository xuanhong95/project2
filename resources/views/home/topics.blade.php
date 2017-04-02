@extends('layouts.app')
@extends('layouts.left-sidebar')
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
</style>

@section('content-with-sidebar')
<div class="container-fluid" style="margin-top:30px">
    <div class="col-md-10 col-md-offset-1 well">
        <div class="page-header col-md-offset-1">
            <h3>Topics</h3>
        </div>
        <?php $i = 0; ?>
        @foreach($list_topic as $topic)
        <div class="col-md-12 alert-success" style="margin-top: 5px; border-radius: 4px">
            @if($i < 3)
            <div>
                <img src="/images/new_img.png"/>
            </div>
            <div class="col-md-11">
                <h4>Tuyển {{$topic->quantity}} thực tập sinh</h4>
                <p>Công ty: {{\App\Company::getCompanyNameByID($topic->company_id)}}</p>
                <p>Người đăng tin: {{\App\Enterprise::getEnterpriseNameByID($topic->user_id)}}</p>
            </div>
                <a class="btn-view-detail" href="{!! route('view-topic-detail',['topic_id'=>$topic->id]) !!}">View Detail</a>
            <?php $i++; ?>
            @else
            <div>
                <h4>Tuyển {{$topic->quantity}} thực tập sinh</h4>
                <p>Công ty: {{\App\Company::getCompanyNameByID($topic->company_id)}}</p>
                <p>Người đăng tin: {{\App\Enterprise::getEnterpriseNameByID($topic->user_id)}}</p>
            </div>
                <a class="btn-view-detail" href="{!! route('view-topic-detail',['topic_id'=>$topic->id]) !!}">View Detail</a>
            @endif
        </div>
        @endforeach
    </div>
</div>

@endsection
