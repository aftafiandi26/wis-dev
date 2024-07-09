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
@section('body')
<div class="row">
    <h2>Employee of Kinema Systrans Multimedia</h2>
    <hr class="my-5">
</div>
<div class="row">
    <div class="col-lg-3 btn-sm" style="text-align: center;">
    <div class="panel panel-primary" style="margin-top: 10px;">
        <div class="panel-heading">Total Employee</div>
        <div class="panel-body"><b>{{$total_user}}</b> Employee</div>
        <div class="panel-footer"> <a href="{{route('detailTotalEmployee')}}" class="btn btn-info btn-sm">Detail</a></div>
    </div>
    </div>
     <div class="col-lg-3 btn-sm" style="text-align: center;">
    <div class="panel panel-danger" style="margin-top: 10px;">
        <div class="panel-heading">Total Employee (Permanen)</div>
        <div class="panel-body"><b>{{$total_permanent}}</b> Employee</div>
        <div class="panel-footer"> <a href=" {{route('detailTotalPermanent')}} " class="btn btn-info btn-sm">Detail</a></div>
    </div>
    </div>
     <div class="col-lg-3 btn-sm" style="text-align: center;">
    <div class="panel panel-success" style="margin-top: 10px;">
        <div class="panel-heading">Total Employee (Contract)</div>
        <div class="panel-body"><b>{{$total_contract}}</b> Employee</div>
        <div class="panel-footer"> <a href=" {{route('detailTotalContract')}} " class="btn btn-info btn-sm">Detail</a></div>
    </div>
    </div>
     <div class="col-lg-3 btn-sm" style="text-align: center;">
     <div class="panel panel-warning" style="margin-top: 10px;">
        <div class="panel-heading">Total Employee (PLK)</div>
        <div class="panel-body"><b>{{$total_PKL}}</b> Employee</div>
        <div class="panel-footer"> <a href=" {{route('detailTotalPKL')}} " class="btn btn-info btn-sm">Detail</a></div>
    </div>
    </div>
    <div class="col-lg-3 btn-sm" style="text-align: center;">
     <div class="panel panel-default" style="margin-top: 10px;">
        <div class="panel-heading">Total Employee (Outsource)</div>
        <div class="panel-body"><b>{{$total_Outsource}}</b> Employee</div>
        <div class="panel-footer"> <a href=" {{route('detailTotalOutsource')}} " class="btn btn-info btn-sm">Detail</a></div>
    </div>
    </div>
<hr class="my-5">
</div>
<div class="row">
    <div class="col-lg-12" id="container" >
       
    </div>    
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>

