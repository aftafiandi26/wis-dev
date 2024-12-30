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
            <h1 class="page-header">Management Attendance Summary</h1>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-12">
            <form action="{{ route('gm/summary/attendance/filter') }}" method="get" class="form-inline" required>
                {{ csrf_field() }}
                <label for="">Search Date:</label>
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
    <div class="row mb-5">
        <div class="col-lg-12">
            <form action="{{ route('gm/summary/attendance/filter/employee') }}" method="get" class="form-inline">
                {{ csrf_field() }}
                <label for="">Search Employee:</label>
                <select name="employee" id="employee" class="form-control" required>
                    <option value=""></option>
                    @foreach ($employes as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->getFullName() }}</option>
                    @endforeach
                </select> -
                <input type="date" name="start" id="" value="{{ old('start') }}" class="form-control"
                    required> -
                <input type="date" name="end" id="" value="{{ old('end') }}" class="form-control"
                    required>
                <button type="submit" class="btn-sm btn btn-default">
                    <i class="fa fa-search"></i>
                </button>
                <button type="reset" class="btn-sm btn btn-default" title="reset filter employee">
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
    <script>
        $(document).ready(function() {
            let urlData = "{{ route('gm/summary/attendance/index/data') }}";

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
                ],
                lengthMenu: [
                    [10, 25, 50, -1], // Nilai opsi (angka)
                    [10, 25, 50, "All"] // Label yang ditampilkan
                ],
                pageLength: 10
            });


            $(document).on('click', '#tables tr td button[id="detail"]', function(e) {
                var id = $(this).attr('data-role');
                console.log(id);

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
                    ],
                    lengthMenu: [
                        [10, 25, 50, -1], // Nilai opsi (angka)
                        [10, 25, 50, "All"] // Label yang ditampilkan
                    ],
                    pageLength: 10
                });
            });

            $('select#employee').select2({
                placeholder: 'choose a employee'
            });
        });
    </script>
@endpush
