@extends('layouts.app')
@extends('layouts.left-sidebar')

@section('content-with-sidebar')
<div class="container-fluid" style="margin-top:30px">
    <div class="col-md-10 col-md-offset-1 well">
        <div class="page-header col-md-offset-1">
            <h3>Recruitments</h3>
        </div>
        <div class="col-md-offset-1">
            <label for="season">Season:</label>
            <select name="season">
                @for( $i = 0; $i < $lastSeason->id; $i++ )
                <option value="{!! $i+1 !!}">{!! $i+1 !!}</option>
                @endfor
            </select>
        </div>
        <br>
        <br>
        <div class="">
            <div class="col-md-12" style="text-align:center;">
                <div class="col-md-5" style="text-align:center;">
                    <p>Company</p>
                </div>
                <div class="col-md-3 col-md-offset-4">
                    <p>Status</p>
                </div>
            </div>
            @foreach( $recruitments as $recruitment )
            <div class="col-md-12 btn btn-default" style="margin-top:3px"
                onclick="location.href='{!! route( 'read-recruitment',['id' => $recruitment->id] ) !!}'">
                <div class="col-md-5">
                    <a href="#">{!! $recruitment->name !!}</a>
                </div>
                <div class="col-md-3 col-md-offset-4">
                    <p>
                        <?php if( is_null($recruitment->is_confirm) ) echo "Unapproved";
                            elseif( $recruitment->is_confirm == 1 ) echo "Accepted";
                            else echo "Declined";
                        ?>
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
