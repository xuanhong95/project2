@extends('layouts.app')
@section('content')
<style media="screen">
    .margin-seasons{
        margin-left: 30px;
        margin-bottom: 30px;
    }
</style>
<div class="container" style="margin-top:70px">

    <div class="col-md-10" style="margin-bottom:30px">
        <a href="/teacher/seasons/create"  class="btn btn-primary">Start new Season...</a>
    </div>

    <div class="col-md-10 col-md-offset-1 well col-sm-10 col-xs-10 col-xs-offset-1">
        <legend>Seasons:</legend>
        @if(count($seasons)==0)
            <div class="col-md-6 col-md-offset-3">
                <h2>There aren't any available seasons</h2>
            </div>
        @else
            @for ($i=count($seasons);$i>0;$i--)
                <div class="col-md-offset-1" >
                    <div class="col-md-3 btn btn-lg
                        <?php echo $seasons[$i-1]->is_openning==1?'btn-info':'btn-warning'  ?>
                        margin-seasons col-sm-3 col-xs-3">

                        <a href="/teacher/seasons/info/id={!! $seasons[$i-1]->id !!}"><h4>Season {!! $seasons[$i-1]->id !!}</h4></a>
                        <h5>Status: {!! $seasons[$i-1]->is_openning==1?'Openning':'Finished' !!}</h5>
                    </div>
                </div>
            @endfor
        @endif
    </div>

</div>
<script type="text/javascript">
    $(function(){
        $('.season').on('click',function(){
            $(this).
        });
    });
</script>
@endsection
