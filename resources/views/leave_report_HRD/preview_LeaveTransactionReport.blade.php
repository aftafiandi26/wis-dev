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
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Leave Transactions Report</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div align="right">
                <!-- <a style="margin-bottom: 15px;" class="btn btn-sm btn-primary" data-original-title="Add" data-toggle="tooltip" data-placement="top" href="{!! URL::route('mgmt-data/user/create') !!}"><span class="fa fa-plus"></span></a> -->
            </div>
            
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