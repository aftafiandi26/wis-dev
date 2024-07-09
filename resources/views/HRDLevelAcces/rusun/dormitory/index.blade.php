@extends('layout')

@section('title')
    (hr) Dormitory - BPJS Ketenagakerjaan
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

@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Summary Dormitory</h1>
        </div>
    </div>

    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-12">
            <a class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#createModal">Create</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <table class="table table-striped table-bordered table-hover text-nowrap" width="100%" id="tables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Employee</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Block</th>
                            <th>Room</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

   <figure>
        <div class="row">
            <div class="col-lg-6" id="container"></div>
            <div class="col-lg-6"></div>
        </div>
   </figure>
   

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>

    <div class="modal fade" id="showModalDelete" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content-delete">

            </div>
        </div>
    </div>

    <div id="createModal" class="modal fade" role="dialog">
        <div class="modal-dialog"> 
            <div class="modal-content">
                <form action="{{ route('hr/management/dorm/add') }}" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Room</h4>
                </div>
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="employee">Employee</label>
                                    <select class="form-control" name="employee" id="employee" style="width: 80%">    
                                        <option value=""></option>                                
                                        @foreach ($emp as $item)
                                            <option value="{{ $item->id }}">{{ $item->getFullName() }}</option>                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>                       
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="block">Block</label>
                                    <select name="block" id="block" class="form-control">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}">TB0{{ $i }}</option>
                                         @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="room">Room</label>
                                    <input type="number" name="room" id="room" class="form-control" placeholder="0"
                                    min="0">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">-room statu-</option>
                                        <option value="Single Free">Single Free</option>
                                        <option value="Sharing">Sharing</option>
                                        <option value="Single Paid">Single Paid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>              
                <div class="modal-footer">
                     <button type="submit" class="btn btn-sm btn-success">Add</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        
            </div>
      </div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
@push('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
@section('script')
	$('[data-toggle="tooltip"]').tooltip();

    $('table#tables').DataTable({
        prosessing: true,
        responsive: true,
        ajax: '{{ route('hr/management/dorm/data') }}',
        columns: [
            { data: 'DT_Row_Index', orderable: false, searchable : false},
            { data: 'nik'},          
            { data: 'fullname'},          
            { data: 'position'},          
            { data: 'department'},          
            { data: 'room_block'},          
            { data: 'room_number'},          
            { data: 'room_stat'},          
            { data: 'actions'},          
        ],
        dom: 'Bfrtip',
        buttons: [
             'excel'
        ],
        deferRender: true, 

    });

    $(document).on('click','#tables tr td a[title="edit"]',function(e) {       
        var id = $(this).attr('data-role');
        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });

    $(document).on('click','#tables tr td a[id="delete"]',function(e) {       
        var id = $(this).attr('data-role');
        console.log(id);
        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content-delete").html(e);
            }
        });
    });

    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Chart of Dormitories'
        },
        subtitle: {
            text: 'Source: wis.frameworks-studios.com'
        },
        xAxis: {
            categories: [
               'TB03',
               'TB05',
               'TB06',
               'TB10',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'count of people'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} people</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
            {
                name: 'Dormitories',
                data: [
                    {{ $tb03->count() }},
                    {{ $tb05->count() }},
                    {{ $tb06->count() }},
                    {{ $tb010->count() }},
                ]
        
            }            
        ]
    });

   
    $('#employee').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: 'resolve'
    });
@stop
