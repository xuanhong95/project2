@extends('layouts.app')

@section('content')
<div class="container" style="background:#f8f8f8;margin-bottom:30px">
    <div class="page-header">
        <h3><strong>Recruitments</strong></h3>
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
    <div class="col-md-10 col-md-offset-1">
        <table class="table table-striped table-hover table-responsive">
            <tr class="text-center">
                <th class="col-md-3"><strong>Company</strong></th>
                <th class="col-md-3"><strong>Status</strong></th>
                <th class="col-md-3"><strong>Description</strong></th>
            </tr>
            @foreach( $recruitments as $recruitment )
            <tr>
                <td>
                    <a href="{!! route('read-recruitment',['id' => $recruitment->id]) !!}">
                        {!! $recruitment->name !!}
                    </a>
                </td>
                <td>
                    <strong>{{ \App\Recruitment::getRecruitmentConfirmation( $recruitment->id ) }}</strong>
                </td>
                <td>
                    <p>{!! $recruitment->description !!}</p>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection
