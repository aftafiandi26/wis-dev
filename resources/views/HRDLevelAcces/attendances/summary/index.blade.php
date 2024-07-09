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
        'c3' => 'active'
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
    button#pushFind  {
        border-radius: 10px;
        background-color: skyblue;
        color: black;
    }
    div.form-group a.btn-default {
        border-radius: 10px;        
    }
    div.form-group a.btn-default:hover {
        border-radius: 10px;
        background-color: rgb(95, 102, 106);
        color: whitesmoke;
    }
    button#pushFind:hover,  {
        border-radius: 10px;
        background-color: rgb(126, 186, 210);
        color: black;
    }   
    .mb-10 {
        margin-bottom: 10px;
    }
</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ $emp->getFullName() }} Attendances</h1>
    </div>
</div>

<div class="row mb-10">
    <div class="col-lg-12">
        <form action="{{ route('hr/summary/attendance/summary/employes/convert') }}" class="form-inline" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="employee">Employes: </label>
                <select name="emp" id="findEmp">
                    <option></option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if ($user->id == $emp->id)
                            selected
                        @endif>{{ $user->getFullName() }}</option>
                    @endforeach
                </select>
                <input type="date" name="empStarted" id="empDateStarted" class="form-control" value="{{ $dataArray[1] }}">
                -
                <input type="date" name="empEnded" id="empDateEnded" class="form-control" value="{{ $dataArray[2] }}">
                <button type="submit" class="btn btn-sm btn-default" id="pushFind">find</button>
                <a href="{{ route('hr/summary/attendance/index') }}" class="btn btn-default btn-sm">back</a>
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

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_7')
@stop

@section('script')
$('select#findEmp').select2();

$('table#tables').DataTable({
    "processing": true, 
    "responsive": true,
    "ajax": "{{ route('hr/summary/attendance/summary/employes/data', [$dataArray[0], $dataArray[1], $dataArray[2]]) }}",     
    "columns": [
            {"data": "DT_Row_Index", orderable: false, searchable : false},
            {"data": "nik"},
            {"data": "fullname"},
            {"data": "dept"},
            {"data": "dated"},
            {"data": "checkIn"},
            {"data": "checkOut"},
            {"data": "time"},
            {"data": "actions"},
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

    console.log(id);

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-delete").html(e);
        }
    });
});

@stop
