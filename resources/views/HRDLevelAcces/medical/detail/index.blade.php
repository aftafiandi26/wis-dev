@extends('layout')

@section('title')
    (hr) Index Employee Sicked
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1811' => 'active'
    ])
@stop
@section('body')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sick Employee Summary</h1>           
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-6">
            <a href="{{ route('sicked/summary') }}" class="btn btn-sm btn-default">back</a>
        </div>
        <div class="col-lg-6">
            <a href="https://www.alodokter.com/penyakit-a-z" target="_blank" class="pull-right">www.alodokter.com</a> 
        </div>
    </div>
     <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-12">
          <a href="{{ route('details/summary/excel', [$dateFrom, $dateToo, $category]) }}" class="btn btn-default">Excel</a>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-12 table-responsive">
            <table class="table table-striped table-bordered table-hover display" width="100%" id="tablesMedical">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>No</td>
                        <td>NIK</td>                        
                        <td>Employee</td>                      
                        <td>Department</td>
                        <td>Position</td>
                        <td>Age</td>
                        <td>Date Sicked</td>
                        <td>Category</td>
                        <td>Disease</td>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach ($medic as $key => $data): ?>
                        <?php 
                            $disease = App\MedicalDisease::where('medic_id', $data->id)->first();
                        ?>
                        <?php if ($disease->category === $category): ?>
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nik }}</td>
                                <td>{{ $data->first_name.' '.$data->last_name }}</td>
                                <td>{{ App\Dept_Category::where('id', $data->dept_category_id)->value('dept_category_name') }}</td>
                                <td>{{ $data->position }}</td>
                                <td>{{ $data->age }}</td>
                                <td>{{ $data->sicked_date }}</td>
                                <td>{{ $disease->category }}</td>
                                <td>{{ $disease->disease }}</td>
                                <td>
                                    <a class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalDetailMC{{$data->id}}"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="modalDetailMC{{$data->id}}" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Medical Certificate <b><i>{{ $data->first_name.' '.$data->last_name }}</i></b></h4>
                                    </div>
                                    <div class="modal-body">
                                      <img src="{{ asset('storage/app/HR/MedicStaff/'.$data->image) }}" class="img-responsive img-fluid img">
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                  
                                </div>
                            </div>
                        <?php endif ?>
                   <?php endforeach ?>
                </tbody>
            </table>
        </div>      
    </div>   

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
        </div>
    </div>  

<figure class="highcharts-figure">
  <div id="container"></div>
</figure>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
    Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});   

    Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<b>{{ $category }}</b> disease percentage in <br> <b>{{ date("d-M-Y", strtotime($dateFrom)) }}</b> to <b>{{ date("d-M-Y", strtotime($dateToo)) }}</b>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Disease percentage',
        colorByPoint: true,
        data: [{
             name: '{{ $category }}',
             y: 4          
        }]
    }]
});
</script>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop