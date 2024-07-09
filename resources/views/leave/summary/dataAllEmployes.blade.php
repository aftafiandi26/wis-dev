@extends('layout')

@section('title')
Summary of Leave - All Employes
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
            <h1 class="page-header">Summary of Leave <sup>(All Employes)</sup></h1>           
    </div>  
</div>

<div class="row">
  <div class="col-lg-12">
    <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
      <thead>
        <tr>
            <td>No</td>
            <td>NIK</td>
            <td>Name</td>
            <td>Leave Category</td>
            <td>Position</td>
            <td>Start Date</td>
            <td>End Date</td>
            <td>Back To Work</td>
            <td>Koordinator<br>Aprroval</td>                       
            <td>HD<br> Approval</td> 
            <td>HR<br>Verification</td> 
            <td>HRD Approval</td>     
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
    $('#tables').DataTable({
        
        processing: true, 
        responsive: true,        
        ajax: '{!! URL::route("leave/summary/employes/object") !!}',
        columns: [
                  { data: 'DT_Row_Index', orderable: false, searchable : false},
                  { data: 'request_nik'},
                  { data: 'request_by'},
                  { data: 'request_position'},
                  { data: 'leave_category_id'},
                  { data: 'leave_date'},
                  { data: 'end_leave_date'},
                  { data: 'back_work'},
                  { data: 'ap_koor'},
                  { data: 'ap_spv'}
                ],
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
