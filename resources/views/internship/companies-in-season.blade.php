@extends('layouts.app')
@section('content')
<div class="container" style="margin-top:70px">
    <div class="page-header">
        <h2>Companies</h2>
    </div>
    <div class="col-md-10 col-md-offset-1 well">
        <div class="">
            <label for="season">Season: </label>
            <select class="" id="season">
                @foreach( $all_season_id as $season_id )
                    <option value="{!! $season_id->id !!}">{!! $season_id->id !!}</option>
                @endforeach
            </select>
        </div>
        <div class="row col-md-10 col-md-offset-1" style="margin-top:10px">
            @foreach( $companies_list as $company)
                <table class="table table-striped table-hover table-responsive">
                    <thead >
                        <th class="col-md-5">Company</th>
                        <th class="col-md-4">Address</th>
                        <th class="col-md-3">Detail</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-success"><h4><strong>{!! $company->name !!}</strong></h4></td>
                            <td>{!! $company->address !!}</td>
                            <td>
                                <div class="">
                                    <a role="button" href="#" class="btn btn-primary btn-sm">Recruitments</a>
                                    <a role="button" href="#" class="btn btn-info btn-sm">Info</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            @endforeach
        </div>

    </div>
</div>
@endsection
