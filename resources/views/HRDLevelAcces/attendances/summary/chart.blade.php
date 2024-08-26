@extends('layout')

@section('title')
    (hr) Attendance - Chart
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')

    <link rel="stylesheet" href="{{ asset('assets/apexchart/dist/apexcharts.css') }}">
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active'
    ])
@stop

@push('style')    
    <style>   
        .max-tinggi {
            max-height: 300px;
        } 
    </style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Attendances Chart</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form action="" method="get"></form>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div id="quest1"></div>
    </div>

    <div class="col-lg-6">
        <div id="quest2"></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div id="chart"></div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-striped table-hover table-bordered" width="100%" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Employee</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Condition</th>
                    <th>Health</th>
                    <th>Projects</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_7')
@stop

@section('script')
$('table#tables').DataTable({
    "processing": true, 
    "responsive": true,
    "ajax": "{{ route('hr/summary/attendance/chart/datatables', [$start, $end]) }}",     
    "columns": [
        {"data": "DT_Row_Index", orderable: false, searchable : false},
        { "data": "nik"},
        { "data": "employes"},
        { "data": "start"},
        { "data": "end"},
        { "data": "condition"},
        { "data": "health"},
        { "data": "projects"},
    ],
    "dom": 'Blfrtip',
    "buttons": [{
            extend:    'excel',
            text:      'Excel',
            titleAttr: 'Attendance',
            title: 'Attendance'
    }],  
});
@stop

@push('js')
<script src="{{ asset('assets/apexchart/dist/apexcharts.js') }}"></script>

<script>
    $(document).ready(function () {

        var heighted = 300;

        var options = {
            series: [{
                name: 'Condition',
                data: <?= json_encode($percentages); ?>
            }],
            chart: {
                height: heighted,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },               
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + "%";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            xaxis: {
                categories: ['Very Unpleasant', 'Unpleasant', 'Neutral', 'Pleasant', 'Very Pleasant'],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                max: 100,
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    formatter: function (val) {
                        return val + "%";
                    }
                }            
            },
            title: {
                text: "# Rate Employes Condition on {{ $start }} - {{ $end }}",
                floating: true,          
                align: 'center',
                style: {
                    color: '#444'
                }
            },
            fill: {
                colors: ['#F44336', ]
            }
        };

        var options1 = {
            series: [{
                name: 'Health',
                data: <?= json_encode($percent_Q2); ?>
            }],
            chart: {
                height: heighted,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },               
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + "%";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            xaxis: {
                categories: ['Very Poor', 'Good', 'Very Good', 'Excellent'],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                max: 100,
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    formatter: function (val) {
                        return val + "%";
                    }
                }            
            },
            title: {
                text: "# Rate Employes Health on {{ $start }} - {{ $end }}",
                floating: true,             
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var q1 = new ApexCharts(document.querySelector("#quest1"), options);
        q1.render();

        var q2 = new ApexCharts(document.querySelector("#quest2"), options1);
        q2.render();

        var options = {
            series: [{
                name: "people",
                data: <?= $jsonResult ?>,
            }],
            chart: {
                type: 'bar',  
                height: heighted          
            },
            plotOptions: {
                bar: {
                borderRadius: 4,
                borderRadiusApplication: 'end',
                horizontal: true,
            }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: <?= $jsonProject ?>,
            },
            title: {
                text: "Project Daily on {{ $start }} - {{ $end }}",
                floating: true,             
                align: 'center',
                style: {
                    color: '#444'
                }
            }        
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

    });
</script>
@endpush

