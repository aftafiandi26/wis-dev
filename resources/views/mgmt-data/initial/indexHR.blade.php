@extends('layout')

@section('title')
(hr) Initial Leave
@stop

@section('top')
@include('assets_css_1')
@include('assets_css_2')
@include('assets_css_4')
@stop

@section('navbar')
@include('navbar_top')
@include('navbar_left', [
'c1' => 'active'
])
@stop

@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Users</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div>
            <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>No</td>
                        <td>NIK</td>
                        <td>Employee</td>
                        <td>Department</td>
                        <td>Position</td>
                        <td>Exdo Balance</td>
                        <td style="width: 78px;">Action</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Entitlement Exdo Leave<sup><small>{{ date('Y') }}</small></sup></h1>
    </div>        
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="{{ route('hr/entitlement/exdo/index', [date('Y', strtotime('-1 year'))]) }}" class="btn btn-sm btn-default" style="margin-top: -20px;"><span class="fa fa-long-arrow-left"></span> {{ date('Y', strtotime('-1 year')) }}</a>
        <a href="{{ route('hr/entitlement/exdo/index', [date('Y', strtotime('+1 year'))]) }}" class="btn btn-sm btn-default" style="margin-top: -20px;">{{ date('Y', strtotime('+1 year')) }} <span class="fa fa-long-arrow-right"></span></a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div>
            <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables2">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>No</td>
                        <td>NIK</td>
                        <td>Employee</td>
                        <td>Department</td>
                        <td>Position</td>
                        <td>Entitlement</td>
                        <td>Leave Category</td>
                        <td>Expired</td>
                        <td>Created</td>
                        <td>Note</td>
                        <td style="width: 78px;">Action</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>



@stop

@section('bottom')
@include('assets_script_1')
@include('assets_script_2')
@include('assets_script_7')
@stop

@section('script')
$('[data-toggle="tooltip"]').tooltip();


$('#tables').DataTable({
processing: true,
responsive: true,
dom: 'Bfrtip',
buttons: [
'excel'
],
ajax: '{{ route('hr_mgmt-data/initial/getindexInitial') }}',
columns: [
{ data: 'DT_Row_Index', orderable: false, searchable : false},
{ data: 'nik'} ,
{ data: 'first_name'},
{ data: 'dept_category_id'},
{ data: 'position'},
{ data: 'exdo'},
{ data: 'actions'},
]

});


$('#tables2').DataTable({
processing: true,
responsive: true,
ajax: '{{ route('hr_mgmt-data/initial/getindexInitial2') }}',
columns: [
{ data: 'DT_Row_Index', orderable: false, searchable : false},
{ data: 'nik'} ,
{ data: 'fullName'},
{ data: 'dept_category_name'},
{ data: 'position'},
{ data: 'initial'},
{ data: 'leave_category_id'},
{ data: 'expired'},
{ data: 'note'},
{ data: 'note2'},
{ data: 'actions'},
],
dom: 'Bfrtip',
buttons: [
'excel'
]
});



@stop
