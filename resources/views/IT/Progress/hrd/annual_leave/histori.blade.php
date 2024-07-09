@extends('layout')

@section('title')
    (dev) - History Leave
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
        'c1233' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-6">
            <h1 class="page-header">History Leave</h1>           
    </div>
</div>

<div class="row">          
       <div class="col-lg-12 table-sm">
            <table id="HistoryLeave" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Leave Category</th>
                            <th>Start Leave</th>
                            <th>End Leave</th>
                            <th>Total Day</th>
                            <th>Status</th>
                            <th>Actions</th>
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
$('#HistoryLeave').DataTable({
    processing: true,
    responsive: true,
    ajax: '{{ route('dev/histori/leave/data') }}',
    columns: [
                { data: 'DT_Row_Index', orderable: false, searchable : false},                
                { data: 'request_nik'},  
                { data: 'user_id'}, 
                { data: 'request_dept_category_name'}, 
                { data: 'request_position'}, 
                { data: 'leave_category_id'}, 
                { data: 'leave_date'}, 
                { data: 'end_leave_date'}, 
                { data: 'total_day'},
                { data: 'status'},
                { data: 'actions'}     
             ],
    dom: 'Bfrtip',
    buttons: [
             'excel'
            ]                 
});
@stop