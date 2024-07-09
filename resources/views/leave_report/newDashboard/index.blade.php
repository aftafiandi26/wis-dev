@extends('layout')

@section('title')
    Leave Entitled Report
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
        'c4' => 'active'
    ])
@stop
@section('body')
<style type="text/css">
    th.dt-center, td.dt-center { text-align: center; }
</style>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Leave Entitled</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <table class="table table-striped table-bordered table-hover text-nowrap order-column table-condensed" width="100%" id="tables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Department</th>
                            <th>Join <br>Contract</th>
                            <th>End <br>Contract</th>
                            <th>Entitled <br>Leave</th>
                            <th>Entitled <br>Day Off</th>
                            <th>Total Leave <br>and Day Off</th>
                            <th>Leave <br>Taken</th>
                            <th>Day Off <br>Taken</th>
                            <th>Total Leave <br>and Day Off Taken</th>
                            <th>Annual Leave <br>Balance</th>
                            <th>Day Off <br>Balance</th>
                            <th>Total Leave <br>& Day Off <br>Balance</th>
                        </tr>
                    </thead>
                </table>
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

@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('table#tables').DataTable({
        prosessing: true,
        responsive: true,
        ajax: '{{ route('hr/entitled/index/data') }}',
        columns: [
            { data: 'DT_Row_Index', orderable: false, searchable : false},
            { data: 'nik'},
            { data: 'fullname'},
            { data: 'emp_status'},
            { data: 'dept_category_id'},
            { data: 'join_date'},
            { data: 'end_date'},
            { data: 'initial_annual'},
            { data: 'entitled_day_off'},
            { data: 'total_leave_and_exdo'},
            { data: 'taken_leave'},
            { data: 'taken_exdo'},
            { data: 'total_taken'},
            { data: 'annual_leave'},
            { data: 'day_off_available'},
            { data: 'total_value'},


        ],
        dom: 'Bfrtip',
        buttons: [
                'pageLength', 'excel'
        ],
        deferRender: true,
    });


@stop

