@extends('layout')

@section('title')
    Summary Attendance (WFH)
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
            <h1 class="page-header">Summary Attendance (WFH)</h1>
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-10">
            <form action="{{ route('headOfProduction/findName') }}" method="get" class="form-inline" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="deparments">Departments :</label>
                   <select name="dept" id="deparments" class="form-control" required>
                    <option value="">- All -</option>
                        @foreach ($dept as $value)
                            <option value="{{ $value->id }}">{{ $value->dept_category_name }}</option>
                        @endforeach
                   </select>
                  </div>
                  <div class="form-group">
                    <label for="date">Date :</label>
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
                        <td>NIK</td>
                        <td>Employe</td>
                        <td>Position</td>
                        <td>Deparment</td>
                        <td>Time In</td>
                        <td>Time Out</td>
                        <td>Working Hours</td>
                        <td>Date</td>
                        <td style="width: 78px;">Action</td>
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
@stop

@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('#attendance').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('headOfProduction/index/data') }}',
        columns: [
            {data: 'DT_Row_Index', orderable: false, searchable : false},
            {data: 'nik'},
            {data: 'fullName'},
            {data: 'position'},
            {data: 'dept_category_id'},
            {data: 'timeIN'},
            {data: 'timeOUT'},
            {data: 'time'},
            {data: 'date_check_in'},
            {data: 'action'},
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
