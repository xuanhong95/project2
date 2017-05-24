@extends('layouts.app')
@section('content')
@include('layouts.left-sidebar')
<link href="/css/toastr.min.css" rel="stylesheet">
<div class="col-md-10" style="background:#f8f8f8;margin-bottom:30px">
    <div class="page-header col-md-offset-1">
        <h3>Timesheets</h3>
    </div>
    <div class="col-md-10 col-md-offset-1 well">
        @foreach( $timesheetsOfStudentsInSelectedMonth as $timesheetsOfStudent )
        <?php $student_id = $timesheetsOfStudent->user_id ?>

        <div class="btn btn-default btn-block" data-toggle="collapse" data-target="#{{ $student_id }}" >
            <h3>Student: {{ \App\User::getUserNameByID( $student_id ) }}</h3>
        </div>

        <div id="{{ $student_id }}" class="collapse" >
            <div class="content" style="overflow:auto">
                <!-- select month -->
                <div class="col-md-3">
                    <label for="month">Month</label>
                    <select class="form-control {{ $student_id  }}">
                        @foreach( $monthsInSeason as $key => $month)
                        <option value='{{ +$month["month"] }}'>{{ +$month["month"] }}/{{ +$month["year"]}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- end select month -->

                <!-- table of timesheets -->
                <div class="col-md-12" style="margin-top:20px">
                    <p><strong>A:</strong>Over time,   <strong>B:</strong>Enought time,   <strong>C:</strong>Sick leave
                        <strong>D:</strong>Allowed absent,   <strong>F:</strong>Not allowed absent,   <strong>X:</strong>Other reason</p>

                        <?php $startDay = $timesheetsOfStudent->timesheetsInMonth->startDay;
                        $endDay = $timesheetsOfStudent->timesheetsInMonth->endDay?>

                        <table class="table table-responsive table-striped table-hover table-bordered {{ $student_id  }}">
                            <tr>
                                <th class="col-md-3">Work contents</th>
                                <th>Status</th>
                                @for( $i = $startDay; $i <= $endDay; $i++)
                                <th>{{ $i }}</th>
                                @endfor
                            </tr>
                            @foreach( $timesheetsOfStudent->timesheetsInMonth->timesheets as $key => $timesheet)
                            <?php $task_id = $timesheet->task_id ?>
                            <tr>
                                <td rowspan="6">{{ $timesheet->content }}</td>
                                <td><strong>A</strong></td>
                                @for( $day = $startDay; $day <= $endDay; $day++)
                                <td>
                                    <input type="radio"
                                        name="{{ $day }}/{{ $timesheet->task_id }}/{{ $student_id  }}"
                                        value="enough/{{ $day }}/{{ $task_id }}/{{ $student_id }}"
                                        <?php echo strpos($timesheet->enough_time, $day."") !== false?"checked":"" ?>></td>
                                @endfor
                            </tr>
                            <tr>
                                <td><strong>B</strong></td>
                                @for( $day = $startDay; $day <= $endDay; $day++)
                                <td>
                                    <input type="radio"
                                        name="{{ $day }}/{{ $timesheet->task_id }}/{{ $student_id  }}"
                                        value="overtime/{{ $day }}/{{ $task_id }}/{{ $student_id }}"
                                        <?php echo strpos($timesheet->overtime, $day."") !== false?"checked":"" ?>></td>
                                @endfor
                            </tr>
                            <tr>
                                <td><strong>C</strong></td>
                                @for( $day = $startDay; $day <= $endDay; $day++)
                                <td>
                                    <input type="radio"
                                        name="{{ $day }}/{{ $timesheet->task_id }}/{{ $student_id  }}"
                                        value="sick/{{ $day }}/{{ $task_id }}/{{ $student_id }}"
                                        <?php echo strpos($timesheet->sick_leave, $day."") !== false?"checked":"" ?>></td>
                                @endfor
                            </tr>
                            <tr>
                                <td><strong>D</strong></td>
                                @for( $day = $startDay; $day <= $endDay; $day++)
                                <td>
                                    <input type="radio"
                                        name="{{ $day }}/{{ $timesheet->task_id }}/{{ $student_id  }}"
                                        value="leave/{{ $day }}/{{ $task_id }}/{{ $student_id }}"
                                        <?php echo strpos($timesheet->leave, $day."") !== false?"checked":"" ?>></td>
                                @endfor
                            </tr>
                            <tr>
                                <td><strong>F</strong></td>
                                @for( $day = $startDay; $day <= $endDay; $day++)
                                <td><input type="radio"
                                    name="{{ $day }}/{{ $timesheet->task_id }}/{{ $student_id  }}"
                                    value="withoutAbsent/{{ $day }}/{{ $task_id }}/{{ $student_id }}"
                                    <?php echo strpos($timesheet->absent_without_leave, $day."") !== false?"checked":"" ?>></td>
                                @endfor
                            </tr>
                            <tr>
                                <td><strong>X</strong></td>
                                @for( $day = $startDay; $day <= $endDay; $day++)
                                <td><input type="radio"
                                        name="{{ $day }}/{{ $timesheet->task_id }}/{{ $student_id }}"
                                        value="other/{{ $day }}/{{ $task_id }}/{{ $student_id }}"
                                        <?php echo strpos($timesheet->other, $day."") !== false?"checked":"" ?>></td>
                                @endfor
                            </tr>

                            @endforeach
                        </table>
                    </div>
                </div>

            </div>

            @endforeach
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src = "/js/toastr.min.js"></script>
    <script src = "/js/toast-reset.js"></script>
    <script type="text/javascript">

    $(function(){
        toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-top-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}

        var startDayOfSelectedMonth = {{ $timesheetsOfStudentsInSelectedMonth[0]->timesheetsInMonth->startDay }};
        var endDayOfSelectedMonth = {{ $timesheetsOfStudentsInSelectedMonth[0]->timesheetsInMonth->endDay }};

        $("select").on("change",function(){
            // console.log($(this));

            var selectedMonthIndex = $(this)[0].selectedIndex;
            console.log(selectedMonthIndex);
            var student_id = $(this).closest(".collapse").attr("id");
            // console.log(selectedStudentDiv);
            var table = $(this).closest(".content").find("table");
            // console.log(table);
            $.ajax({
                url: "{{ route('timekeeping') }}",
                method: "post",
                data:{
                    student_id : student_id,
                    selectedMonthIndex : selectedMonthIndex,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                table: table,
                success:function(timesheets){
                    console.log(timesheets);
                    var student_id = timesheets.user_id;
                    var startDay = timesheets.timesheetsInMonth.startDay;
                    var endDay = timesheets.timesheetsInMonth.endDay;
                    var timesheets = timesheets.timesheetsInMonth.timesheets;
                    var enoughDays, overtimeDays, sickDays, leaveDays
                        , disagreeDays, otherDays;

                    startDayOfSelectedMonth = startDay;
                    endDayOfSelectedMonth = endDay;

                    var timesheetsContent;
                    for( timesheet of timesheets ){
                        enoughDays = "";
                        overtimeDays = "";
                        sickDays = "";
                        leaveDays = "";
                        disagreeDays = "";
                        otherDays = "";

                        for (i = startDay; i <= endDay; i++) {
                            enoughDays += "<td><input type='radio' name="
                                + i +"/" + timesheet.task_id +"/"+ student_id
                                + " value='enough/"+i+"/" + timesheet.task_id
                                + "/" + student_id +"'"
                                + (timesheet.enough_time.includes(i)?"checked":"")
                                + "></td>\n";

                            overtimeDays += "<td><input type='radio' name="
                                + i +"/" + timesheet.task_id +"/"+ student_id
                                + " value='overtime/"+i+"/" + timesheet.task_id
                                + "/" + student_id +"'"
                                + (timesheet.overtime.includes(i)?"checked":"")
                                + "></td>\n";
                            sickDays += "<td><input type='radio' name="
                                + i +"/" + timesheet.task_id +"/"+ student_id
                                + " value='sick/"+i+"/" + timesheet.task_id
                                + "/" + student_id +"'"
                                + (timesheet.sick_leave.includes(i)?"checked":"")
                                + "></td>\n";
                            leaveDays += "<td><input type='radio' name="
                                + i +"/" + timesheet.task_id +"/"+ student_id
                                + " value='leave/"+i+"/" + timesheet.task_id
                                + "/" + student_id +"'"
                                + (timesheet.leave.includes(i)?"checked":"")
                                + "></td>\n";
                            disagreeDays += "<td><input type='radio' name="
                                + i +"/" + timesheet.task_id+"/"+ student_id
                                + " value='withoutAbsent/"+i+"/" + timesheet.task_id
                                + "/" + student_id +"'"
                                + (timesheet.absent_without_leave.includes(i)?"checked":"")
                                + "></td>\n";
                            otherDays += "<td><input type='radio' name="
                                + i +"/" + timesheet.task_id +"/"+ student_id
                                + " value='other/"+i+"/" + timesheet.task_id
                                + "/" + student_id +"'"
                                + (timesheet.other.includes(i)?"checked":"")
                                + "></td>\n";
                        }
                        timesheetsContent +=
                        "<tr>\n"
                            +"<td rowspan='6'>"+ timesheet.content +"</td>\n"
                            +"<td><strong>A</strong></td>\n"
                            +enoughDays+"\n"
                        +"</tr>\n"
                        +"<tr>\n"
                            +"<td><strong>B</strong></td>\n"
                            + overtimeDays + "\n"
                        +"</tr>\n"
                        +"<tr>\n"
                            +"<td><strong>C</strong></td>\n"
                            + sickDays + "\n"
                        +"</tr>\n"
                        +"<tr>\n"
                            +"<td><strong>D</strong></td>\n"
                            + leaveDays + "\n"
                        +"</tr>\n"
                        +"<tr>\n"
                            +"<td><strong>F</strong></td>\n"
                            + disagreeDays + "\n"
                        +"</tr>\n"
                        +"<tr>\n"
                            +"<td><strong>X</strong></td>\n"
                            + otherDays + "\n"
                        +"</tr>\n";
                    }

                    var daysHeader;
                    for (i = startDay; i <= endDay; i++) {
                        daysHeader += "<th>" + i + "</th>\n";
                    }

                    var tableHeader  = "<tr>\n"
                        +"<th class='col-md-3'>Work contents</th>\n"
                        +"<th>Status</th>\n"
                        + daysHeader +"\n"
                    +"</tr>\n";
    // console.log(this.table);
                    var tableContent = tableHeader + timesheetsContent;
                    this.table.html(tableContent);

                },
                error:function(response){
                    toastr.error("Error");
                }
            });
        });

        $(".content").on('click',"input",function(){
            var month = $(this).closest(".content").find("select").val();
            var value = $(this).val();
            // console.log(month);
            // console.log(value);

            var inf = value.split("/");
            // console.log(inf);
            var rowOfThisInput = $(this).closest("tr");
            var sameStatusTaskIdDays;
            var name;
            var sameStatusTaskIdDaysChecked = "";

            for( i = startDayOfSelectedMonth; i <= endDayOfSelectedMonth; i++){
                name = i + "/" +inf[2]+"/"+inf[3];
                console.log(name);
                // console.log("name "+name);
                sameStatusTaskIdDays = rowOfThisInput.find("input[name = '"+ name + "']");
                // console.log(sameStatusTaskIdDays);
                if(sameStatusTaskIdDays[0].checked){
                    sameStatusTaskIdDaysChecked += i + ",";
                }
            }
            // console.log(sameStatusTaskIdDaysChecked);

            $.ajax({
                url:"{{ route('checkTimekeeping') }}",
                method:"post",
                data:{
                    days : sameStatusTaskIdDaysChecked,
                    student_id: $(this).closest(".collapse").attr("id"),
                    month: month,
                    status: inf[0],
                    task_id: inf[2],
                    season_id: {{ $timesheetsOfStudentsInSelectedMonth[0]->timesheetsInMonth->season }},
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    // console.log(response);
                    toastr.success("Success",response);
                },
                error:function(){
                    toastr.error("Error");
                }
            });
        });

    });
    </script>
    @endsection
