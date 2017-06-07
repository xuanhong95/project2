@extends('layouts.app')
<style>
    h1{
        text-align: center;
    }
    table{
        line-height: 30px;
    }
    .table th,
    .table td{
        text-align: center;
        border: 1px solid black!important;
    }
    .table{
        margin-top: 30px;
        border: 1px solid black;
    }
    .table th{
        background: #f2dede;
    }
    .table td{
        background: #faebcc;
    }
    a{
        text-decoration: none!important;
    }
    a.update-status{
        color: green;
    }
    .rpd-total-rows{
        display: none;
    }
</style>
@section('content')
<div class="container">
    <div class="invoice col-md-12">
        <div class="col-md-12" style="background: white;">
            <div class="panel" style="border-bottom: 3px solid rgba(0, 0, 0, 0.21); margin-bottom: 20px;">
                <h3>Danh sách tài khoản</h3>
            </div>
            <div class="panel" style="border-bottom: 3px solid rgba(0, 0, 0, 0.21); margin-bottom: 20px; height: 130px">
                <h3>Tìm kiếm</h3>
                <div class="col-md-10 col-md-offset-1 row">
                    <form class="" action="{{ route('manage-account')}}" method="post">
                        {{ csrf_field() }}
                    </div>
                    <div class="form-group">
                        <div class="col-md-2">
                            <strong style="float: right; line-height: 35px">Email</strong>
                        </div>
                        <div class="col-md-5">
                            <input class="form-control" placeholder="abc@sie.edu.vn" name="keyword" type="text" value="{{empty($old_key)?'':$old_key}}"/>
                        </div>
                        <div style="float:left">
                            <input class="btn btn-primary" type="submit" value="Search">
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-12">
                    {!!$grid!!}
                </div>
                
            </div>

        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@endsection