@extends('layout')

@section('title')
    Leave
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Leave Transactions Report</h1>
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-12 pull-right">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Generate</button>
        </div>
    </div>   
    <div class="row">
        <div class="col-lg-12">           
            <div>
            <table class="table table-striped table-hover" width="100%" id="tables">
                <thead>
                    <tr>
                       <th>ID</th>
                            <th>NIK</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Leave Category</th>
                            <th>Period</th>
                            <th>Leave Date</th>
                            <th>Total Day</th>
                           
                            <th style="width: 78px;">Action</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
 <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
        </div>
    </div>
  <!--  <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
              
                <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>         
        </div>
        <div class="modal-body">
          <h4>Are you sure want to <b>Cancel</b> ?</h4>
        </div>
        <div class="modal-footer">
        {!! Form::submit('Save', ['onclick' => 'myFunction', 'title' => 'Save', 'class' => 'btn btn-sm btn-success', 'data-toggle' => 'modal', 'data-target' => '#Save', 'method' => 'get', 'url' => '{{ URL::route(\'hr_mgmt-data/leaveTransactionReport/uncancel\', [$id]) }}'])!!}
        <a href="{{ url('hr_mgmt-data/leaveTransactionReport/{id}/cancel')}}" class="btn btn-success btn-sm">Y</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
           {!! Form::close() !!}
            </div>
        </div>
    </div>-->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Download Leave Transactions Reports</h4>
        </div>
        <div class="modal-body">
         <div class="row">
            <div class="col-lg-12">
                <form class="form-inline" action="{{route('hr_mgmt-data/storeGetleaveEntitledReportDaily')}}" method="post">
                 {{ csrf_field() }}
                 <div class="form-group">
                     <label>Get Data: </label>
                 </div>
                <div class="form-group">
                    <input type="date" name="awal" class="form-control" value="{{date('Y-m-d')}}" required="true" autofocus="true" autosave="true">
                    <input type="date" name="akhir" class="form-control" value="{{date('Y-m-d')}}" required="true" autosave="true">
                    <button class="btn btn-sm btn-primary" type="submit"><span class="glyphicon glyphicon-download-alt"></span></button>
                </div>
             </form>
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
@stop

@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [ 0, "des" ]
        ],
        
        responsive: true,        
        ajax: '{!! URL::route("hr_mgmt-data/getIndexLeaveTransactionReport") !!}'
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