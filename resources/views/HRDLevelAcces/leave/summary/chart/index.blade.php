@extends('layout')

@section('title')
    (hr) chart-of-summary
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c173' => 'active'
    ])
@stop

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/apexcharts/dist/apexcharts.css') }}">
    <style>
        div.apexChart {               
                height: 400px;              
                overflow-y: scroll;
            }
    </style>
@endpush
@section('body')

    <div class="row">
        <div class="col-lg-12 page-header">
            <h1>Chart of Summary (leave)</h1>
            <h4>Period : {{ date('d, F Y', strtotime(Request('makeStart'))) }} - {{ date('d, F Y', strtotime(Request('maekEnd'))) }}</h4>
        </div>
    </div>

    <div class="row">       
        <div class="col-lg-6 no-padding">
            <form action="{{ route('hr/summary/leave/chart/excel/data') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="started" value="{{ Request('makeStart') }}">
                <input type="hidden" name="ended" value="{{ Request('maekEnd') }}">
                <input type="hidden" name="leave" value="{{ Request('leave_id') }}">
                <button type="submit" class="btn btn-sm btn-default">Excel</button>
                <a href="{{ route('hrd/summary/leave/index') }}" class="btn btn-sm btn-default">back</a>
            </form>
           <br>
           <span>Showing {{ $query->firstItem() }} to {{ $query->lastItem() }} from {{ $query->total() }} data</span>
        </div>
        <div class="col-lg-6">
            <span class="pull-right">{{ $query->appends($_GET)->links() }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 no=padding">
            <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables">
                <thead>
                    <tr style="white-space:nowrap">
                        <th>No</th>
                        <th>Leave Category</th>
                        <th>NIK</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Province</th>
                        <th>Hometown</th>
                        <th>Start Date</th>
                        <th>End Data</th>
                        <th>Back to Work</th>
                        <th>Request Day</th>
                        <th>Status</th>
                    </tr>
                </thead>                
                <tbody>
                    @foreach ($query as $key => $item)
                        <tr>
                            <td>{{ $query->firstItem() + $key }}</td>
                            <td>{{ $item->getLeaveCategory() }}</td>
                            <td>{{ $item->getUser()->value('nik') }}</td>
                            <td>{{ $item->getUser()->value('first_name') . ' ' . $item->getUser()->value('last_name') }}</td>
                            <td>{{ $item->getDepartment() }}</td>
                            <td>{{ $item->getUser()->value('position')}}</td>
                            <td>{{ $item->r_departure }}</td>
                            <td>{{ $item->r_after_leaving }}</td>
                            <td>{{ $item->leave_date }}</td>
                            <td>{{ $item->end_leave_date }}</td>
                            <td>{{ $item->back_work }}</td>
                            <td>{{ $item->total_day }}</td>
                            <td>@if ($item->ap_hrd === 1)
                                    Complate
                                @else
                                    progress
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <figure class="highcharts-figure">
                <div id="barchart"></div>               
            </figure>            
        </div>  
    </div>

    <div class="row">
        <div class="col-lg-6">
            <figure class="highcharts-figure">
                <div id="piechart"></div>        
            </figure>
        </div>
        <div class="col-lg-6">
            <figure class="highcharts-figure">
                <div id="piechart1"></div>        
            </figure>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
        </div>
    </div>

    <form action="#" method="get" hidden>
        <input type="date" name="started" id="started" value="{{ Request('makeStart') }}">
        <input type="date" name="ended" id="ended" value="{{ Request('maekEnd') }}">
        <input type="text" name="cat" id="cat" value="{{ Request('selectChart') }}">
    </form>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop

@push('js')
<script src="{{ asset('assets/vendor/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

@endpush

@section('script') 

Highcharts.chart('barchart', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Historic Applying of Leave',
        align: 'left'
    },
    subtitle: {
        text: 'Period : <?= date('d, F Y', strtotime(Request('makeStart')))?> - <?= date('d, F Y', strtotime(Request('maekEnd'))) ?>',
        align: 'left'
    },
    xAxis: {
        categories: [
                '{{ $chartNameMonth['aceh'] }}',
                '{{ $chartNameMonth['sumut'] }}',
                '{{ $chartNameMonth['sumbar'] }}',
                '{{ $chartNameMonth['riau'] }}',
                '{{ $chartNameMonth['jambi'] }}',
                '{{ $chartNameMonth['sumsel'] }}',
                '{{ $chartNameMonth['bengkulu'] }}',
                '{{ $chartNameMonth['lampung'] }}',
                '{{ $chartNameMonth['bangka'] }}',
                '{{ $chartNameMonth['kepri'] }}',
                '{{ $chartNameMonth['dki'] }}',
                '{{ $chartNameMonth['jabar'] }}',
                '{{ $chartNameMonth['jateng'] }}',
                '{{ $chartNameMonth['yogya'] }}',
                '{{ $chartNameMonth['jatim'] }}',
                '{{ $chartNameMonth['banten'] }}',
                '{{ $chartNameMonth['bali'] }}',
                '{{ $chartNameMonth['ntb'] }}',
                '{{ $chartNameMonth['ntt'] }}',
                '{{ $chartNameMonth['kalbar'] }}',
                '{{ $chartNameMonth['kalteng'] }}',
                '{{ $chartNameMonth['kaltim'] }}',
                '{{ $chartNameMonth['kalut'] }}',
                '{{ $chartNameMonth['sulut'] }}',
                '{{ $chartNameMonth['sulteng'] }}',
                '{{ $chartNameMonth['sulsel'] }}',
                '{{ $chartNameMonth['sultengga'] }}',
                '{{ $chartNameMonth['goro'] }}',
                '{{ $chartNameMonth['sulbar'] }}',
                '{{ $chartNameMonth['maluku'] }}',
                '{{ $chartNameMonth['malut'] }}',
                '{{ $chartNameMonth['papuabar'] }}',
                '{{ $chartNameMonth['papua'] }}',
        ],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Applying of Leave',
            align: 'middle'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' People'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 60,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Annual',
        data: [
            {{ $chartCountAnnual['aceh'] }},
            {{ $chartCountAnnual['sumut'] }},
            {{ $chartCountAnnual['sumbar'] }},
            {{ $chartCountAnnual['riau'] }},
                    {{ $chartCountAnnual['jambi'] }},
                    {{ $chartCountAnnual['sumsel'] }},
                    {{ $chartCountAnnual['bengkulu'] }},
                    {{ $chartCountAnnual['lampung'] }},
                    {{ $chartCountAnnual['bangka'] }},
                    {{ $chartCountAnnual['kepri'] }},
                    {{ $chartCountAnnual['dki'] }},
                    {{ $chartCountAnnual['jabar'] }},
                    {{ $chartCountAnnual['jateng'] }},
                    {{ $chartCountAnnual['yogya'] }},
                    {{ $chartCountAnnual['jatim'] }},
                    {{ $chartCountAnnual['banten'] }},
                    {{ $chartCountAnnual['bali'] }},
                    {{ $chartCountAnnual['ntb'] }},
                    {{ $chartCountAnnual['ntt'] }},
                    {{ $chartCountAnnual['kalbar'] }},
                    {{ $chartCountAnnual['kalteng'] }},
                    {{ $chartCountAnnual['kaltim'] }},
                    {{ $chartCountAnnual['kalut'] }},
                    {{ $chartCountAnnual['sulut'] }},
                    {{ $chartCountAnnual['sulteng'] }},
                    {{ $chartCountAnnual['sulsel'] }},
                    {{ $chartCountAnnual['sultengga'] }},
                    {{ $chartCountAnnual['goro'] }},
                    {{ $chartCountAnnual['sulbar'] }},
                    {{ $chartCountAnnual['maluku'] }},
                    {{ $chartCountAnnual['malut'] }},
                    {{ $chartCountAnnual['papuabar'] }},
                    {{ $chartCountAnnual['papua'] }},
        ]
    }, {
        name: 'Exdo',
        data: [
                        {{ $chartCountExdo['aceh'] }},
                        {{ $chartCountExdo['sumut'] }},
                        {{ $chartCountExdo['sumbar'] }},
                        {{ $chartCountExdo['riau'] }},
                        {{ $chartCountExdo['jambi'] }},
                        {{ $chartCountExdo['sumsel'] }},
                        {{ $chartCountExdo['bengkulu'] }},
                        {{ $chartCountExdo['lampung'] }},
                        {{ $chartCountExdo['bangka'] }},
                        {{ $chartCountExdo['kepri'] }},
                        {{ $chartCountExdo['dki'] }},
                        {{ $chartCountExdo['jabar'] }},
                        {{ $chartCountExdo['jateng'] }},
                        {{ $chartCountExdo['yogya'] }},
                        {{ $chartCountExdo['jatim'] }},
                        {{ $chartCountExdo['banten'] }},
                        {{ $chartCountExdo['bali'] }},
                        {{ $chartCountExdo['ntb'] }},
                        {{ $chartCountExdo['ntt'] }},
                        {{ $chartCountExdo['kalbar'] }},
                        {{ $chartCountExdo['kalteng'] }},
                        {{ $chartCountExdo['kaltim'] }},
                        {{ $chartCountExdo['kalut'] }},
                        {{ $chartCountExdo['sulut'] }},
                        {{ $chartCountExdo['sulteng'] }},
                        {{ $chartCountExdo['sulsel'] }},
                        {{ $chartCountExdo['sultengga'] }},
                        {{ $chartCountExdo['goro'] }},
                        {{ $chartCountExdo['sulbar'] }},
                        {{ $chartCountExdo['maluku'] }},
                        {{ $chartCountExdo['malut'] }},
                        {{ $chartCountExdo['papuabar'] }},
                        {{ $chartCountExdo['papua'] }},
        ]
    }, {
        name: 'Etc',
        data: [
            {{ $chartCountEtc['aceh'] }},
                            {{ $chartCountEtc['sumut'] }},
                            {{ $chartCountEtc['sumbar'] }},
                            {{ $chartCountEtc['riau'] }},
                            {{ $chartCountEtc['jambi'] }},
                            {{ $chartCountEtc['sumsel'] }},
                            {{ $chartCountEtc['bengkulu'] }},
                            {{ $chartCountEtc['lampung'] }},
                            {{ $chartCountEtc['bangka'] }},
                            {{ $chartCountEtc['kepri'] }},
                            {{ $chartCountEtc['dki'] }},
                            {{ $chartCountEtc['jabar'] }},
                            {{ $chartCountEtc['jateng'] }},
                            {{ $chartCountEtc['yogya'] }},
                            {{ $chartCountEtc['jatim'] }},
                            {{ $chartCountEtc['banten'] }},
                            {{ $chartCountEtc['bali'] }},
                            {{ $chartCountEtc['ntb'] }},
                            {{ $chartCountEtc['ntt'] }},
                            {{ $chartCountEtc['kalbar'] }},
                            {{ $chartCountEtc['kalteng'] }},
                            {{ $chartCountEtc['kaltim'] }},
                            {{ $chartCountEtc['kalut'] }},
                            {{ $chartCountEtc['sulut'] }},
                            {{ $chartCountEtc['sulteng'] }},
                            {{ $chartCountEtc['sulsel'] }},
                            {{ $chartCountEtc['sultengga'] }},
                            {{ $chartCountEtc['goro'] }},
                            {{ $chartCountEtc['sulbar'] }},
                            {{ $chartCountEtc['maluku'] }},
                            {{ $chartCountEtc['malut'] }},
                            {{ $chartCountEtc['papuabar'] }},
                            {{ $chartCountEtc['papua'] }},
        ]
    },]
});

