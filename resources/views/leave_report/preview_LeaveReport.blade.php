@extends('layout')

@section('title')
    Leave Entitled Report
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c4' => 'active'
    ])
@stop
@section('body')
<style type="text/css">
    th.dt-center, td.dt-center { text-align: center; }
</style>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Leave Entitled</h1>
        </div>
    </div>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-12">
    <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModal">Report</button>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">            
            <div>
                <table class="table table-striped table-bordered table-hover text-nowrap order-column table-condensed" width="100%" id="tables">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Department</th>
                            <th>Join<br>Contract</th>
                            <th>End<br>Contract</th>
                            <th>Entitled<br>Leave</th>
                            <th>Entitled<br>Day Off</th>
                            <th>Total Leave<br>and Day Off</th>
                            <th>Leave<br>Taken</th>
                            <th>Day Off<br>Taken</th>
                            <th>Total Leave<br>and Day Off Taken</th>
                            <th>Annual Leave<br>Balance</th>
                            <th>Day Off<br>Balance</th>
                            <th>Total Leave<br>and Day Off Balance</th>
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Download Leave Entitled Report</h4>
      </div>
      <div class="modal-body">
        <!-- <div class="row">
            <div class="col-lg-12">
                <form class="form-inline" action="{{route('hr_mgmt-data/storeGetleaveEntitledReport')}}" method="post">
                 {{ csrf_field() }}
                 <div class="form-group">
                     <label>Get Monthly: </label>
                 </div>
                <div class="form-group">
                    <input type="text" name="tahun" class="form-control" value="{{date('Y')}}" style="width:70px;" maxlength="4" required="true">
                    <select class="form-control" required="true" name="bulan">
                        <option value="">-select-</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">Marc</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <button class="btn btn-sm btn-primary" type="submit">Download</button>
                </div>
             </form>
            </div>
        </div> -->
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
                    <button class="btn btn-sm btn-primary" type="submit">Download</button>
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
    @include('assets_script_7')
@stop

@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({     
        "order": [
            [ 1, "asc" ]
        ],
       scrollY:        '500px',
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 1
          
        },   
         "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],   
        "dom": 'Blfrtip',
        "buttons": ['excel'],
        ajax: '{!! URL::route("hr_mgmt-data/getIndexLeaveEntitled") !!}',
      
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

