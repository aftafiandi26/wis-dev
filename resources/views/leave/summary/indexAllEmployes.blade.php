@extends('layout')

@section('title')
Leave Summary for All Employes
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
            <h1 class="page-header">Leave Summary for All Employes <sup>({{ date('Y') }})</sup></h1>           
    </div>  
</div>
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('leave/summary/employes/request') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="date">Search:</label>
                <select name="select" id="date" class="form-control" required>
                    <option value="all">-department-</option>
                    @foreach ($department as $dept)
                       <option value="{{ $dept->dept_category_name }}">{{ $dept->dept_category_name }}</option> 
                    @endforeach
                </select>
                <input type="date" name="startDate" id="date" class="form-control" required>
                <input type="date" name="endDate" id="date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-sm btn-default"><span class="fa fa-search"></span></button>   
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="{{ route('leave/calender/index') }}" class="btn btn-sm btn-default">calender</a>
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables">
            <thead>
                <tr>
                    <td>No</td>                  
                    <td>Name</td>
                    <td>Position</td>
                    <td>Department</td>
                    <td>Leave Category</td>
                    <td>Start Date</td>
                    <td>End Date</td>
                    <td>Back To Work</td>   
                    <td>Total Day</td>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content" id="modal-content">
            <!--  -->
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
$('#tables').DataTable({
        
    processing: true, 
    responsive: true, 
    dom: 'Bfrtip',
    buttons: [
       'excel'
    ],     
    ajax: '{!! URL::route("leave/summary/employes/object") !!}',
    columns: [
                { data: 'DT_Row_Index', orderable: false, searchable : false},
                { data: 'request_by'},
                { data: 'request_position'},
                { data: 'request_dept_category_name'},
                { data: 'leave_category_id'},
                { data: 'leave_date'},
                { data: 'end_leave_date'},
                { data: 'back_work'},   
                { data: 'total_day'},               
            ],
});

$(document).on('click','#tables tr td a[id="info"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content").html(e);
        }
    });
});
@stop
