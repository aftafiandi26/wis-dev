@extends('layout')

@section('title')
    (hr) Attendance Job
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c303403' => 'active'
    ])
@stop

@push('style')
@endpush

@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Attendance Job</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-striped table-hover" id="tables" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Employes</th>
                    <th>Projects</th>
                    <th>Will Do</th>
                    <th>Date</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div id="chart"></div>
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
    processing: true, 
    responsive: true,  
    "dom": 'Blfrtip',
    "buttons": [{
            extend:    'excel',
            text:      'Excel',
            titleAttr: 'Attendance',
            title: 'Attendance'
    }],  
    ajax: '{{ route('hr/acakan/data') }}',
    columns: [
            {"data": "DT_Row_Index", orderable: false, searchable : false}, 
            {"data": "fullname"},
            {"data": "projectName"},
            {"data": "will_do"},
            {"data": "date"},
            
        ]
});
@stop

@push('js')
    <script src="{{ asset('assets/apexchart/dist/apexcharts.js') }}"></script>
    <script> 
        var options = {
            series: [{
                name: "people",
                data: <?= $jsonResult ?>,
            }],
            chart: {
                type: 'bar',            
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
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush