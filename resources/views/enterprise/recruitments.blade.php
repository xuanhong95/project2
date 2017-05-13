@extends('layouts.app')


@section('content')
@include('layouts.left-sidebar')
<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
    <div class="page-header">
        <h3><strong>All Recruitments</strong></h3>
    </div>
    @if( count($recruitments) === 0 )
        <h3 class="text-center"><strong>There aren't any recruitments created.</strong></h3>
        <a href="{!! route('create-recruitment') !!}" class="btn btn-primary">Create New Recruitment</a>
    @else
    <div class="col-md-10 col-md-offset-1">
        <table class="table table-striped table-hover">
            <tr class="text-center">
                <th class="col-md-1">Season</th>
                <th class="col-md-3">Intern Quantity</th>
                <th class="col-md-3">Confirmation</th>
                <th class="col-md-3">Detail</th>
                <th class="col-md-2">Season State</th>
            </tr>
            @for( $i = count($recruitments); $i>0; $i--)
                <tr>
                    <td><a href="#">{!! $recruitments[$i-1]->id !!}</a></td>
                    <td>{!! $recruitments[$i-1]->quantity !!}</td>
                    <td>{!! \App\Recruitment::getRecruitmentConfirmation($recruitments[$i-1]->id) !!}</td>
                    <td>{{ \App\Season::getStatusSeasonID($recruitments[$i-1]->season) }}</td>
                    <td><a href="{{ route('enterprise-read-recruitment',['recruitment_id'=>$recruitments[$i-1]->id]) }}"
                            class="btn btn-info">Detail
                        </a>
                    </td>
                </tr>
            @endfor
        </table>
    </div>
        @if( $createRecruitmentEnable )
        <div class="col-md-2 col-md-offset-1">
            <a href="{!! route('create-recruitment') !!}" class="btn btn-primary">Create New Recruitment</a>
        </div>
        @endif
    @endif


    <div class="col-md-2 pull-right">
        <a href="{!! route('homepage') !!}" class="btn btn-default btn-lg">Back</a>
    </div>
</div>
@endsection
