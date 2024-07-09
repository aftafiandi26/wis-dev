@extends('layout')

@section('title')
    (hr) Summary Verifeid
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@section('body')
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Historical</h1> 
    </div>
</div> 
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('getDataExcelHistorical', [$started, $ended]) }}" method="post">
             {{ csrf_field() }}
            <button class="btn btn-sm btn-primary" type="submit">Excel</button>           
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-sm table-striped table-bordered table-hover table-confidend" width="100%" id="tables">
            <thead>
            	<tr>
            		<th>No</th>
            		<th>Leave Category</th>
            		<th>Nik</th>
            		<th>Name</th>
            		<th>Department</th>
            		<th>Position</th>
            		<th>Start Date</th>
            		<th>End Date</th>
            		<th>Back to Work</th>
            		<th>Status</th>            		
            	</tr>            
            </thead>
            <tbody>
                <?php foreach ($leave as $data): ?>
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->leave_category_name }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->first_name.' '.$data->last_name }}</td>
                        <td>{{ $data->request_dept_category_name }}</td>
                        <td>{{ $data->request_position }}</td>
                        <td>{{ $data->leave_date }}</td>
                        <td>{{ $data->end_leave_date }}</td>
                        <td>{{ $data->back_work }}</td>
                        <td>
                            <?php if ($data->ap_hrd === 1): ?>
                                Confirmed
                            <?php elseif ($data->ap_hrd === 0): ?>
                               Pending
                            <?php else: ?>
                                Disapproved
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
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
    $('#tables').DataTable();  
   
@stop
