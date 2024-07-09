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

  <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Summary Sicked (Employes)</h1>           
        </div>
    </div>

    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-6">
            <form class="form-inline" action="{{ route('details/summary/index') }}" method="get">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="seacrh1">Search :</label>                    
                </div>
                <br>
                <div class="form-group">
                    <label for="from1">From :</label>
                    <input type="date" name="dateFrom" class="form-control" id="from1" required>
                    <label id="to1">To :</label>
                    <input type="date" name="dateTo" class="form-control" id="to1" required>     
                    <label for="disease">Disease :</label>
                    <select class="form-control" name="selectDisease" id="disease" required>
                        <option value="All">-All-</option>
                        <option value="Accident">Accidents</option>
                        <option value="Brain">Brains</option>
                        <option value="Cancer">Cancer</option>
                        <option value="Deficiency">Deficiency</option>
                        <option value="Digestion">Digestion</option>
                        <option value="Eye">Eye</option>
                        <option value="Heart">Heart</option>
                        <option value="Infection">Infection</option>
                        <option value="Psychology">Psychology</option>
                        <option value="Virus">Virus</option>
                        <option value="Others">Others</option>
                    </select>
                    <button class="btn btn-sm btn-info" type="submit"><span class="fa fa-search"></span></button>
                </div>               
            </form>
        </div>
        <div class="col-lg-6">
            <!-- <a href="{{ route('push/sementara') }}" class="btn btn-sm btn-default pull-right">jgn di klik</a> -->
            <a href="https://www.alodokter.com/penyakit-a-z" target="_blank" class="pull-right">www.alodokter.com</a> 
        </div>
    </div>

     <div class="row">
        <div class="col-lg-12">
            <div>
            <table class="table table-striped table-bordered table-hover" width="100%" id="tablesMedical">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>No</td>
                        <td>NIK</td>                        
                        <td>Employee</td>                      
                        <td>Department</td>
                        <td>Position</td>
                        <td>Age</td>
                        <td>Sicked</td>
                        <td>Day</td>
                        <td>Recover</td>
                        <td>Category</td>
                        <td>Disease</td>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
            </div>
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
        text: 'Disease percentage in {{ date("Y") }}'
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
            name: 'Accidents',
            y: {{ $accident->count() }}
        },{
            name: 'Brains',
            y: {{ $brain->count() }}
        },{
            name: 'Cancer',
            y: {{ $cancer->count() }}
        },{
            name: 'Deficiency',
            y: {{ $deficiency->count() }}
        },{
            name: 'Digestion',
            y: {{ $digestion->count() }}
        },{
            name: 'Eyes',
            y: {{ $eye->count() }}
        },{
            name: 'Heart',
            y: {{ $heart->count() }}
        },{
            name: 'Infections',
            y: {{ $infection->count() }}
        },{
            name: 'Psychology',
            y: {{ $psychology->count() }}
        },{
            name: 'Virus',
            y: {{ $virus->count() }}
        },{
            name: 'Others',
            y: {{ $others->count() }}
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
@section('script')      
        $('#tablesMedical').DataTable({
                processing: true,
                responsive: true,
                ajax: '{{ route('sicked/summary/data') }}',
                columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable : false},  
                    { data: 'nik'},
                    { data: 'fullname'},
                    { data: 'dept'},
                    { data: 'position'},
                    { data: 'age'},
                    { data: 'sicked_date'},
                    { data: 'count_sicked'},
                    { data: 'healed_date'},
                    { data: 'category'},
                    { data: 'disease'},
                    { data: 'action'}
                ],
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ]                 
        });


     $(document).on('click','#tablesMedical tr td a[title="Detail"]',function(e) {
        e.preventDefault();
        var id = $(this).attr('data-role');
       
        $.ajax({
            url: id,            
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    }); 


@endsection
