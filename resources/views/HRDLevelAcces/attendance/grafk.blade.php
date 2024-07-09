@extends('layout')

@section('title')
    (hr) Stocked
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3003' => 'active'
    ])
@stop
@section('body')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Chart Attendance</h1> 
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
        <figure class="highcharts-figure">
  <div id="container"></div>
  </figure>
    </div>
</div>

<script type="text/javascript">
    Highcharts.chart('container', {

  title: {
    text: 'Attendance Check In Employees'
  },

  subtitle: {
    text: '{{ date("Y-m-d") }}'
  },

  yAxis: {
    title: {
      text: 'Attendance of Employees'
    }
  },

  xAxis: {
    accessibility: {
      rangeDescription: 'Range: Januari to December'
    }
  },

  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
  },

  plotOptions: {
    series: {
      label: {
        connectorAllowed: false
      },
      pointStart: Januari
    }
  },

  series: [{
    name: 'Installation',
    data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175, 25000]
  }],

  responsive: {
    rules: [{
      condition: {
        maxWidth: 500
      },
      chartOptions: {
        legend: {
          layout: 'horizontal',
          align: 'center',
          verticalAlign: 'bottom'
        }
      }
    }]
  }

});
</script>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
