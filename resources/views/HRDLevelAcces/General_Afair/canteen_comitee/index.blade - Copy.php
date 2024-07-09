@extends('layout')

@section('title')
    (hr) Canteen Assesment Report
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
   <!--  <div class="row">
        <div class="col-lg-12">
            <a href="{{route('Commenttt')}}" class="btn btn-sm btn-warning pull-right">get comment</a>
        </div>
    </div> -->
    <div class="row">
        <div class="col-lg-12">            
            <div>
               <p><h3 style="text-align: center;">Tabel Assessment</h3><h5 style="text-align: center;">{{$started}} - {{$ended}}</h5>

               </p>
                <table class="table table-striped table-bordered table-hover text-nowrap" style="font-size: 13px;" width="100%" id="tables">
                    <thead>
                        <tr>
                        <th>ID</th>        
                            <!-- <th style="text-align: center;">No</th>                                             -->
                            <th style="text-align: center;">NIK</th>
                            <th style="text-align: center;">Name Employee</th>
                            <th style="text-align: center;">Department</th>                           
                            <th style="text-align: center;">Total Point</th>
                            <th style="text-align: center;">Rating</th>
                            <th style="text-align: center;">Date Entry</th>
                            <th style="text-align: center;">Comment</th>   
                            <th style="text-align: center;">Comment</th>   
                        </tr>                      
                    </thead>   
                    <tbody id="tbody"></tbody>                
                </table>
            </div>
        </div>
    </div>    
    <div class="row">      
         <div class="col-lg-8" id="grafik1" style="height: 400px;"></div>

         <form method="get" action="{{ route('getVotingCanteen') }}">
             {{ csrf_field() }}
            <input type="date" name="formStarted" value="{{$started}}" style="display: none;" id="cek1">
            <input type="date" name="formEnded" value="{{$ended}}" style="display: none;"> 
            <button type="submit" class="btn btn-sm btn-warning" style="display: none;">send</button>            
         </form>

    </div>
</div>
 <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myChart = 
Highcharts.chart('grafik1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Rating Canteen'
    },
    subtitle: {
        text: '<?php echo $started; ?> - <?php echo $ended; ?>'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total score voting share'
        }

    },
    legend: {
        enabled: true
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
    },

    series: [
        {
            name: "Results Assessment Canteen",
            colorByPoint: true,
            data: [
                {
                    name: "Taste Rate",                  
                    y:  <?php echo $data->pluck('point_1')->avg(); ?>,
                    drilldown: "Taste"
                },
                {
                    name: "Quantity Rate",                  
                    y:  <?php echo $data->pluck('point_2')->avg(); ?>,
                    drilldown: "Quantity"
                },
                {
                    name: "Quanlity Rate",                  
                    y:  <?php echo $data->pluck('point_3')->avg(); ?>,
                    drilldown: "Quanlity"
                },
                {
                    name: "Nutrition Rate",                  
                    y:  <?php echo $data->pluck('point_4')->avg(); ?>,
                    drilldown: "Nutrition"
                },
                {
                    name: "Menu Rate",                  
                    y:  <?php echo $data->pluck('point_5')->avg(); ?>,
                    drilldown: "Menu"
                },
                {
                    name: "Freshness Rate",                  
                    y:  <?php echo $data->pluck('point_6')->avg(); ?>,
                    drilldown: "Freshness"
                },
                {
                    name: "Cleanliness Rate",                  
                    y:  <?php echo $data->pluck('point_7')->avg(); ?>,
                    drilldown: "Cleanliness"
                },
                {
                    name: "Service Rate",                  
                    y:  <?php echo $data->pluck('point_8')->avg(); ?>,
                    drilldown: "Service"
                }
            ]
        }
    ]
});
    });
</script>
@stop
@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({         
        "fixedHeader": {
            header: true,
            footer: true
        },
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 7] }
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
                    columns: [ 1, 2, 3, 4, 5, 6, 7]
                }              
               
            },
            {
                extend:    "pdfHtml5",
                text:      "PDF",
                titleAttr: "Download",
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6]
                }              
               
            }],
        <!-- ajax: '{!! URL::route("getVotingCanteen", [$started]) !!}' -->
        "ajax":  {
       
                "url": '{{ route ("getVotingCanteen") }}',
                "type": "get",
                "dataType": "json",
                "data": {
                            "started": $('input#cek1').val(),
                            "ended": {{ $ended }}                       
                        },
              }
              
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