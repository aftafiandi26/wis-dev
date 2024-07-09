@extends('layout')

@section('title')
    (hr) Index Voting
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

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Canteen Assessment Report</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12"> 
        {{ $semua->links() }}      
            <div  class="col-lg-12" style="overflow: auto;">
                <table class="table table-striped table-bordered table-hover text-nowrap" style="font-size: 13px;" width="100%" id="tables">
                    <thead>
                        <tr>
                            <th style="text-align: center;" rowspan="2">No</th>                                                    
                            <th style="text-align: center;" rowspan="2">NIK</th>
                            <th style="text-align: center;" rowspan="2">Name Employee</th>
                            <th style="text-align: center;" rowspan="2">Department</th>
                            <th style="text-align: center;" rowspan="2">Rating</th>                             
                            <th style="text-align: center;" colspan="6">Preferred Food</th>
                            <th style="text-align: center;" colspan="6">Unpreferred Food</th> 
                            <th style="text-align: center;" rowspan="2">Date Entry</th>
                            <th style="text-align: center;" rowspan="2">Comment</th>                        
                        </tr> 
                        <tr>
                            <th>Main of Dishes</th>
                            <th>Vegetables</th>
                            <th>Slide of Dishes</th>
                            <th>Drink</th>
                            <th>Sambal</th>
                            <th>Score</th>
                           
                            <th>Main of Dishes</th>
                            <th>Vegetables</th>
                            <th>Slide of Dishes</th>
                            <th>Drink</th>
                            <th>Sambal</th>
                            <th>Score</th>                          
                        </tr>                     
                    </thead> 
                    <tbody>
                        <?php $no = 1; use App\User; use App\Dept_Category;
                         foreach ($semua as $value): ?>
                            <?php $userrr = User::where('id', $value->id_userss)->first(); 
                                  $devisi = Dept_Category::where('id', $userrr->dept_category_id)->first(); 
                            ?>
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$userrr->nik}}</td>
                                <td>{{$value->name_employee}}</td>
                                <td>{{$devisi->dept_category_name}}</td>
                                <td>{{$value->averange}}</td>
                                <td>{{$value->main_dishes_1}} | {{$value->main_dishes_2}} </td>
                                <td>{{$value->vegetables_1}} | {{$value->vegetables_2}} </td>
                                <td>{{$value->slide_of_dishes_1}} | {{$value->slide_of_dishes_2}}</td>
                                <td>{{$value->drinks_1}} | {{$value->drinks_2}}</td>
                                <td>{{$value->sambal_1}} | {{$value->sambal_2}}</td>
                                <td>{{round(($value->score_1+$value->score_2)/2, 2)}}</td>
                                <td>{{$value->main_dishes_3}} | {{$value->main_dishes_4}} </td>
                                <td>{{$value->vegetables_3}} | {{$value->vegetables_4}} </td>
                                <td>{{$value->slide_of_dishes_3}} | {{$value->slide_of_dishes_4}}</td>
                                <td>{{$value->drinks_3}} | {{$value->drinks_4}}</td>
                                <td>{{$value->sambal_3}} | {{$value->sambal_4}}</td>
                                <td>{{round(($value->score_3+$value->score_4)/2, 2)}}</td>   
                                <td>{{date("M, d Y", strtotime($value->date_entry))}}</td>
                                <td><button class="btn-default btn-sm" type="submit" data-toggle="modal" data-target="#myModal{{$value->id}}">comment</button></td>                             
                            </tr>
                                    <div id="myModal{{$value->id}}" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{$value->name_employee}} Comment</h4>
                                          </div>
                                          <div class="modal-body">
                                            <p>{{$value->comment}}</p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>                           
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            
                        </tr>
                    </tfoot>                  
                </table>
            </div>
        </div>
    </div>    
    <div class="row">      
        <?php if ($select != null): ?>
            <div class="col-lg-8" id="grafik1" style="height: 400px;"></div>
        <?php else: ?>
            <div class="col-lg-8"></div>
        <?php endif ?>
    </div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var myChart = 
