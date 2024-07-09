@extends('layout')

@section('title')
HR - Fingerspot Management
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
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Fingerspot Management</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered table-condensed table-hover" id="emp" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>PIN</th>
                    <th>NIK</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Department</th>
                    <th>lastupdate_date</th>
                </tr>
            </thead>           
        </table>
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

$('table#emp').DataTable({   
        processing: true,
        responsive: true,   
            
        ajax: '{{ route('hr\lobby\attendance\data') }}',
        columns: 
        [  
            { data: 'DT_Row_Index', searchable : false},
            { data: 'pin'},
            { data: 'nik'},
            { data: 'first_name'},
            { data: 'last_name'},
            { data: 'func_id_auto'},
            { data: 'lastupdate_date'}                        
        ],
        dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
});   
@stop
