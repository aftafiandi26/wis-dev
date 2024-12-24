@extends('layout')

@section('title')
    (hr) Index Project
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active',
    ])
@stop

@push('style')
    <style>
        .text-green {
            color: green;
        }

        .text-red {
            color: red;
        }
    </style>
@endpush

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Project</h1>
        </div>
        <div class="col-lg-12" style="margin-bottom: 30px;">
            <a href=" {{ route('Addproject12') }} " class="btn btn-sm btn-info"> + add new project</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <table class="table table-striped table-bordered table-hover table-condensed" id="tables" width="100%">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>No</td>
                        <td>Project Name</td>
                        <td>Status</td>
                        <td>Code Project</td>
                        <td>Action</td>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-lg-8">
            <table class="table table-striped table-bordered table-hover table-condensed" id="userTables" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Employee</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Project1</th>
                        <th>Project2</th>
                        <th>Project3</th>
                        <th>Project4</th>
                        <th>Actions</th>
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
    @include('assets_script_7')
@stop
@push('js')
    <script>
        $(document).ready(function() {
            let urlData = "{{ route('getprojectHRD') }}";

            $('#tables').DataTable({
                processing: true,
                responsive: true,
                ajax: urlData,
                columns: [{
                        data: 'DT_Row_Index',
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'project_name'
                    }, {
                        data: 'actived'
                    }, {
                        data: 'group'
                    }, {
                        data: 'actions',
                        orderable: false,
                        searchable: false
                    }

                ],
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            });

            let tableUser = "{{ route('hrd/project-group/data') }}";
            console.log(tableUser);
            $('table#userTables').DataTable({
                processing: true,
                responsive: true,
                ajax: tableUser,
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
                    data: 'department'
                }, {
                    data: 'project1'
                }, {
                    data: 'project2'
                }, {
                    data: 'project3'
                }, {
                    data: 'project4'
                }, {
                    data: 'actions',
                    orderable: false,
                    seacrh: false
                }],
                dom: 'Bfrtip',
                buttons: ['excel']
            });

            $(document).on('click', '#userTables tr td a[id="userDetail"]', function(e) {
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
