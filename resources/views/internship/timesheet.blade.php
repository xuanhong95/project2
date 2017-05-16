@extends('layouts.app')
@section('content')
@include('layouts.left-sidebar')
<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
    <div class="page-header col-md-offset-1">
        <h3>Timesheet</h3>
    </div>
    <div class="col-md-10 col-md-offset-1 well">
        <select id="company" class="custom-select" name="">
            <option value="0">--Choose--</option>
            @foreach( $companiesInSeason as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </select>

        <select id="season" class="custom-select" name="">
            @for( $i = $lastSeason; $i >0; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div id="working-time" class="col-md-10 col-md-offset-1 well">
        <h4>Choose company</h4>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $("#company").on("change",function(){
            if( $(this).val() != 0 ){
                $.ajax({
                    url: "{{ route('getTimesheetsOfCompanyInSeason') }}",
                    data: {
                        company_id : $(this).val(),
                        season : $("#season").val()
                    },
                    success: function(result){
                        console.log(result);
                    },
                    error: function(result, error){
                        console.log(result);
                        console.log(error.status);
                    }
                });
            }
        });

        $("season").on("change", function(){

        });
    });
</script>
@endsection
