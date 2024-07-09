@extends('layout')

@section('title')
Transportaion
@stop

@section('top')
@include('assets_css_1')
@include('assets_css_2')
@stop

@section('navbar')
@include('navbar_top')
@include('navbar_left', [
'c33' => 'active'
])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Summary Leave of Facility</h1>       
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table id="tables" class="table table-striped table-bordered table-condensed" border="1" width="100%">
            <thead>
                <tr>
                    <th>Nik</th>
                    <th>Leave Category</th>
                    <th>Employee</th>
                    <th>Position</th>
                    <th>Leave Date</th>
                    <th>End Leave Date</th>
                    <th>Total Day</th>
                    <th>HoD Approval</th>
                    <th>HR Verify</th>
                    <th>HR Approval</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
$('[data-toggle="tooltip"]').tooltip();

$('#tables').DataTable({
   
    processing: true,
    responsive: true,      
     "dom": 'Blfrtip', 
     
    ajax: '{!! URL::route("facilities/admin/verify/data") !!}',
    columns: [
                { data: 'request_nik'},
                { data: 'leave_category_name'},
                { data: 'request_by'},
                { data: 'position'},
                { data: 'leave_date'},
                { data: 'end_leave_date'},
                { data: 'total_day'},
                { data: 'ap_hd'},
                { data: 'ver_hr'},
                { data: 'ap_hrd'},
                { data: 'action'}
            
            ]
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