Highcharts.chart('grafik1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Voting Canteen'
    },
    subtitle: {
        text: '<?php if ($select != null) { echo $select->date_entry;}else{ echo "";} ?>'
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
            text: 'Total percent voting share'
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
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: "Results Assessment Canteen",
            colorByPoint: true,
            data: [
                {
                    name: "Taste value",                  
                    y:  <?php echo $taste*10; ?>,
                    drilldown: "Taste"
                },
                {
                    name: "Quantity of main dishes",
                    y:  <?php echo $quantity*10; ?>,
                    drilldown: "Quantity"
                },
                {
                    name: "Quality of side dishes",
                    y:  <?php echo $quality*10; ?>,
                    drilldown: "Quantity"
                },
                {
                    name: "Supper score",
                    y:  <?php echo $nutritional*10; ?>,
                    drilldown: "Supper"
                },
                {
                    name: "Menu combination",
                    y:  <?php echo $menu*10; ?>,
                    drilldown: "Menu"
                },
                {
                    name: "Freshness of food",
                    y:  <?php echo $freshness*10; ?>,
                    drilldown: "Freshness"
                },
                {
                    name: "Cleanliness of food utensils",
                    y:  <?php echo $cleanliness*10; ?>,
                    drilldown: "Cleanliness"
                },
                {
                    name: "Canteen service",
                    y:  <?php echo $service*10; ?>,
                    drilldown: "Canteen"
                }
            ]
        }
    ],
    drilldown: {
        series: [
            {
                name: "Taste Value",
                id: "Taste",
                data: [
                    [
                        "IT",
                        <?php echo $it_point_1*10; ?>
                    ],
                    [
                        "Finance",
                        <?php echo $finance_point_1*10; ?>
                    ],        
                    [
                        "HR",
                       <?php echo $hr_point_1*10; ?>
                    ],
                    [
                        "Facility",
                        <?php echo $facilities_point_1*10; ?>
                    ],
                    [
                        "Production",
                       <?php echo $production_point_1*10; ?>
                    ],
                    [
                        "General",
                        <?php echo $general_point_1*10; ?>
                    ],         
                ]
            },
            {
                name: "Quantity of main dishes",
                id: "Quantity",
                data: [
                     [
                        "IT",
                        <?php echo $it_point_2*10; ?>
                    ],
                    [
                        "Finance",
                        <?php echo $finance_point_2*10; ?>
                    ],        
                    [
                        "HR",
                       <?php echo $hr_point_2*10; ?>
                    ],
                    [
                        "Facility",
                        <?php echo $facilities_point_2*10; ?>
                    ],
                    [
                        "Production",
                       <?php echo $production_point_2*10; ?>
                    ],
                    [
                        "General",
                        <?php echo $general_point_2*10; ?>
                    ],   
                ]
            },
            {
                name: "Quality of side dishes",
                id: "Quality",
                data: [
                    [
                        "IT",
                        <?php echo $it_point_3*10; ?>
                    ],
                    [
                        "Finance",
                        <?php echo $finance_point_3*10; ?>
                    ],        
                    [
                        "HR",
                       <?php echo $hr_point_3*10; ?>
                    ],
                    [
                        "Facility",
                        <?php echo $facilities_point_3*10; ?>
                    ],
                    [
                        "Production",
                       <?php echo $production_point_3*10; ?>
                    ],
                    [
                        "General",
                        <?php echo $general_point_3*10; ?>
                    ],  
                ]
            },
            {
                name: "Supper Score",
                id: "Supper",
                data: [
                    [
                        "IT",
                        <?php echo $it_point_4*10; ?>
                    ],
                    [
                        "Finance",
                        <?php echo $finance_point_4*10; ?>
                    ],        
                    [
                        "HR",
                       <?php echo $hr_point_4*10; ?>
                    ],
                    [
                        "Facility",
                        <?php echo $facilities_point_4*10; ?>
                    ],
                    [
                        "Production",
                       <?php echo $production_point_4*10; ?>
                    ],
                    [
                        "General",
                        <?php echo $general_point_4*10; ?>
                    ],
                ]
            },
            {
                name: "Menu combination",
                id: "Menu",
                data: [
                    [
                        "IT",
                        <?php echo $it_point_5*10; ?>
                    ],
                    [
                        "Finance",
                        <?php echo $finance_point_5*10; ?>
                    ],        
                    [
                        "HR",
                       <?php echo $hr_point_5*10; ?>
                    ],
                    [
                        "Facility",
                        <?php echo $facilities_point_5*10; ?>
                    ],
                    [
                        "Production",
                       <?php echo $production_point_5*10; ?>
                    ],
                    [
                        "General",
                        <?php echo $general_point_5*10; ?>
                    ],
                ]
            },
            {
                name: "Freshness of food",
                id: "Freshness",
                data: [
                    [
                        "IT",
                        <?php echo $it_point_6*10; ?>
                    ],
                    [
                        "Finance",
                        <?php echo $finance_point_6*10; ?>
                    ],        
                    [
                        "HR",
                       <?php echo $hr_point_6*10; ?>
                    ],
                    [
                        "Facility",
                        <?php echo $facilities_point_6*10; ?>
                    ],
                    [
                        "Production",
                       <?php echo $production_point_6*10; ?>
                    ],
                    [
                        "General",
                        <?php echo $general_point_6*10; ?>
                    ],
                ]
            },
            {
                name: "Cleanliness of food utensils",
                id: "Cleanliness",
                data: [
                    [
                        "IT",
                        <?php echo $it_point_7*10; ?>
                    ],
                    [
                        "Finance",
                        <?php echo $finance_point_7*10; ?>
                    ],        
                    [
                        "HR",
                       <?php echo $hr_point_7*10; ?>
                    ],
                    [
                        "Facility",
                        <?php echo $facilities_point_7*10; ?>
                    ],
                    [
                        "Production",
                       <?php echo $production_point_7*10; ?>
                    ],
                    [
                        "General",
                        <?php echo $general_point_7*10; ?>
                    ],
                ]
            },
            {
                name: "Canteen service",
                id: "Canteen",
                data: [
                    [
                        "IT",
                        <?php echo $it_point_8*10; ?>
                    ],
                    [
                        "Finance",
                        <?php echo $finance_point_8*10; ?>
                    ],        
                    [
                        "HR",
                       <?php echo $hr_point_8*10; ?>
                    ],
                    [
                        "Facility",
                        <?php echo $facilities_point_8*10; ?>
                    ],
                    [
                        "Production",
                       <?php echo $production_point_8*10; ?>
                    ],
                    [
                        "General",
                        <?php echo $general_point_8*10; ?>
                    ],
                ]
            }
        ]
    }
});
    });
</script>