<script type="text/javascript">
Highcharts.createElement('link', {
    href: 'https://fonts.googleapis.com/css?family=Dosis:400,600',
    rel: 'stylesheet',
    type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);

Highcharts.theme = {
    colors: ['#7cb5ec', '#f7a35c', '#90ee7e', '#7798BF', '#aaeeee', '#ff0066',
        '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
    chart: {
        backgroundColor: null,
        style: {
            fontFamily: 'Dosis, sans-serif'
        }
    },
    title: {
        style: {
            fontSize: '16px',
            fontWeight: 'bold',
            textTransform: 'uppercase'
        }
    },
    tooltip: {
        borderWidth: 0,
        backgroundColor: 'rgba(219,219,216,0.8)',
        shadow: false
    },
    legend: {
        itemStyle: {
            fontWeight: 'bold',
            fontSize: '13px'
        }
    },
    xAxis: {
        gridLineWidth: 1,
        labels: {
            style: {
                fontSize: '12px'
            }
        }
    },
    yAxis: {
        minorTickInterval: 'auto',
        title: {
            style: {
                textTransform: 'uppercase'
            }
        },
        labels: {
            style: {
                fontSize: '12px'
            }
        }
    },
    plotOptions: {
        candlestick: {
            lineColor: '#404048'
        }
    },


    // General
    background2: '#F0F0EA'

};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);

Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.9
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});
Highcharts.chart('container', {
    chart: {
        type: 'pie',
           options3d: {
            enabled: true,
            alpha: 50,
            beta: 0
        }
    },
    title: {
        text: 'PT Kinema Systrans Multimedia <br> <small>Infinite Studios</small>'
    },
   /* subtitle: {
        text: 'PT Kinema Systrans Multimedia <br> Infinite Studios'
    },*/
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:1f} Employee'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> total of employee<br/>'
    },
     plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      depth: 35,
      dataLabels: {
        enabled: true,
        format: '{point.name}'
      }
    }
  },
    series: [
        {
            name: "Department",
            colorByPoint: true,
            data: [
                {
                    name: "IT",
                    y: <?php echo ($total_it); ?>,
                    drilldown: "IT"
                },
                {
                    name: "Finance",
                    y: <?php echo ($total_finance); ?>,
                    drilldown: "Finance"
                },
                {
                    name: "HR",
                    y: <?php echo ($total_hr); ?>,
                    drilldown: "HR"
                },
                {
                    name: "Operation",
                    y: <?php echo ($total_Operation); ?>,
                    drilldown: "Operation"
                },
                {
                    name: "Facility",
                    y: <?php echo ($total_Facility); ?>,
                    drilldown: "Facility"
                },                
                {
                    name: "Production Services",
                    y: <?php echo ($total_LS); ?>,
                    drilldown: "Production Services"
                },
                {
                    name: "General",
                    y: <?php echo ($total_General); ?>,
                    drilldown: "General"
                },
                {
                    name: "Management",
                    y: <?php echo ($total_Management); ?>,
                    drilldown: "Management"
                },
                {
                    name: "Production",
                    y: <?php echo ($total_Production); ?>,
                    drilldown: "Production"
                }
            ]
        }
    ],
    drilldown: {
        series: [
            {
                name: "Production",
                id: "Production",
                data: [
                    [
                        "Permanent",
                        <?php echo($Production_Permanent); ?>
                    ],
                    [
                        "Contract",
                        <?php echo($Production_Contract); ?>
                    ],
                    [
                        "PKL",
                        <?php echo($Production_PKL); ?>
                    ],
                    
                ]
            },
            {
                name: "General",
                id: "General",
                data: [                    
                   [
                        "Permanent",
                        <?php echo($General_Permanent); ?>
                    ],
                     [
                        "Contract",
                        <?php echo($General_Contract); ?>
                    ],
                     [
                        "PKL",
                        <?php echo($General_PKL); ?>
                    ],
                ]
            },
            {
                name: "Management",
                id: "Management",
                data: [
                    [
                        "Permanent",
                        <?php echo($Management_Permanent); ?>
                    ],
                     [
                        "Contract",
                        <?php echo($Management_Contract); ?>
                    ],
                     [
                        "PKL",
                        <?php echo($Management_PKL); ?>
                    ],
                ]
            },
            {
                name: "Production Services",
                id: "Production Services",
                data: [
                    [
                        "Permanent",
                        <?php echo($LS_Permanent); ?>
                    ],
                     [
                        "Contract",
                        <?php echo($LS_Contract); ?>
                    ],
                     [
                        "PKL",
                        <?php echo($LS_PKL); ?>
                    ],
                ]
            },
            {
                name: "Facility",
                id: "Facility",
                data: [
                    [
                        "Permanent",
                        <?php echo($Facility_Permanent); ?>
                    ],
                    [
                        "Contract",
                        <?php echo($Facility_Contract); ?>
                    ],
                     [
                        "Outsource",
                        <?php echo($Facility_Outsource); ?>
                    ],
                ]
            },
            {
                name: "Operation",
                id: "Operation",
                data: [
                    [
                        "Permanent",
                        <?php echo($Operation_Permanent); ?>
                    ],
                    [
                        "Contract",
                        <?php echo($Operation_Contract); ?>
                    ],
                     [
                        "PKL",
                        <?php echo($Operation_PKL); ?>
                    ],
                ]
            },
            {
                name: "HR",
                id: "HR",
                data: [
                    [
                        "Permanent",
                        <?php echo($HR_Permanent); ?>
                    ],
                    [
                        "Contract",
                        <?php echo($HR_Contract); ?>
                    ],
                     [
                        "PKL",
                        <?php echo($HR_PKL); ?>
                    ],
                ]
            },
            {
                name: "Finance",
                id: "Finance",
                data: [
                    [
                        "Permanent",
                        <?php echo($Finance_Permanent); ?>
                    ],
                    [
                        "Contract",
                        <?php echo($Finance_Contract); ?>
                    ],
                     [
                        "PKL",
                        <?php echo($Finance_PKL); ?>
                    ],
                ]
            },
            {
                name: "IT",
                id: "IT",
                data: [
                    [
                        "Permanent",
                        <?php echo($IT_Permanent); ?>
                    ],
                    [
                        "Contract",
                        <?php echo($IT_Contract); ?>
                    ],
                     [
                        "PKL",
                        <?php echo($IT_PKL); ?>
                    ],
                ]
            },
        ]
    }
});
</script>
@stop
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