Highcharts.chart('piechart', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Chart of Annual Leave'
    },
    subtitle: {
        align: 'left',
        text: 'Period : <?= date('d, F Y', strtotime(Request('makeStart')))?> - <?= date('d, F Y', strtotime(Request('maekEnd'))) ?>'
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
            text: 'Total Applying'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
    },

    series: [
        {
            name: 'Annual Leave',
            colorByPoint: true,
            data: [
                {
                    name: 'Sumatera',
                    y: {{ $sumateraIsland }},
                    drilldown: 'sumatera'
                },
                {
                    name: 'Jawa',
                    y: {{ $javaIsland }},
                    drilldown: 'jawa'
                },
                {
                    name: 'Kalimatan',
                    y: {{ $kalimantanIsland }},
                    drilldown: 'kalimantan'
                },
                {
                    name: 'Bali',
                    y: {{ $chartCountAnnual['bali'] }},
                },
                {
                    name: 'Nusantara',
                    y: {{ $nusantaraIsland }},
                    drilldown: 'nusantara'
                },
                {
                    name: 'Sulawesi',
                    y: {{ $sulawesiIsland }},
                    drilldown: 'sulawesi'
                },
                {
                    name: 'Maluku',
                    y: {{ $chartCountAnnual['maluku'] + $chartCountAnnual['malut'] }},
                    drilldown: 'maluku'
                },
                {
                    name: 'Papua',
                    y: {{ $chartCountAnnual['papuabar'] }},
                    drilldown: 'papua'
                }            
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            {
                name: 'Sumatera',
                id: 'sumatera',
                data: [
                    [
                        'Aceh',
                        {{ $chartCountAnnual['aceh'] }}
                    ],
                    [
                        'Sumut',
                        {{ $chartCountAnnual['sumut'] }}
                    ],
                    [
                        'Sumbar',
                        {{ $chartCountAnnual['sumbar'] }}
                    ],
                    [
                        'Riau',
                        {{ $chartCountAnnual['riau'] }}
                    ],
                    [
                        'Jambi',
                        {{ $chartCountAnnual['jambi'] }}
                    ],
                    [
                        'Sumsel',
                        {{ $chartCountAnnual['sumsel'] }}
                    ],
                    [
                        'Bengkulu',
                        {{ $chartCountAnnual['bengkulu'] }}
                    ],
                    [
                        'Lampung',
                        {{ $chartCountAnnual['lampung'] }}
                    ],
                    [
                        'Kep. Bangka Bel.',
                        {{ $chartCountAnnual['bangka'] }}
                    ],
                    [
                        'Kepri',
                        {{ $chartCountAnnual['kepri'] }}
                    ]
                ]
            },
            {
                name: 'Jawa',
                id: 'jawa',
                data: [
                    [
                        'DKI Jakarta',
                        {{ $chartCountAnnual['dki'] }}
                    ],
                    [
                        'Jawa Barat',
                        {{ $chartCountAnnual['jabar'] }}
                    ],
                    [
                        'Jawa Tengah',
                       {{ $chartCountAnnual['jateng'] }}
                    ],
                    [
                        'DI Yogyakarta',
                        {{ $chartCountAnnual['yogya'] }}
                    ],
                    [
                        'Jawa Timur',
                        {{ $chartCountAnnual['jatim'] }}
                    ],
                    [
                        'Banten',
                       {{ $chartCountAnnual['banten'] }}
                    ]
                ]
            },
            {
                name: 'Kalimatan',
                id: 'kalimantan',
                data: [
                    [
                        'Kalimantan Barat',
                        {{ $chartCountAnnual['kalbar'] }}
                    ],
                    [
                        'Kalimantan Tengah',
                        {{ $chartCountAnnual['kalteng'] }}
                    ],
                    [
                        'Kalimantan Selatan',
                        {{ $chartCountAnnual['kalsel'] }}
                    ],
                    [
                        'Kalimantan Timur',
                        {{ $chartCountAnnual['kaltim'] }}
                    ],
                    [
                        'Kalimantan Utara',
                        {{ $chartCountAnnual['kaltim'] }}
                    ]
                ]
            },
            {
                name: 'Nusantara',
                id: 'nusantara',
                data: [
                    [
                        'NTT',
                        {{ $chartCountAnnual['ntt'] }}
                    ],
                    [
                        'NTB',
                        {{ $chartCountAnnual['ntb'] }}
                    ]
                ]
            },
            {
                name: 'Sulawesi',
                id: 'sulawesi',
                data: [
                    [
                        '{{ $chartNameMonth['sulut'] }}',
                        {{ $chartCountAnnual['sulut'] }}
                    ],
                    [
                        '{{ $chartNameMonth['sulteng'] }}',
                        {{ $chartCountAnnual['sulteng'] }}
                    ],
                    [
                        '{{ $chartNameMonth['sulsel'] }}',
                        {{ $chartCountAnnual['sulsel'] }}
                    ],
                    [
                        '{{ $chartNameMonth['sultengga'] }}',
                        {{ $chartCountAnnual['sultengga'] }}
                    ],
                    [
                        '{{ $chartNameMonth['goro'] }}',
                        {{ $chartCountAnnual['goro'] }}
                    ],
                    [
                        '{{ $chartNameMonth['sulbar'] }}',
                        {{ $chartCountAnnual['sulbar'] }}
                    ]
                ]
            },
            {
                name: 'Maluku',
                id: 'maluku',
                data: [
                    [
                        '{{ $chartNameMonth['maluku'] }}',
                        {{ $chartCountAnnual['maluku'] }}
                    ],
                    [
                        '{{ $chartNameMonth['malut'] }}',
                        {{ $chartCountAnnual['malut'] }}
                    ],
                ]
            },
            {
                name: 'Papua',
                id: 'papua',
                data: [
                    [
                        '{{ $chartNameMonth['papuabar'] }}',
                        {{ $chartCountAnnual['papuabar'] }}
                    ],
                    [
                        '{{ $chartNameMonth['papua'] }}',
                        {{ $chartCountAnnual['papua'] }}
                    ],
                ]
            }
        ]
    }
});

