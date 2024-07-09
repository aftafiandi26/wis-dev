@extends('layout')

@section('title')
    (hr) Undesired Food
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
@section('body')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<div class="container-fluid"> 
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Canteen Assessment Report</h1>
        </div>
    </div>
  
    <div class="row">
        <div class="col-lg-12">            
            <div>
               <p><label><h3 style="text-align: center;">Undesired Food</h3></label></p>
                <table class="table table-striped table-bordered table-hover text-nowrap" style="font-size: 13px;" width="100%" id="tables">
                    <thead>
                        <tr>
                        <th>ID</th>                                                    
                            <th style="text-align: center;">NIK</th>
                            <th style="text-align: center;">Name Employee</th>
                            <th style="text-align: center;">Department</th>                           
                            <th style="text-align: center;">Main Of Dishes</th>
                            <th style="text-align: center;">Vegetables</th>
                            <th style="text-align: center;">Slide Of Dishes</th>
                            <th style="text-align: center;">Date Entry</th>                                           
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
@stop
@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "fixedHeader": {
            header: true,
            footer: true
        },
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [ 2, "asc" ]
        ],
        "processing": true,
        "scrollX": true,
        "dom": 'Blfrtip',
        "buttons": [{
                extend:    "excelHtml5",
                text:      "Excel",
                titleAttr: "Download",
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6]
                }              
               
            }],
        ajax: '{!! URL::route("getVotingCanteenUndesiredFood") !!}'
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
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
