@extends('layout')

@section('title')
    (dev) - Statment Leave Progress
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1232' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-6">
            <h1 class="page-header">Statment Progress</h1>           
    </div>
</div>

<div class="row">          
       <div class="col-lg-12 table-sm table-responsive">
            <table id="statmentProgress" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Emp Stat</th>
                            <th>Advance Leave</th>
                            <th>Annual Leave</th>
                            <th>Remains Forfeit</th>
                            <th>Total Day Proccess</th>
                        </tr>
                    </thead>            
            </table> 
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
$('#statmentProgress').DataTable({
    processing: true,
    ajax: '{{ route('dev/dataStatmentLeavePrograess') }}',
    columns: [
                { data: 'DT_Row_Index', orderable: false, searchable : false},    
                { data: 'first_name'},
                { data: 'dept_category_id'},
                { data: 'emp_status'},
                { data: 'initial_leave'},
                { data: 'available'},
                { data: 'remainForfeit'},
                { data: 'leaveonProgress'}
             ],
    dom: 'Bfrtip',
    buttons: [
             'excel'
            ]                 
});
@stop