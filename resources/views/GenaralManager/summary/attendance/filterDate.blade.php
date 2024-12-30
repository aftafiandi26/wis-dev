@extends('layout')

@section('title')
    Management Attendance Summary
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
        'c6101' => 'active',
    ])
@stop

@push('style')
    <style>
        .mb-5 {
            margin-bottom: 5px;
        }

        .mb-15 {
            margin-bottom: 15px;
        }
    </style>
@endpush
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Management Attendance Summary
            </h1>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-12">
            <form action="{{ route('gm/summary/attendance/filter') }}" method="get" class="form-inline">
                <label for="">Search Date:</label>
                <input type="date" name="start" id="" value="{{ Request::get('start') }}" class="form-control">
                <input type="date" name="end" id="" value="{{ Request::get('end') }}" class="form-control">
                <button type="submit" class="btn-sm btn btn-default">
                    <i class="fa fa-search"></i>
                </button>
                <button type="reset" class="btn-sm btn btn-default" title="reset filter date">
                    <i class="fa fa-refresh"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-12">
            <form action="{{ route('gm/summary/attendance/filter/employee') }}" method="get" class="form-inline">
                {{ csrf_field() }}
                <label for="">Search Employee:</label>
                <select name="employee" id="employee" class="form-control" required>
                    <option value=""></option>
                    @foreach ($employes as $employee)
                        <option value="{{ $employee->id }}" @if ($employee->id == Request::get('id')) selected @endif>
                            {{ $employee->getFullName() }}</option>
                    @endforeach
                </select> -
                <input type="date" name="start" id="" class="form-control" required> -
                <input type="date" name="end" id="" class="form-control" required>
                <button type="submit" class="btn-sm btn btn-default">
                    <i class="fa fa-search"></i>
                </button>
                <button type="reset" class="btn-sm btn btn-default" title="reset filter date">
                    <i class="fa fa-refresh"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="row mb-15">
        <div class="col-lg-12">
            <a href="{{ route('gm/summary/attendance/index') }}" class="btn btn-sm btn-default">
                <i class="fa fa-step-backward"></i> Back
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <table class="table table-condensed table-hover table-striped table-bordered" id="tables" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Project</th>
                        <th>Date</th>
                        <th>Employes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-lg-6">
            <table class="table table-condensed table-hover table-striped table-bordered" id="showEmployes" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Employes</th>
                        <th>Position</th>
                        <th>Date</th>
                        <th>Project</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div id="chart"></div>
        </div>
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
        </div>
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_4')
    @include('assets_script_7')
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        $(document).ready(function() {
            let urlData =
                "{{ route('gm/summary/attendance/filter/data', [Request::get('start'), Request::get('end')]) }}";

            $('select#employee').select2({
                placeholder: 'choose a employee'
            });

            $('#tables').DataTable({
                processing: true,
                responsive: true,
                ajax: urlData,
                columns: [{
                    data: 'DT_Row_Index',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'group_name'
                }, {
                    data: 'dated'
                }, {
                    data: 'employes'
                }, {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }],
                dom: 'lBfrtip',
                buttons: [
                    'excel'
                ]
            });


            $(document).on('click', '#tables tr td button[id="detail"]', function(e) {
                var id = $(this).attr('data-role');

                if ($.fn.DataTable.isDataTable('#showEmployes')) {
                    $('#showEmployes').DataTable().destroy();
                }

                $('#showEmployes').DataTable({
                    processing: true,
                    responsive: true,
                    serverSide: true,
                    ajax: id,
                    columns: [{
                        data: 'DT_Row_Index',
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'employee'
                    }, {
                        data: 'position'
                    }, {
                        data: 'dated'
                    }, {
                        data: 'project'
                    }],
                    dom: 'lBfrtip',
                    buttons: [
                        'excel'
                    ]
                });
            });

            // let projects = JSON.parse('{!! json_encode($projects) !!}');
            // let categories = JSON.parse('{!! json_encode($jsonDate) !!}');

            let jsonProject = JSON.parse('{!! json_encode($jsonProjects) !!}');

            let data = JSON.parse('{!! json_encode($jsonProjects) !!}');

            const allDates = [...new Set(data.flatMap(item => item.tanggal.map(t => t.date)))];

            const categories = data.map(item => item.name);

            const series = allDates.map(date => {
                return {
                    name: date, // Tanggal sebagai nama seri
                    data: data.map(item => {
                        const record = item.tanggal.find(t => t.date === date);
                        return record ? record.countAbsen : 0; // Jika tidak ada data, isi 0
                    })
                };
            });

            var options = {
                series: series,
                chart: {
                    type: 'bar',
                    height: 450
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                dataLabels: {
                    enabled: true,
                    offsetX: -6,
                    style: {
                        fontSize: '10px',
                        colors: ['#fff']
                    }
                },
                stroke: {
                    show: true,
                    width: 1,
                    colors: ['#fff']
                },
                tooltip: {
                    shared: true,
                    intersect: false
                },
                xaxis: {
                    categories: categories,
                },
                title: {
                    text: "Attendance Summary Projects",
                    align: "center"
                },
            };
            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

        });
    </script>
@endpush
