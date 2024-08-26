@extends('layout')

@section('title')
    Attendance
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
    'c30001' => 'active'
    ])
@stop
@section('body')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Attendance</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>Name</td>
                    <th>: {{ auth::user()->first_name }} {{ auth::user()->last_name }}</th>
                </tr>
                <tr>
                    <td>NIK</td>
                    <th>: {{ auth::user()->nik }}</th>
                </tr>
                <tr>
                    <td>Time & Date :</td>
                    <th>: {{ $now }} <span id="jam"></span>:<span id="menit"></span>:<span id="detik"></span></th>
                </tr>
                <tr>
                    <th>
                        <div class="col-lg-1">
                            @if($oldData === Null)
                            <!-- <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">check in</button> -->
                            <form action="{{ route('postedCheckIn') }}" method="POST">
                                {{ csrf_field() }}
                                <button class="btn btn-sm btn-primary" type="submit">check in</button>
                            </form>
                            @endif
                        </div>
                    </th>
                    <th>
                        <div class="col-lg-1">
                            @if($oldData != Null)
                            @if($lastData === 0)
                            <!-- <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#checkOut">check out</button> -->
                            <form action="{{ route('postedCheckOut') }}" method="POST">
                                {{ csrf_field() }}
                                <button class="btn btn-sm btn-primary" type="submit">check out</button>
                            </form>
                            @endif
                            @endif
                        </div>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="col-lg-9">
        <div class="pull-right">
            <button class="fa fa-info" data-toggle="modal" data-target="#attendance" type="button" title="Guide Attendance"></button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Remarks</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Check In</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('checkIn') }}" method="POST" enctype="application/x-www-form-urlencoded">
                    {{ csrf_field() }}
                    <div class="g-recaptcha" data-sitekey="6LeYEUUaAAAAAA2FuzNxgCSe10oMlmArRxgQdzwo">
                    </div>
                    <br />
                    <input type="submit" value="Submit" class="btn-sm btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
                <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
                </script>
            </div>
        </div>

    </div>
</div>

<div id="checkOut" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Check Out</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('checkOut') }}" method="POST" enctype="application/x-www-form-urlencoded">
                    {{ csrf_field() }}
                    <div class="g-recaptcha" data-sitekey="6LeYEUUaAAAAAA2FuzNxgCSe10oMlmArRxgQdzwo">
                    </div>
                    <br />
                    <input type="submit" value="Submit" class="btn-sm btn btn-primary">
                </form>
                <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div class="modal" id="attendance">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">How to use attendance?</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>You can choose attendance menu</li>
                    <img src="{{asset('storage/app/booklet/attendance/menu.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
                    <li>Click button check in for your attendance</li>
                    <img src="{{asset('storage/app/booklet/attendance/form_attendance.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
                    <img src="{{asset('storage/app/booklet/attendance/form_out_attendance.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
                    <li>Attendance verification will appear you check in and check out to indicates your presence has been inputted to the system</li>
                    <img src="{{asset('storage/app/booklet/attendance/verify_check_in.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
                    <img src="{{asset('storage/app/booklet/attendance/feedback_in.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
                    <li>You can check your attendance data records</li>
                    <img src="{{asset('storage/app/booklet/attendance/record_data_attendance.JPG')}}" style=" display: block; margin-left: auto; margin-right: auto;" style=" display: block; margin-left: auto; margin-right: auto;" class="img-responsive gadang">
                </ul>
                <br>
                <br>
                <font color="red">**</font>Note:
                <br>
                <ul>
                    <li>For attendance can only be done once a day.</li>
                    <li>The check out button will appear when you check in on the same day, if the day changes you cannot check out.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">
            <!--  -->
        </div>
    </div>
</div>

<script type="text/javascript">
    window.setTimeout("waktu()", 1000);

    function waktu() {
        var waktu = new Date();
        setTimeout("waktu()", 1000);
        document.getElementById("jam").innerHTML = waktu.getHours();
        document.getElementById("menit").innerHTML = waktu.getMinutes();
        document.getElementById("detik").innerHTML = waktu.getSeconds();
    }
</script>
@stop
@section('bottom')
@include('assets_script_1')
@include('assets_script_2')
@include('assets_script_7')
@stop

@section('script')
$('#tables').DataTable({
"columnDefs": [
{ className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [] }
],
"order": [
[0, "asc" ]
],
processing: true,
responsive: true,
"dom": 'Blfrtip',
"buttons": [{
extend: 'excelHtml5',
text: '<i class="fa fa-download" style="font-size: 20px;"></i>',
titleAttr: 'Attendance',
title: 'Attendance'
}],
ajax: '{!! URL::route("dataAbsensi") !!}',
columns: [
{ data: 'DT_Row_Index', orderable: false, searchable : false},
{ data: 'nik'},
{ data: 'fullname'},
{ data: 'dept_category_id'},
{ data: 'timeIN'},
{ data: 'timeOUT'},
{ data: 'date'},
{ data: 'time'},
{ data: 'action'}
],

});

$(document).on('click','#tables tr td a[title="Detail"]',function(e) {
var id = $(this).attr('data-role');

$.ajax({
url: id,
success: function(e) {
$("#modal-content").html(e);
}
});
});

@stop
