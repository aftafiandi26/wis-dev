@extends('layout')

@section('title')
    Employee Time Sheet - filter Range - Percentage (gm)
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
            <h1 class="page-header">Employee Project Time Sheet <sup>(Percentage Counting)</sup></h1>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-12">
            <form action="{{ route('gm/employee-time-sheet/dataFilter') }}" method="post" class="form-inline">
                {{ csrf_field() }}
                <label for="">Search :</label>
                <select name="" id="" class="form-control">
                    <option value="6">Production</option>
                </select>
                <label for="month">Date :</label>
                <input type="date" name="start" id="start" class="form-control" required
                    value="{{ $startDate }}"> -
                <input type="date" name="end" id="end" class="form-control" required
                    value="{{ $endDate }}">
                <label for="">Counting :</label>
                <select name="counting" id="" class="form-control" required>
                    <option value="">- choosee a counting -</option>
                    <option value="1"selected>Percentage</option>
                    <option value="2">Day</option>
                </select>
                <button type="submit" class="btn btn-sm btn-default">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row mb-15">
        <div class="col-lg-12">
            <a href="{{ route('gm/employee-time-sheet/index') }}" class="btn btn-sm btn-default"> <i
                    class="fa fa-long-arrow-left"></i> Filter</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-condensed table-hover table-striped table-bordered" id="dataFilter" width=100%>
                <thead>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Employee</th>
                    <th>Position</th>
                    @foreach ($projectGroups as $group)
                        <th>{{ $group->group_name }}</th>
                    @endforeach
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
            let urlDataFillter = "{{ route('gm/employee-time-sheet/filter/data', [$startDate, $endDate]) }}";

            console.log(urlDataFillter);

            $('#dataFilter').DataTable({
                processing: true,
                responsive: true,
                ajax: urlDataFillter,
                columns: [{
                    data: 'DT_Row_Index',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'nik'
                }, {
                    data: 'fullname'
                }, {
                    data: 'position'
                }, {
                    data: 'column1'
                }, {
                    data: 'column2'
                }, {
                    data: 'column3'
                }, {
                    data: 'column4'
                }, {
                    data: 'column5'
                }, {
                    data: 'column6'
                }, {
                    data: 'column7'
                }, {
                    data: 'column8'
                }, {
                    data: 'column9'
                }, {
                    data: 'column10'
                }, {
                    data: 'column11'
                }, {
                    data: 'column12'
                }, {
                    data: 'column13'
                }, {
                    data: 'column14'
                }, {
                    data: 'column15'
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
    </script>
@endpush
