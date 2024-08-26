@extends('layout')

@section('title')
    (hr) Attendance
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c30003' => 'active'
    ])
@stop

@push('style')
<style>
    a#edit {
        border-radius: 10px;
        background-color: rgb(252, 252, 8);
        color: black;
    }
    a#edit:hover {
        border-radius: 10px;
        background-color: rgb(216, 216, 51);
        color: rgb(62, 58, 58);
    }
    a#delete {
        border-radius: 10px;
        background-color: red;;
        color: white;
    }
    a#delete:hover {
        border-radius: 10px;
        background-color: rgb(181, 15, 15);
        color: whitesmoke;
    }
    a#find, button#pushFind {
        border-radius: 10px;
        background-color: skyblue;
        color: black;
    }
    a#find:hover, button#pushFind:hover {
        border-radius: 10px;
        background-color: rgb(126, 186, 210);
        color: black;
    }
    a#add {
        border-radius: 10px;
        background-color: skyblue;
        color: black;
    }
    a#add:hover {
        border-radius: 10px;
        background-color: rgb(114, 173, 196);
        color: rgb(92, 90, 90);
    }
    a#reset {
        border-radius: 10px;
        background-color: lightcyan;
        color: black;
    }
    a#reset:hover {
        border-radius: 10px;
        background-color: cyan;
        color: lightcyan;
    }
    .mb-10 {
        margin-bottom: 10px;
    }
    .ml-3 {
        margin-right: 5px;
    }

    a#chart {
        border-radius: 10px;
        background-color: darkgoldenrod;
        color: white;
    }

    a#chart:hover {
        border-radius: 10px;
        background-color:rgb(241, 177, 17);
        color: black;
    }
    button.submitFormChart {
        border-radius: 10px;
        background-color: greenyellow;
        color: black;
    }

    button.submitFormChart:hover {
        border-radius: 10px;
        background-color:rgb(241, 177, 17);
        color: black;
    }
    .btn-dafault {
        border-radius: 10px;
    }
</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Summary Attendance</h1>
    </div>
</div>

<div class="row mb-10">
    <div class="col-lg-12">
        <div class="col-lg-6">
            <form class="form-inline">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group">
                        <label for="date">Date: </label>
                        <input type="date" name="dateStarted" id="dateStarted" class="form-control"> -
                        <input type="date" name="dateEnded" id="dateEnded" class="form-control">
                        <a class="btn btn-sm btn-default" id="find">find</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <a class="btn btn-sm btn-default pull-right" id="add"  data-toggle="modal" data-target="#modalAdd" title="Insert attendance" >Add</a>        
            <a class="btn btn-sm btn-default pull-right ml-3" id="chart"  data-toggle="modal" data-target="#modalChart" title="chart attendance" >Chart</a>        
        </div>
    </div>
</div>

<div class="row mb-10">
    <div class="col-lg-12">
        <form action="{{ route('hr/summary/attendance/summary/employes/convert') }}"  class="form-inline" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="employee">Employes: </label>
                <select name="emp" id="selectEmp" required>
                    <option></option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->getFullName() }}</option>
                    @endforeach
                </select>
                <input type="date" name="empStarted" id="empDateStarted" class="form-control" required>
                -
                <input type="date" name="empEnded" id="empDateEnded" class="form-control" required>
                <button type="submit" class="btn btn-sm btn-default" id="pushFind">find</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-hover table-striped table-bordered" id="tables" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Employes</th>
                    <th>Departmen</th>
                    <th>Date</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Total Time</th>
                    <th>Status</th>
                    <th>Actions</th>                    
                </tr>
            </thead>
        </table>
    </div>
