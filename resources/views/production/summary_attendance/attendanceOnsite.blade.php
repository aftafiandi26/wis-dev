@extends('layout')

@section('title')
    Summary Attendance (Onsite)
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
        'c2' => 'active'
    ])
@stop
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Summary Attendance (Onsite of Studios)</h1>
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-10">
            <form action="{{ route('attendance/finger/search') }}" method="get" class="form-inline">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="date">Search Date :</label>
                    <input type="date" class="form-control" id="date" name="date1" required>
                    -
                    <input type="date" class="form-control" id="date" name="date2" required>
                  </div>
                  <button type="submit" class="btn btn-default">Find</button>
            </form>

        </div>
        <div class="col-lg-2">
            <a href="{{ route('headOfProduction/index') }}" class="btn btn-sm btn-default pull-right">back to page</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-hover" width="100%" id="attendance">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Employe</td>
                        <td>Position</td>
                        <td>Department</td>
                        <td>Time</td>
                        <td>Status</td>
                        <td>Date</td>
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
    @include('assets_script_4')
    @include('assets_script_7')
@stop

@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('#attendance').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('attendance/finger') }}',
        columns: [
            {data: 'DT_Row_Index', orderable: false, searchable : false},
            { data: 'fullName' },
            { data: 'position'},
            { data: 'department'},
            { data: 'time'},
            { data: 'entry'},
            { data: 'date'}

        ]
    });

    $(document).on('click','#attendance tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id,
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });
@stop
