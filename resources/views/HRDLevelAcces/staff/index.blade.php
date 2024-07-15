@extends('layout')

@section('title')
(hr) Data Employee
@stop

@section('top')
@include('assets_css_1')
@include('assets_css_2')
@include('assets_css_4')
@stop

@section('navbar')
@include('navbar_top')
@include('navbar_left', [
'c3' => 'active'
])
@stop

@push('css')
    <style>

    </style>
@endpush

@section('body')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.uikit.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Employee</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div align="right">
            <a style="margin-bottom: 13px; text-align: left; width: 120px" class="btn btn-sm btn-primary" data-original-title="Add Data Employee" data-toggle="tooltip" data-placement="top" href="{!! URL::route('addEmployee') !!}"><span class="fa fa-user-plus"> New Employeee</span></a>
        </div>
    </div>
    <div class="col-lg-12">
        <div align="right">
            <a style="margin-bottom: 13px; text-align: left; width: 120px" class="btn btn-sm btn-danger" data-original-title="Go to Import Data" data-toggle="tooltip" data-placement="top" href="{!! URL::route('Upload/Employee') !!}"><span class="fa fa-upload"> Import Excel</span></a>
        </div>
    </div>
    <hr class="my-5">
</div>

<div class="row">
    <!--  <div class="col-lg-12"  id="myDIV">
        <button onclick="myFunction()">Try it</button>      
    </div> -->
    <div class="col-lg-12">
        <form id="joinForm" class="form-group">
            <div class="col-lg-12" class="form-group">
                <label>Searched : Join Date</label>
            </div>
            <div class="col-lg-2" class="form-group">
                <input type="date" id="min" name="min" class="form-control">
            </div>
            <div class="col-lg-2" class="form-group">
                <input type="date" id="max" name="max" class="form-control">
            </div>
            <div class="col-lg-2" class="form-group">
                <button type="reset" class="btn btn-sm btn-success" onclick="deasdasdasd()">Reset</button>

            </div>
        </form>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <form id="endForm" class="form-group">
            <div class="col-lg-12" class="form-group">
                <label>Searched : End Date</label>
            </div>
            <div class="col-lg-2" class="form-group">
                <input type="date" id="minn" name="minn" class="form-control">
            </div>
            <div class="col-lg-2" class="form-group">
                <input type="date" id="maxx" name="maxx" class="form-control">
            </div>
            <div class="col-lg-2" class="form-group">
                <button type="reset" class="btn btn-sm btn-success" onclick="deasdasdasd()">Reset</button>
            </div>
        </form>
    </div>
</div>

<hr class="my-5">
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Join Date</th>
                    <th>End Date</th>
                    <th>NIK</th>
                    <th>First<br>Name</th>
                    <th>Last<br>Name</th>
                    <th>Gender</th>
                    <th>Department</th>
                    <th>Place<br>Birth</th>
                    <th>Birth Date</th>
                    <th>Position</th>
                    <th>Education</th>
                    <th>Education Institution</th>
                    <th>Employee<br>Status</th>
                    <th>Phone</th>
                    <th>Religion</th>
                    <th>Annual</th>
                    <th>Exdo</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>BPJS Kesehatan</th>
                    <th>BPJS Ketenagakerjaan</th>
                    <th>ID Card</th>
                    <th>NPWP</th>
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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/filtering/row-based/range_dates.js"></script>
<script>
    function myFunction() {
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function deasdasdasd() {
        location.reload();
    }
</script>
@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $.fn.dataTableExt.afnFiltering.push(
        function( oSettings, aData, iDataIndex ) {
        var iFini = document.getElementById('min').value;
        var iFfin = document.getElementById('max').value;
        var iStartDateCol = 1;
        var iEndDateCol = 1;

        iFini=iFini.substring(0,4) + iFini.substring(4,5)+ iFini.substring(5,10);
        iFfin=iFfin.substring(0,4) + iFfin.substring(4,5)+ iFfin.substring(5,10);

        var datofini=aData[iStartDateCol].substring(0,4) + aData[iStartDateCol].substring(4,5)+ aData[iStartDateCol].substring(5,10);
        var datoffin=aData[iEndDateCol].substring(0,4) + aData[iEndDateCol].substring(4,5)+ aData[iEndDateCol].substring(5,10);

        <!-- console.log(iFini); -->

        if ( iFini === "" && iFfin === "" )
        {
            return true;
        } else if ( iFini <= datofini && iFfin==="" ) { return true; } else if ( iFfin>= datoffin && iFini === "") {
            return true;
        } else if (iFini <= datofini && iFfin>= datoffin) {
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

    $.fn.dataTableExt.afnFiltering.push(function( oSettings, aData, iDataIndex ) {
        var iFini = document.getElementById('minn').value;
        var iFfin = document.getElementById('maxx').value;
        var iStartDateCol = 2;
        var iEndDateCol = 2;

        iFini=iFini.substring(0,4) + iFini.substring(4,5)+ iFini.substring(5,10);
        iFfin=iFfin.substring(0,4) + iFfin.substring(4,5)+ iFfin.substring(5,10);

        var datofini=aData[iStartDateCol].substring(0,4) + aData[iStartDateCol].substring(4,5)+ aData[iStartDateCol].substring(5,10);
        var datoffin=aData[iEndDateCol].substring(0,4) + aData[iEndDateCol].substring(4,5)+ aData[iEndDateCol].substring(5,10);

        if ( iFini === "" && iFfin === "" )  {
            return true;
        }  else if ( iFini <= datofini && iFfin==="" ) { return true; } else if ( iFfin>= datoffin && iFini === "") {
            return true;
        } else if (iFini <= datofini && iFfin>= datoffin) {
            return true;
        } 
        
        return false;
        }
    );

    $(document).ready(function() {
        var table = $('#tables').DataTable();
        $('#minn, #maxx').keyup( function() {
            table.draw();
        } );
    } );
    
    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [4, "asc" ]
        ],
        processing: true,
        responsive: true,
        "dom": 'Blfrtip',
            "buttons": [{
                extend: 'excelHtml5',
                text: '<i class="glyphicon glyphicon-download-alt" style="font-size: 18px;"></i>',
                titleAttr: 'Generate Data Employee',
            }],
        ajax: '{!! URL::route("getEmployee") !!}' ,
    });

    $('#tables').css('font-size', '14px');

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