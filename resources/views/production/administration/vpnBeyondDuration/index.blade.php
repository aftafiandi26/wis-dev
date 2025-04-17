@extends('layout')

@section('title')
    admin - vpn beyond duration
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active',
    ])
@stop

@push('style')
    <style>
        .panel-heading {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }

        #form {
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">VPN Beyond Duration</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Table VPN Beyond Duration ({{ date('F') }})</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('admin-production/vpn-duration/filterForm') }}" method="post"
                                    class="form-inline" id="form">
                                    {{ csrf_field() }}
                                    <label for="month">Search By Month:</label>
                                    <select name="month" id="month" class="form-control" id="selectMonth">
                                        @foreach ($nameMonths as $key => $name)
                                            <option value="{{ $key }}"
                                                @if (date('m') == $key) selected @endif>{{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select name="year" id="selectYear" class="form-control">
                                        @for ($i = date('Y'); $i >= date('Y', strtotime('-2 Year')); $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-condensed table-hover table-stripped table-bordered"
                                    id="tables" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Employee</th>
                                            <th>Position</th>
                                            <th>Duration (Hours)</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_3')
    @include('assets_script_2')
    @include('assets_script_7')
@stop

@push('js')
    <script>
        $(document).ready(function() {
            console.log(123);

            $('#tables').DataTable({
                processing: true,
                responsive: true,
                dom: 'Bftip',
                buttons: [{
                    extend: 'excel',
                    className: 'btn-excel'
                }],
                ajax: {
                    "url": "{{ route('admin-production/vpn-duration/dataTables') }}",
                    "type": "GET",
                },
                columns: [{
                        data: 'DT_Row_Index',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: "nik"
                    },
                    {
                        data: "fullname"
                    },
                    {
                        data: "position"
                    },
                    {
                        data: "duration"
                    },
                    {
                        data: "actions",
                        orderable: false,
                        searchable: false,
                    }
                ],
            });
        });
    </script>
@endpush
