@extends('layout')

@section('title')
    Form Access Remote
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    <link rel="stylesheet" href="{{ asset('assets/js/datetimepicker/jquery.datetimepicker.min.css') }}">
    <style>
        .text-red {
            color: red;
        }
        .text-lightgray {
            color: lightgray;
        }
    </style>
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c66' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Registration Form</h1>
    </div>
</div>

@foreach ($errors->all() as $message)
<div class="row">
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <label for="">{{$message}}<label>
     </div>
</div>
@endforeach

<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading text-center"><b>Form Remote Access Request VPN</b></div>
        <div class="panel-body">

            <form action="{{ route('form/overtime/post') }}" method="post" class="needs-validation">
                {{ csrf_field() }}
                <input type="hidden" name="generalManager" id="generalManager" class="form-control" value="{{ $generalManager->id }}">
                <input type="hidden" name="day" value="{{ $day }}">
                @if (date("D") === $day)
                <div class="row">
                    <div class="col-lg-8"></div>
                    <div class="col-lg-4">
                        <label class="checkbox-inline" for="vpnFriday"><input type="checkbox" name="vpnFriday" id="vpnFriday" required @if (date("D") !== $day)
                            checked
                        @endif><b>Open Remote Access (VPN) for Friday</b></label>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="requested">Request By:</label>
                            <input type="text" name="requested" id="requested" class="form-control" value="{{ auth()->user()->getFullName() }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="nik">NIK:</label>
                            <input type="text" name="nik" id="nik" class="form-control" value="{{ auth()->user()->nik }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-4"></div>

                    <div class="col-lg-2" id="startPicker"  {{ $hidden['hiddenFri'] }}>
                        <div class="form-group">
                            <label for="startOvertime" class="text-red">Start:</label>
                            <div class="input-group date" data-date-format="dd.mm.yyyy">
                                <input type="text" name="startOvertime" id="startOvertime" class="form-control"placeholder="dd.mm.yyyy" value="{{ date('Y-m-d') }} 23:00" required>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2" id="endPicker" {{ $hidden['hiddenFri'] }}>
                        <div class="form-group">
                            <label for="endOvertime" class="text-red">End:</label>
                            <div class="input-group date" data-date-format="dd.mm.yyyy">
                                <input type="text" name="endOvertime" id="endOvertime" class="form-control"placeholder="dd.mm.yyyy" required>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="period">Period:</label>
                            <input type="text" name="period" id="period" class="form-control" value="{{ date('Y') }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="position">Position:</label>
                            <input type="text" name="position" id="position" class="form-control" value="{{ auth()->user()->position }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-2" id="workFrom" {{ $hidden['hiddenFri'] }}>
                        <div class="form-group">
                            <label for="worker" class="text-red">Work From..</label>
                            <select name="worker" id="worker" class="form-control" required>
                                <option value="1">Home</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="joinDate">Join Date:</label>
                            <input type="text" name="joinDate" id="joinDate" class="form-control" value="{{ auth()->user()->join_date }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="endDate">End Date:</label>
                            <input type="text" name="endDate" id="endDate" class="form-control" value="{{ auth()->user()->end_date }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    @if (auth()->user()->koor == 0)
                        <div class="col-lg-2" id="selectCoor" {{ $hidden['hiddenFri'] }}>
                            <div class="form-group">
                                <label for="coordinator">Your Need Approval:</label>
                                <select name="coordinator" id="coordinator" class="form-control"  required>
                                    <option value=""><span class="text-lightgray">-select approval-</span></option>
                                    <optgroup label="Coordinator">
                                        @foreach ($coordinator as $coor)
                                            <option value="{{ $coor->id }}">{{ $coor->getFullName() }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Project Manager & Producer">
                                        @foreach ($projectManager as $project)
                                            <option value="{{ $project->id }}">{{ $project->getFullName() }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="department">Department:</label>
                            <input type="text" name="department" id="department" class="form-control" value="{{ auth()->user()->department['dept_category_name'] }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>

                <div class="row" id="rowVPN" {{ $hidden['hiddenFri'] }}>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="checkbox-inline" for="vpn"><input type="checkbox" name="vpn" id="vpn" checked>Open Remote Access (VPN)</label>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                </div>

                <div class="row">
                    <div class="col-lg-4" id="divReason" {{ $hidden['hiddenFri'] }}>
                        <div class="form-group">
                            <label for="reason">Reason:</label>
                            <textarea name="reason" id="reason" cols="30" rows="10" class="form-control"  placeholder="minimal 15 character" required></textarea>
                        </div>
                    </div>
                </div>

                @if (date('D') === $day)
                {{-- weekend --}}
                <div class="row">
                    <div class="col-lg-12">
                        <label for="" class="text-bold">For Weekend:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="checkbox-inline" for="vpnSaturday"><input type="checkbox" name="vpnSaturday" id="vpnSaturday"><b>Open Remote Access (VPN) for Saturday</b></label>
                                    </div>
                                </div>
                            </div>
                            <div id="saturdayWorked" class="hidden">
                                <div class="row">
                                    <div class="col-lg-4" id="startPickerSaturday">
                                        <div class="form-group">
                                            <label for="startSaturday" class="text-red">Start:</label>
                                            <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                <input type="text" name="startSaturday" id="startSaturday" class="form-control"placeholder="dd.mm.yyyy">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" id="endPickerSaturday">
                                        <div class="form-group">
                                            <label for="endSaturday" class="text-red">End:</label>
                                            <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                <input type="text" name="endSaturday" id="endSaturday" class="form-control"placeholder="dd.mm.yyyy">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="workderSaturday" class="text-red">Work From..</label>
                                            <select name="workderSaturday" id="workderSaturday" class="form-control">
                                                <option value="1">Home</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @if (auth()->user()->koor == 0)
                                    <div class="col-lg-4 {{ $hidden['hiddenCoor'] }}">
                                        <div class="form-group">
                                            <label for="saturdayCoordinator">Your Coordinator:</label>
                                            <select name="saturdayCoordinator" id="saturdayCoordinator" class="form-control">
                                                <option value=""><span class="text-lightgray">-select approval-</span></option>
                                                <optgroup label="Coordinator">
                                                    @foreach ($coordinator as $coor)
                                                        <option value="{{ $coor->id }}">{{ $coor->getFullName() }}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="Project Manager & Producer">
                                                    @foreach ($projectManager as $project)
                                                        <option value="{{ $project->id }}">{{ $project->getFullName() }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="reasonSaturday">Reason:</label>
                                            <textarea name="reasonSaturday" id="reasonSaturday" cols="30" rows="10" class="form-control" placeholder="minimal 15 character"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="checkbox-inline" for="vpnSunday"><input type="checkbox" name="vpnSunday" id="vpnSunday"><b>Open Remote Access (VPN) for Sunday</b></label>
                                    </div>
                                </div>
                            </div>
                            <div id="sundayWorked" class="hidden">
                                <div class="row">
                                    <div class="col-lg-4" id="startPickerSunday">
                                        <div class="form-group">
                                            <label for="startSunday" class="text-red">Start:</label>
                                            <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                <input type="text" name="startSunday" id="startSunday" class="form-control"placeholder="dd.mm.yyyy">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group" id="endPickerSunday">
                                            <label for="endSunday" class="text-red">End:</label>
                                            <div class="input-group date" data-date-format="dd.mm.yyyy">
                                                <input type="text" name="endSunday" id="endSunday" class="form-control"placeholder="dd.mm.yyyy">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="workderSunday" class="text-red">Work From..</label>
                                            <select name="workderSunday" id="workderSunday" class="form-control">
                                                <option value="1">Home</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @if (auth()->user()->koor == 0)
                                    <div class="col-lg-4 {{ $hidden['hiddenCoor'] }}">
                                        <div class="form-group">
                                            <label for="sundayCoordinator">Your Coordinator:</label>
                                            <select name="sundayCoordinator" id="sundayCoordinator" class="form-control">
                                                <option value=""><span class="text-lightgray">-select approval-</span></option>
                                                <optgroup label="Coordinator">
                                                    @foreach ($coordinator as $coor)
                                                        <option value="{{ $coor->id }}">{{ $coor->getFullName() }}</option>
                                                    @endforeach
                                                </optgroup>
                                                <optgroup label="Project Manager & Producer">
                                                    @foreach ($projectManager as $project)
                                                        <option value="{{ $project->id }}">{{ $project->getFullName() }}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="reasonSunday">Reason:</label>
                                            <textarea name="reasonSunday" id="reasonSunday" cols="30" rows="10" class="form-control" placeholder="minimal 15 character"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                {{-- end weekend --}}

                <div class="row">
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        <a href="{{ route('form/progressing/index')}}" class="btn btn-sm btn-default">Form List</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="modalProject" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="modal-content">
            <!--  -->
        </div>
    </div>
</div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_3')
    @include('assets_script_2')
   <script src="{{ asset('assets/js/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
@stop

@section('script')

$(document).ready(function () {
    var waktu = new Date();
    if (waktu.getDay() == 5) {
        $("select#coordinator").removeAttr('required');
        $("input#startOvertime").removeAttr('required');
        $("input#endOvertime").removeAttr('required');
        $("select#worker").removeAttr('required');
        $("input#vpn").removeAttr('checked');
        $("textarea#reason").removeAttr('required');
    }
});

$(document).on('click','#ajaxModalProject',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});


$(document).on('click', 'input#vpnSaturday', function(e) {
    var saturdayWorker = $('div#saturdayWorked').attr('class');

    if (saturdayWorker) {
        document.getElementById("saturdayWorked").classList.remove("hidden");
        $("input#startSaturday").attr('required', true);
        $("input#endSaturday").attr('required', true);
        $("select#saturdayCoordinator").attr('required', true);
        $("select#saturdayProjectManager").attr('required', true);
        $("textarea#reasonSaturday").attr('required', true);
        $("input#vpnFriday").removeAttr("required");

    } else {
        document.getElementById("saturdayWorked").classList.add("hidden");
        $("input#startSaturday").removeAttr('required');
        $("input#endSaturday").removeAttr('required');
        $("input#saturdayCoordinator").removeAttr('required');
        $("textarea#reasonSaturday").removeAttr('required');
        $("input#vpnFriday").attr("required", true);
    }
});

$(document).on('click', 'input#vpnSunday', function(e) {
    var sundayWorked = $('div#sundayWorked').attr('class');

    console.log(sundayWorked);

    if (sundayWorked) {
        document.getElementById("sundayWorked").classList.remove("hidden");
        $("input#startSunday").attr('required', true);
        $("input#endSunday").attr('required', true);
        $("select#sundayCoordinator").attr('required', true);
        $("select#sundayProjectManager").attr('required', true);
        $("textarea#reasonSunday").attr('required', true);
        $("input#vpnFriday").removeAttr("required");

    } else {
        document.getElementById("sundayWorked").classList.add("hidden");
        $("input#startSunday").removeAttr('required');
        $("input#endSunday").removeAttr('required');
        $("select#sundayCoordinator").removeAttr('required');
        $("select#sundayProjectManager").removeAttr('required');
        $("textarea#reasonSunday").removeAttr('required');
        $("input#vpnFriday").attr("required", true);
    }
});

$(document).on('click', 'input#vpnFriday', function (e) {
  var friStartOvertime = $('div#startPicker').attr('hidden');

  if (friStartOvertime) {
    $("input#vpn").attr("checked", true);
    $("input#vpn").removeAttr("required");
    $("div#rowVPN").removeAttr("hidden");
      
    $("div#startPicker").removeAttr("hidden");
    $("input#startOvertime").attr("required", true);   
    
    $("div#endPicker").removeAttr("hidden");
    $("input#endOvertime").attr("required", true);

    $("div#workFrom").removeAttr("hidden");
    $("select#worker").attr("required", true);

    $("div#selectCoor").removeAttr("hidden");
    $("select#coordinator").attr("required", true);

    $("div#divReason").removeAttr("hidden");
    $("textarea#reason").attr("required", true);

  } else {
    $("input#vpn").removeAttr("checked");
    $("input#vpn").attr("required", true);
    $("div#rowVPN").attr("hidden", true);

    $("div#startPicker").attr("hidden", true);
    $("input#startOvertime").removeAttr('required');

    $("div#endPicker").attr("hidden", true);
    $("input#endOvertime").removeAttr("required");

    $("div#workFrom").attr("hidden", true);
    $("select#worker").removeAttr("required");

    $("div#selectCoor").attr("hidden", true);
    $("select#coordinator").removeAttr("required");

    $("div#divReason").attr("hidden", true);
    $("textarea#reason").removeAttr("required");
  }


})

$(document).on('click', 'div#startPicker', function (e) {
    $('input#startOvertime').datetimepicker({});
});

$(document).on('click', 'div#endPicker', function (e) {
    $('input#endOvertime').datetimepicker({});
});

$(document).on('click', 'div#startPickerSaturday', function (e) {
    $('input#startSaturday').datetimepicker({});
});

$(document).on('click', 'div#endPickerSaturday', function (e) {
    $('input#endSaturday').datetimepicker({});
});

$(document).on('click', 'div#startPickerSunday', function (e) {
    $('input#startSunday').datetimepicker({});
});

$(document).on('click', 'div#endPickerSunday', function (e) {
    $('input#endSunday').datetimepicker({});
});

@stop
