@extends('layout')

@section('title')
    (hr) Employes
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
        'c3' => 'active',
    ])
@stop

@push('css')
    <style>

    </style>
@endpush

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Employes</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <table id="Employes" class="table table-striped table-bordered table-condensed" width="100%"
                    style="font-size: 12px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nik</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Join Date</th>
                            <th>End Date</th>
                            <th>Emp. Stat. </th>
                            <th>Place of Birth</th>
                            <th>Date of Birth</th>
                            <th>Education</th>
                            <th>Education Instutition</th>
                            <th>Phone</th>
                            <th>Religion</th>
                            <th>Annual</th>
                            <th>Exdo</th>
                            <th>Status</th>
                            <th>Address</th>
                            <th>BPJS Kesehatan</th>
                            <th>BPJS Ketenagakerjaan</th>
                            <th>ID Card</th>
                            <th>NPWP</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-lg" id="modal-content">
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
        $('#Employes').DataTable({
            processing: true,
            responsive: true,
            ajax: "{{ route('hrd/management/employes/data') }}",
            columns: [{
                data: 'DT_Row_Index',
                orderable: false,
                searchable: false
            }, {
                data: 'nik'
            }, {
                data: 'first_name'
            }, {
                data: 'last_name'
            }, {
                data: 'gender'
            }, {
                data: 'department'
            }, {
                data: 'position'
            }, {
                data: 'join_date'
            }, {
                data: 'end_date'
            }, {
                data: 'emp_status'
            }, {
                data: 'pob'
            }, {
                data: 'dob'
            }, {
                data: 'education'
            }, {
                data: 'education_institution'
            }, {
                data: 'phone'
            }, {
                data: 'religion'
            }, {
                data: 'nik'
            }, {
                data: 'nik'
            }, {
                data: 'active'
            }, {
                data: 'address'
            }, {
                data: 'bpjs_kesehatan'
            }, {
                data: 'bpjs_ketenagakerjaan'
            }, {
                data: 'id_card',
                type: 'text'
            }, {
                data: 'npwp'
            }, {
                data: 'DT_Row_Index'
            }],
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                text: 'Excel',
            }],

        });
    </script>
@endpush
