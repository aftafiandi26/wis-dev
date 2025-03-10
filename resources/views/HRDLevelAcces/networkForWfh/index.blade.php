@extends('layout')

@section('title')
    (hr) Index Request Form
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
        'c300' => 'active',
    ])
@stop
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Form Request WFH</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-condensed table-striped table-hover" id="tables" width="100%">
                <thead>
                    <th>No</th>
                    <th>ID Document</th>
                    <th>Date</th>
                    <th>Requester</th>
                    <th>Job</th>
                    <th>Location</th>
                    <th>Action</th>
                </thead>
            </table>
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
            $('#tables').DataTable({
                processing: true,
                responsive: true,
                dom: 'Bftip',
                buttons: [{
                        extend: 'excel',
                        className: 'btn-excel'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-pdf'
                    }
                ],
                ajax: {
                    "url": "{{ route('hr/form/remote-access-wfh/data') }}",
                    "type": "GET",
                },
                columns: [{
                        data: 'DT_Row_Index',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: "document"
                    },
                    {
                        data: "date"
                    },
                    {
                        data: "requester"
                    },
                    {
                        data: "job"
                    },
                    {
                        data: "location"
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
