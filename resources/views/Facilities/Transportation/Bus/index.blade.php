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
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Booking Transportation</h1> 
    </div>
</div>
<div class="row" style="margin-bottom: 10px;">
  <form id="joinForm" class="form-group">
         <div class="col-lg-12" class="form-group">
            <label>Search Date:</label>
         </div>
        <div class="col-lg-2" class="form-group">
            <input type="date" id="min" name="min" class="form-control">          
        </div>        
        <div class="col-lg-2" class="form-group">
            <input type="date" id="max" name="max" class="form-control">     
        </div>
         <div class="col-lg-2" class="form-group">          
           <button type="reset" class="btn btn-sm btn-success" onclick="location.reload()">Reset</button>
        </div>
  </form>
</div>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-lg-12">
          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Lock">Locked</button>
          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Email">Email</button>
          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Excel">Excel</button>
          <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#Generate">Generate</button>
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Search">Search</button>
    </div>
</div>
<div class="row">
  <div class="col-lg-12"> 
    <h3>Dormitory To Studio</h3>
     <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Destination</th> 
                        <th>Cretead</th>
                        <th>Status</th>     
                        <th>Action</th>            
                    </tr>
                </thead>
            </table>
  </div>
</div>
<hr>
<div class="row">
  <h3>From Studio To Dormitory</h3>
  <div class="col-lg-12"> 
     <table class="table table-striped table-bordered table-hover" width="100%" id="tables1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Destination</th> 
                        <th>Cretead</th>
                        <th>Status</th>     
                        <th>Action</th>            
                    </tr>
                </thead>
            </table>
  </div>
