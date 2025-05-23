@extends('layout')

@section('title')
    Attendance Summary
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
        'c2' => 'active',
    ])
@stop

@push('style')
    <style>
        table#tables {
            width: 100%;
        }

        div.mb-3 {
            margin-bottom: 1vh;
        }
    </style>
@endpush

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Summary Attendance</h1>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-12">
            <form action="#" method="post" class="form-inline">
                {{ csrf_field() }}
                <label for="">Search:</label>
                <select name="emp" id="emp" class="form-control" required>
                    <option value=""></option>
                    <option value="all" @if ($id == 'all') selected @endif>- all -</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if ($user->id == $id) selected @endif>
                            {{ $user->getFullname() }}</option>
                    @endforeach
                </select>
                <input type="date" name="start" id="start" class="form-control" required
                    value="{{ $start }}"> -
                <input type="date" name="end" id="end" class="form-control" required
                    value="{{ $end }}"">
                <button type="submit" class="btn-sm btn btn-default">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-condensed table-hover table-striped" id="tables" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Employee</th>
                        <th>Position</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Time</th>
                        <th>Work From :</th>
                        <th>Feel</th>
                        <th>Health</th>
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
    @include('assets_script_7')
@stop
@push('js')
    <script>
        $(document).ready(function() {

            let url = "{{ route('hod/attendance/summary/data1', [$id, $start, $end]) }}";

            $('table#tables').DataTable({
                processing: true,
                responsive: true,
                "dom": 'Blfrtip',
                "buttons": [{
                    extend: 'excel',
                    text: 'Excel',
                    titleAttr: 'Attendance',
                    title: 'Attendance'
                }],
                ajax: url,
                columns: [{
                    "data": "DT_Row_Index",
                    orderable: false,
                    searchable: false
                }, {
                    data: "fullname"
                }, {
                    data: "position"
                }, {
                    data: 'start'
                }, {
                    data: "end"
                }, {
                    data: "durations"
                }, {
                    data: "status_in"
                }, {
                    data: "feel"
                }, {
                    data: "health"
                }, {
                    data: "project"
                }]
            });

            $('select#emp').select2({
                placeholder: 'please a employee'
            });
        })
    </script>
@endpush
