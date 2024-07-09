@extends('layout')

@section('title')
    (hr) Chart Voting
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
    <?php if ($select != null): ?>
        <div class="col-lg-8" id="grafik1"></div>
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
        text: '{{$select->date_entry}}'
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
            name: "Voting Canteen",
            colorByPoint: true,
            data: [
                {
                    name: "Taste value",                  
                    y:  <?php echo $taste*10; ?>,
                    drilldown: "Taste"
                },
                {
                    name: "Quantity of side dishes",
                    y:  <?php echo $quantity*10; ?>,
                    drilldown: "Quantity"
                },
                {
                    name: "Quality of side dishes",
                    y:  <?php echo $quality*10; ?>,
                    drilldown: "Quantity"
                },
                {
                    name: "Nutritional value",
                    y:  <?php echo $nutritional*10; ?>,
                    drilldown: "Nutritional"
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
                name: "Quantity side dishes",
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
                name: "Quality side dishes",
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
                name: "Nutritional value",
                id: "Nutritional",
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