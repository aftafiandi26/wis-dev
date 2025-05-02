@extends('layout')

@section('title')
    Summary Registration Form
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
        'c69' => 'active',
    ])
@stop

@push('style')
    <style>
        .mb-3 {
            margin-bottom: 2vh;
        }
    </style>
@endpush

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Summary Registration Form s</h1>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12">
            <form action="{{ route('form/overtime/summary/filter') }}" method="post" class="form-inline">
                {{ csrf_field() }}
                <label for="employee">Employee :</label>
                <select name="employee" id="employee" class="form-control">
                    <option value=""></option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->getFullName() }}</option>
                    @endforeach
                </select>
                :
                <input type="date" name="start" id="start" class="form-control" value="{{ old('start') }}">
                :
                <input type="date" name="end" id="end" class="form-control" value="{{ old('end') }}">
                <button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover table-condensed table-strip table-bordered" id="overtimesTables" width="100%">
            <thead>
                <th>No</th>
                <th>Form</th>
                <th>NIK</th>
                <th>Employee</th>
                <th>Position</th>
                <th>Start Overtime</th>
                <th>End Overtime</th>
                <th>Coordinator</th>
                <th>General Manager</th>
                <th>IT Verify</th>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="modalProject" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
    @include('assets_script_7')
@stop

@push('js')
    <script>
        $(document).ready(function() {
            $('#employee').select2();

            $('#overtimesTables').DataTable({
                processing: true,
                responsive: true,
                ajax: "{{ route('form/overtime/summary/data') }}",
                columns: [{
                        data: 'DT_Row_Index',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'nik'
                    },
                    {
                        data: 'fullname'
                    },
                    {
                        data: 'position'
                    },
                    {
                        data: 'startovertime'
                    },
                    {
                        data: 'endovertime'
                    },
                    {
                        data: 'app_coor'
                    },
                    {
                        data: 'app_gm'
                    },
                    {
                        data: 'verify_it'
                    },
                ],

            });
            $(document).on('click', '#overtimesTabless tr td a[title="Detail"]', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-role');

                $.ajax({
                    url: id,
                    success: function(e) {
                        $("#modal-content").html(e);
                    }
                });
            });
        });
    </script>
@endpush
