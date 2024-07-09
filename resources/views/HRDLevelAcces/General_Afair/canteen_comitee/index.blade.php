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
<style>
    /* This is what we are focused on */
.table-wrapper{
  overflow-y: scroll;
  height: 450px;
}

.table-wrapper th{
    position: sticky;
    top: 0;
}

/* A bit more styling to make it look better */


table{
  border-collapse: collapse;
  width: 100%;
}

th{
    background: #DDD;
}

td,th{
  padding: 10px;
  text-align: center;
}
</style>
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
    <div class="row" style="margin-bottom: 50px;">
        <div class="col-lg-12">
            <div class="col-lg-3">
                <a href="{{ route('excelData', [$started, $ended]) }}" class="btn btn-sm btn-info">excel</a>
            </div>
            <div class="col-lg-9">
              <p><h3 style="text-align: center;">Tabel Assessment</h3><h5 style="text-align: center;">{{$started}} - {{$ended}}</h5></p>  
            </div>         
            
        </div>
        <div class="col-lg-12 table-wrapper">              
                <table class="table table-striped table-bordered table-hover text-nowrap table-sm" style="font-size: 13px;" width="100%" id="tables">
                    <thead>
                        <tr>                            
                            <th style="text-align: center;">No</th>                                            
                            <th style="text-align: center;">NIK</th>
                            <th style="text-align: center;">Name Employee</th>
                            <th style="text-align: center;">Department</th>                           
                            <th style="text-align: center;">Total Point</th>
                            <th style="text-align: center;">Rating</th>
                            <th style="text-align: center;">Prefer</th>
                            <th style="text-align: center;">Vegetarian</th>
                            <th style="text-align: center;">Date Entry</th>
                            <th style="text-align: center;">Comment</th>   
                        </tr>                      
                    </thead> 
                    <tbody>
                       <?php foreach ($data as $value): ?>
                            <tr>
                                <td> {{ $page++ }} </td>
                              
                               <td> <?php 
                                        $query = App\NewUser::find($value->id_userss);
                                        echo $query->nik;
                                     ?>
                               </td>
                               <td> <?php 
                                        $query = App\NewUser::find($value->id_userss);
                                        echo $query->first_name.' '.$query->last_name;
                                     ?>
                               </td>                           
                               <td>
                                   <?php 
                                        $query_dept = App\Dept_Category::find($query->dept_category_id);
                                        echo $query_dept->dept_category_name;
                                    ?>
                               </td>
                               <td> {{ $value->total_point }} </td>
                               <td> {{ $value->averange }} </td>
                               <td>
                                   @if ($value->prefer === 1)
                                   Rice + Main Dish + Vegetables
                                   @else
                                   Rice + Main Dish + Side Dish + Vegetable
                                   @endif
                               </td>
                               <td>
                                    @if ($value->vegetarian === 1)
                                    Yes
                                    @else
                                    No
                                    @endif 
                               </td>
                               <td> {{ $value->date_entry }} </td>
                               <td> <a class="btn btn-xs btn-default" title="Detail" data-toggle="modal" data-target="#showModal" data-role="{{ route('detailVoteAssessmentReport', [$value->id]) }}">Comment</a></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
        </div>
    </div> 
    <div class="row">
        <div class="col-lg-6" id="grafik1"></div>
        <div class="col-lg-6" id="grafik2"></div>
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
document.addEventListener('DOMContentLoaded', function (a) {
         a.preventDefault();
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

    var myChart1 = 
    Highcharts.chart('grafik2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Summary Voting'
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
                text: 'Summary Score Voting'
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
                    format: '{point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b>% of total<br/>'
        },

        series: [
                  {
                    name: "Results Score Canteen",
                    colorByPoint: true,
                    data: [
                        {
                            name: "Rice + Main Dish + Vegetables",                  
                            y:  <?php echo $snyc1; ?>,
                            drilldown: "Vegetables"
                        },
                        {
                            name: "Rice + Main Dish + Side Dish + Vegetable",                  
                            y:  <?php echo $snyc2; ?>,
                            drilldown: "Side_Dish"
                        },
                        {
                            name: "Vegetarian",                  
                            y:  <?php echo $sync3; ?>,
                            drilldown: "Vegetarian"
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