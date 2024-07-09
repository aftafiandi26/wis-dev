@extends('layout')

@section('title')
    (dev) - encounter forfeit
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
        'c123' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-6">
            <h1 class="page-header">Employee Forfeited</h1>           
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
       <form method="post" action="{{ route('forfeited/upload') }}">
            {{ csrf_field() }}
           <button class="btn-sm btn-danger pull-right" type="submit">Counter</button>            
       </form>
       <br>
    </div>
</div>
<div class="row">          
       <div class="col-lg-12">
            <table id="employeeData" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Total Forfeit</th>
                            <th>Annual Available</th>
                            <th>Total Annual</th>
                            <th>Action</th>
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
$('#employeeData').DataTable({
    processing: true,
    responsive: true,
    ajax: '{{ route('forfeited/data') }}',
    columns: [
                { data: 'DT_Row_Index', orderable: false, searchable : false},                
                { data: 'nik'},  
                { data: 'first_name'}, 
                { data: 'dept'}, 
                { data: 'emp_status'}, 
                { data: 'forfeited'}, 
                { data: 'available'}, 
                { data: 'advancedLeave'},
                { data: 'actions'}      
             ],
    dom: 'Bfrtip',
    buttons: [
             'excel'
            ]                 
});
@stop