</div>

  <div class="modal fade" id="Lock" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Lock Transaction</h4>
        </div>
        <div class="modal-body">
     <form action="{{route('locked_Transportations')}}" method="POST">
         {{ csrf_field() }}
          <p>Do you want to lock on transportation transactions?</p>
          <select class="form-control" name="selectdeparture" title="select departure">
            <option value="">-departure-</option>
            <option value="1">Dormitory To Studio</option>
            <option value="2">From Studio To Dormitory</option>
          </select>
          <br>
          <p>Date :</p>
          <input type="date" name="dated" class="form-control" value="{{date('Y-m-d')}}">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-danger">Lock</button>       
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
       </form>
        </div>
      </div>
    </div>
  </div>

    <div class="modal fade" id="Email" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Email</h4>
        </div>
        <form action="{{route('sendEmailTransportation')}}" method="POST">
           {{ csrf_field() }}
        <div class="modal-body">
         <div>         
            <div class="input-group">
              <span class="input-group-addon"><i class="material-icons" data-toggle="tooltip" title="input date you want" data-placement="left">&#xe916;</i></span>
              <input id="date" type="date" class="form-control" name="date" value="{{date('Y-m-d')}}" data-toggle="tooltip" title="input date you want" data-placement="top" required="true" autofocus="true">
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="material-icons" data-toggle="tooltip" title="Choose departure you want" data-placement="left">&#xe896;</i></span>              
              <select class="form-control" name="destination" id="destination" data-toggle="tooltip" title="Choose departure you want" data-placement="bottom" required="true" autofocus="true"> 
                <option value="">-select departure-</option>
                <option value="2">From Studio To Dormitory</option>
                <option value="1">Dormitory To Studio</option>
              </select>
            </div>
            <br>            
         </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-info" data-toggle="tooltip" title="Sending email" data-placement="left">Send</button>       
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
       </form>
        </div>
      </div>
    </div>
  </div>
  </div>

  <div class="modal fade" id="Excel" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Download</h4>
        </div>
        <form action="{{route('ExcelTransportation')}}" method="POST">
           {{ csrf_field() }}
         <div class="modal-body">
         <div>         
            <div class="input-group">
              <span class="input-group-addon"><i class="material-icons" data-toggle="tooltip" title="input date you want" data-placement="left">&#xe916;</i></span>
              <input id="date" type="date" class="form-control" name="date" value="{{date('Y-m-d')}}" data-toggle="tooltip" title="input date you want" data-placement="top" required="true" autofocus="true">
            </div>
             <div class="input-group">
              <span class="input-group-addon"><i class="material-icons" data-toggle="tooltip" title="input date you want" data-placement="left">&#xe916;</i></span>
              <input id="date" type="date" class="form-control" name="dateet" value="{{date('Y-m-d')}}" data-toggle="tooltip" title="input date you want" data-placement="top" required="true" autofocus="true">
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="material-icons" data-toggle="tooltip" title="Choose departure you want" data-placement="left">&#xe896;</i></span>              
              <select class="form-control" name="destination" id="destination" data-toggle="tooltip" title="Choose departure you want" data-placement="bottom" required="true" autofocus="true"> 
                <option value="">-select departure-</option>
                <option value="2">From Studio To Dormitory</option>
                <option value="1">Dormitory To Studio</option>
              </select>
            </div>
            <br>            
         </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-info">Send</button>       
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
       </form>
        </div>
      </div>
    </div>
  </div>
  </div>

  <div class="modal fade" id="Generate" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Generate List Transportation</h4>
        </div>
        <div class="modal-body">
         <form action="{{route('GenerateExcelTransportasi')}}" method="post">
            {{ csrf_field() }}
            <div class="input-group">
              <span  class="input-group-addon">Start Date</span>
              <input id="start" type="date" class="form-control" name="start" value="{{date('Y-m-d')}}" data-toggle="tooltip" title="input date you want" data-placement="top" required="true" autofocus="true">
            </div>
             <div class="input-group">
              <span class="input-group-addon">End Date</span>
              <input id="end" type="date" class="form-control" name="end" value="{{date('Y-m-d')}}" data-toggle="tooltip" title="input date you want" data-placement="top" required="true" autofocus="true">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-info">Generate</button>
           </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="Search" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Search List Transportation</h4>
        </div>
        <div class="modal-body">
         <form action="{{route('searchListTransportation')}}" method="get">
            {{ csrf_field() }}
            <div class="input-group">
              <span  class="input-group-addon">Start Date</span>
              <input id="start" type="date" class="form-control" name="start" value="{{date('Y-m-d')}}" data-toggle="tooltip" title="input date you want" data-placement="top" required="true" autofocus="true">
            </div>
             <div class="input-group">
              <span class="input-group-addon">End Date</span>
              <input id="end" type="date" class="form-control" name="end" value="{{date('Y-m-d')}}" data-toggle="tooltip" title="input date you want" data-placement="top" required="true" autofocus="true">
            </div>
            <br>         
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-info">Generate</button>
           </form>
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
<script src="https://cdn.datatables.net/plug-ins/1.10.19/filtering/row-based/range_dates.js"></script>
@section('script') 
    $('[data-toggle="tooltip"]').tooltip();        

$.fn.dataTableExt.afnFiltering.push(
    function( oSettings, aData, iDataIndex ) {
        var iFini = document.getElementById('min').value;
        var iFfin = document.getElementById('max').value;
        var iStartDateCol = 4;
        var iEndDateCol = 4;
 
        iFini=iFini.substring(6,10) + iFini.substring(3,5)+ iFini.substring(0,2);
        iFfin=iFfin.substring(6,10) + iFfin.substring(3,5)+ iFfin.substring(0,2);
 
        var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
        var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
 
        <!-- console.log(iFini); -->

        if ( iFini === "" && iFfin === "" )
        {
            return true;
        }
        else if ( iFini <= datofini && iFfin === "")
        {
            return true;
        }
        else if ( iFfin >= datoffin && iFini === "")
        {
            return true;
        }
        else if (iFini <= datofini && iFfin >= datoffin)
        {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {
    var table = $('#tables').DataTable();   
 
    $('#min, #max').keyup( function() {
        table.draw();
    } );
} );
$(document).ready(function() {
    var table = $('#tables1').DataTable();   
 
    $('#min, #max').keyup( function() {
        table.draw();
    } );
} );

    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
      "order": [
        [ 0, "des" ]
      ],
        processing: true,
        responsive: true,        
        ajax: '{!! URL::route("getINdexTransaction") !!}'
    });

     $('#tables1').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
      "order": [
        [ 0, "des" ]
      ],
        processing: true,
        responsive: true,
          
        ajax: '{!! URL::route("getINdexTransaction1") !!}'
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