Highcharts.chart('piechart1', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Chart of Exdo Leave'
    },
    subtitle: {
        align: 'left',
        text: 'Period : <?= date('d, F Y', strtotime(Request('makeStart')))?> - <?= date('d, F Y', strtotime(Request('maekEnd'))) ?>'
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
            text: 'Total Appling'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
    },

    series: [
        {
            name: 'Exdo Leave',
            colorByPoint: true,
            data: [
                {
                    name: 'Sumatera',
                    y: {{ $sumateraIsland1 }},
                    drilldown: 'sumatera1'
                },
                {
                    name: 'Jawa',
                    y: {{ $javaIsland1 }},
                    drilldown: 'jawa1'
                },
                {
                    name: 'Kalimatan',
                    y: {{ $kalimantanIsland1 }},
                    drilldown: 'kalimantan1'
                },
                {
                    name: 'Bali',
                    y: {{ $chartCountExdo['bali'] }},
                },
                {
                    name: 'Nusantara',
                    y: {{ $nusantaraIsland1 }},
                    drilldown: 'nusantara1'
                },
                {
                    name: 'Sulawesi',
                    y: {{ $sulawesiIsland1 }},
                    drilldown: 'sulawesi1'
                },
                {
                    name: 'Maluku',
                    y: {{ $chartCountExdo['maluku'] + $chartCountExdo['malut'] }},
                    drilldown: 'maluku1'
                },
                {
                    name: 'Papua',
                    y: {{ $chartCountExdo['papuabar'] + $chartCountExdo['papua'] }},
                    drilldown: 'papua1'
                }            
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            {
                name: 'Sumatera',
                id: 'sumatera1',
                data: [
                    [
                        'Aceh',
                        {{ $chartCountExdo['aceh'] }}
                    ],
                    [
                        'Sumut',
                        {{ $chartCountExdo['sumut'] }}
                    ],
                    [
                        'Sumbar',
                        {{ $chartCountExdo['sumbar'] }}
                    ],
                    [
                        'Riau',
                        {{ $chartCountExdo['riau'] }}
                    ],
                    [
                        'Jambi',
                        {{ $chartCountExdo['jambi'] }}
                    ],
                    [
                        'Sumsel',
                        {{ $chartCountExdo['sumsel'] }}
                    ],
                    [
                        'Bengkulu',
                        {{ $chartCountExdo['bengkulu'] }}
                    ],
                    [
                        'Lampung',
                        {{ $chartCountExdo['lampung'] }}
                    ],
                    [
                        'Kep. Bangka Bel.',
                        {{ $chartCountExdo['bangka'] }}
                    ],
                    [
                        'Kepri',
                        {{ $chartCountExdo['kepri'] }}
                    ]
                ]
            },
            {
                name: 'Jawa',
                id: 'jawa1',
                data: [
                    [
                        'DKI Jakarta',
                        {{ $chartCountExdo['dki'] }}
                    ],
                    [
                        'Jawa Barat',
                        {{ $chartCountExdo['jabar'] }}
                    ],
                    [
                        'Jawa Tengah',
                       {{ $chartCountExdo['jateng'] }}
                    ],
                    [
                        'DI Yogyakarta',
                        {{ $chartCountExdo['yogya'] }}
                    ],
                    [
                        'Jawa Timur',
                        {{ $chartCountExdo['jatim'] }}
                    ],
                    [
                        'Banten',
                       {{ $chartCountExdo['banten'] }}
                    ]
                ]
            },
            {
                name: 'Kalimatan',
                id: 'kalimantan1',
                data: [
                    [
                        'Kalimantan Barat',
                        {{ $chartCountExdo['kalbar'] }}
                    ],
                    [
                        'Kalimantan Tengah',
                        {{ $chartCountExdo['kalteng'] }}
                    ],
                    [
                        'Kalimantan Selatan',
                        {{ $chartCountExdo['kalsel'] }}
                    ],
                    [
                        'Kalimantan Timur',
                        {{ $chartCountExdo['kaltim'] }}
                    ],
                    [
                        'Kalimantan Utara',
                        {{ $chartCountExdo['kaltim'] }}
                    ]
                ]
            },
            {
                name: 'Nusantara',
                id: 'nusantara1',
                data: [
                    [
                        'NTT',
                        {{ $chartCountExdo['ntt'] }}
                    ],
                    [
                        'NTB',
                        {{ $chartCountExdo['ntb'] }}
                    ]
                ]
            },
            {
                name: 'Sulawesi',
                id: 'sulawesi1',
                data: [
                    [
                        '{{ $chartNameMonth['sulut'] }}',
                        {{ $chartCountExdo['sulut'] }}
                    ],
                    [
                        '{{ $chartNameMonth['sulteng'] }}',
                        {{ $chartCountExdo['sulteng'] }}
                    ],
                    [
                        '{{ $chartNameMonth['sulsel'] }}',
                        {{ $chartCountExdo['sulsel'] }}
                    ],
                    [
                        '{{ $chartNameMonth['sultengga'] }}',
                        {{ $chartCountExdo['sultengga'] }}
                    ],
                    [
                        '{{ $chartNameMonth['goro'] }}',
                        {{ $chartCountExdo['goro'] }}
                    ],
                    [
                        '{{ $chartNameMonth['sulbar'] }}',
                        {{ $chartCountExdo['sulbar'] }}
                    ]
                ]
            },
            {
                name: 'Maluku',
                id: 'maluku1',
                data: [
                    [
                        '{{ $chartNameMonth['maluku'] }}',
                        {{ $chartCountExdo['maluku'] }}
                    ],
                    [
                        '{{ $chartNameMonth['malut'] }}',
                        {{ $chartCountExdo['malut'] }}
                    ],
                ]
            },
            {
                name: 'Papua',
                id: 'papua1',
                data: [
                    [
                        '{{ $chartNameMonth['papuabar'] }}',
                        {{ $chartCountExdo['papuabar'] }}
                    ],
                    [
                        '{{ $chartNameMonth['papua'] }}',
                        {{ $chartCountExdo['papua'] }}
                    ],
                ]
            }
        ]
    }
});

@endsection

