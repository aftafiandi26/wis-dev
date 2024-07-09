@extends('layout')

@section('title')
    Summary Attendance
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
        'c12345' => 'active'
    ])
@stop
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Phone Books</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="">
          <table class="table table-hover table-bordered table-condensed table-striped" id="tablePhone">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Employee</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Project</th>
                </tr>
            </thead>
          </table>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!--  -->
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

@section('script')
$('[data-toggle="tooltip"]').tooltip();

    $('#tablePhone').DataTable({
        processing: true,
        ajax: '{{ route('production/phonebook/data') }}',
        columns: [
            {data: 'DT_Row_Index', orderable: false, searchable : false},
            {data: 'nik'},
            {data: 'fullname'},
            {data: 'position'},
            {data: 'department'},
            {data: 'email'},
            {data: 'project'},
        ],
        dom: 'Bfrtip',
        buttons: [
            'excel',
        ]
    });

    $(document).on('click','#tablePhone tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id,
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });
@stop
