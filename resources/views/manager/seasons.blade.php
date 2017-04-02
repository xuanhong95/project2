@extends('layouts.app')
@extends('layouts.left-sidebar')

@section('content-with-sidebar')
<style media="screen">
    .margin-seasons{
        margin-left: 30px;
        margin-bottom: 30px;
    }
</style>
<div class="container-fluid" style="margin-top:30px">

    <div class="col-md-10" style="margin-bottom:30px">
        <a href="{!! route('create-season') !!}"  class="btn btn-info">Start new Season...</a>
    </div>

    <div class="col-md-10 col-md-offset-1 well col-sm-10 col-xs-10 col-xs-offset-1">
        <div class="page-header col-md-offset-1">
            <h3>Seasons</h3>
        </div>
        @if(count($seasons)==0)
            <div class="col-md-6 col-md-offset-3">
                <h2>There aren't any available seasons</h2>
            </div>
        @else
            <?php

                function is_openningSeason($season)
                {
                    $currentDate = date('Y-m-d');
                    return ( $currentDate > $season->start_date )&&( $currentDate < $season->end_date )?true:false;
                }

                function getStatus($season)
                {
                    $currentDate = date('Y-m-d');
                    if ( $currentDate > $season->end_date ){
                        return "Finished";
                    }
                    elseif ( $currentDate > $season->remarking_deadline ){
                        return "Remarking...";
                    }
                    elseif ( $currentDate > $season->submit_result_deadline ){
                        return "Submitting results...";
                    }
                    else {
                        return "Registering..";
                    }
                }
            ?>
            @for ($i=count($seasons);$i>0;$i--)
                <div class="col-md-offset-1" >
                    <div class="col-md-3 btn btn-lg
                        margin-seasons col-sm-3 col-xs-3
                        <?php echo is_openningSeason($seasons[$i-1])?'btn-primary':'btn-warning' ?>
                        ">
                        <a href="{!! route('edit-season',['season'=>$seasons[$i-1]->id]) !!}"
                            style="color:white"
                            ><h4>Season {!! $seasons[$i-1]->id !!}</h4></a>
                        <h5>Status:<?php echo getStatus($seasons[$i-1]) ?></h5>
                    </div>
                </div>
            @endfor
        @endif
    </div>

</div>
<script type="text/javascript">
    $(function(){
        $('.season').on('click',function(){

        });
    });
</script>
@endsection