</div>


    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content-edit">
                <!--  -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content-delete">
                <!--  -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('hr/summary/attendance/insert') }}" method="post">
                    {{ csrf_field() }}
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                        <h4 class='modal-title text-center' id='showModalLabel'>Insert Attendance</h4>
                    </div>
                    <div class='modal-body'>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="employes">Employes:</label> 
                                    <select name="employes" id="employes" class="form-control" required>
                                        <option value=""></option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->getFullName() }}</option>
                                        @endforeach
                                    </select>
                                </div>                              
                                <div class="form-group">
                                    <label for="start">Check In:</label>
                                    <input type="datetime-local" name="start" id="start" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="end">Check Out:</label>
                                    <input type="datetime-local" name="end" id="end" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="status">Work From...</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="">- choose -</option>
                                        <option value="wfs">WFS</option>
                                        <option value="wfh">WFh</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="remarks">Note</label>
                                    <textarea name="remarks" id="remarks" cols="30" rows="10" placeholder="type hit.." class="form-control text-lowercase"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-sm btn-success'>Insert</button>
                        <button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button>
                    </div>    
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalChart" tabindex="-1" role="dialog" aria-labelledby="showModalLabelChart" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content-modals">
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title text-center' id='showModalLabelChart'>Chart Attendance</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('hr/summary/attendance/chart/get') }}" method="post" class="form-inline" id="formChart">
                                {{ csrf_field() }}
                                <div class="form-grop">
                                    <label for="date">date:</label>
                                    <input type="date" name="start" id="" class="form-control">
                                    -
                                    <input type="date" name="end" id="" class="form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default submitFormChart" id="submitFormChart">Submit</button>
                    <button type="button" class="btn btn-sm btn-dafault" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_7')
@stop

@section('script')
$('#modalAdd').on('shown.bs.modal', function () {   
    $('select#employes').select2({
        placeholder: 'please a employee'
    });
    $('.select2-search__field').focus();
});
$('select#selectEmp').select2();

$('table#tables').DataTable({
    processing: true, 
    responsive: true,  
    "dom": 'Blfrtip',
    "buttons": [{
            extend:    'excel',
            text:      'Excel',
            titleAttr: 'Attendance',
            title: 'Attendance'
    }],  
    ajax: '{{ route('hr/summary/attendance/datatables') }}',
    columns: [
            {"data": "DT_Row_Index", orderable: false, searchable : false},  
            {"data": 'nik', orderable: false, searchable : false},
            {"data": 'employes'},
            {"data": 'department'},
            {"data": 'dateStart'},
            {"data": 'timeStart'},
            {"data": 'timeEnded'},
            {"data": 'durations'},
            {"data": 'status_in'},
            {"data": 'actions'},
        ]
});
$(document).on('click','#tables tr td a[id="edit"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-edit").html(e);
        }
    });
});

$(document).on('click','#tables tr td a[id="delete"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-delete").html(e);
        }
    });
});


$('input#dateStarted').on('change', function () {
    var dated = $(this).val();

    var tanggalKedaluwarsa = new Date();
    tanggalKedaluwarsa.setTime(tanggalKedaluwarsa.getTime() + (4 * 60 * 60 * 1000)); // 1 menit dalam milidetik

    var kedaluwarsa = "expires=" + tanggalKedaluwarsa.toUTCString();
    document.cookie = "date-time-start=" + encodeURIComponent(dated) + "; " + kedaluwarsa + "; path=/"; 
});

$('input#dateEnded').on('change', function () {
    var dated = $(this).val();

    var tanggalKedaluwarsa = new Date();
    tanggalKedaluwarsa.setTime(tanggalKedaluwarsa.getTime() + (4 * 60 * 60 * 1000)); // 1 menit dalam milidetik

    var kedaluwarsa = "expires=" + tanggalKedaluwarsa.toUTCString();
    document.cookie = "date-time-end=" + encodeURIComponent(dated) + "; " + kedaluwarsa + "; path=/"; 
});

$('a#find').on('click', function() {
    var dateStarted = document.getElementById('dateStarted').value;
    var dateEnded = document.getElementById('dateEnded').value;
    
    var started = new Date(dateStarted);
    var ended = new Date(dateEnded); 
    
    if (started > ended) {
        window.alert('Please check your date');      
        return;
    }

    location.reload();
    
});

function getCookie(cookieName) {
    var name = cookieName + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookieArray = decodedCookie.split(';');
    for(var i = 0; i < cookieArray.length; i++) {
        var cookie = cookieArray[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }
        if (cookie.indexOf(name) === 0) {
            return cookie.substring(name.length, cookie.length);
        }
    }
    return "";
}

function deleteCookie(cookieName) {
    document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

document.getElementById('dateStarted').value = getCookie('date-time-start');
document.getElementById('dateEnded').value = getCookie('date-time-end');


document.getElementById('submitFormChart').addEventListener('click', function() {
    $('form#formChart').submit();
});

@stop
