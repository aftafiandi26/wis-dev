@extends('layout')

@section('title')
    (hr) Summary Exdo
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c173' => 'active'
    ])
@stop

@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Summary Exdo
        </h1>
    </div>
</div>
<a href="http://" target="_blank" rel="noopener noreferrer"></a>
<div class="row">
    <div class="col-lg-3">
        <a href="{{ route('forfeited/index') }}" class="btn btn-sm btn-default" title="back" style="margin-bottom: 10px;">back</a>
        <table class="table table-bordered table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>{{ $user->first_name.' '.$user->last_name }}</th>
                </tr>
                <tr>
                    <th>NIK</th>
                    <th>{{ $user->nik }}</th>
                </tr>
                <tr>
                    <th>Department</th>
                    <th>{{ $dept }}</th>
                </tr>
                <tr>
                    <th>Position</th>
                    <th>{{ $user->position }}</th>
                </tr>
                <tr>
                    <th>Status</th>
                    <th>{{ $user->emp_status }}</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-7">
        <h3 class="text-bold"><b>Expired</b></h3>
        <table class="table table-condensed table-striped table-hover table-bordered" id="countdown" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Expired</th>
                    <th>Initial</th>
                    <th>Limit</th>
                    <th>Note</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-5">
        <h3>
            <b>Index</b>
            {{-- <form action="{{ route('hr/exdo/view/generate/indexExcel') }}" method="post" class="pull-right">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $user->id }}">
                <button type="submit" class="btn btn-sm btn-default">Excel</button>
            </form> --}}
        </h3>
        <br>
        <table class="table table-bordered table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th>Expired</th>
                    <th>Remains</th>
                    <th>Total Exdo</th>                    
                </tr>
            </thead>
            <body>
                <tr>
                    <td>{{ $exdoForfeit }}</td>
                    <td>{{ $sisaExdo }}</td>
                    <td>{{ $totalExdo }}</td>
                </tr>
            </body>
        </table>
       
    </div>
    <div class="col-lg-7">
        <h3>
            <b>Transactions</b>
        </h3>
        <table class="table-bordered table-condensed table-striped table" id="transaction" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIK</th>
                    <th>Employee</th>
                    <th>Leave Date</th>
                    <th>End Leave Date</th>
                    <th>Total Day</th>
                    <th>Status Form</th>
                </tr>
            </thead>
        </table>
    </div>
    
</div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop

@section('script')
var id = "{{ $user->id }}";
var url = '{{ route("hr/exdo/view/index/datatables", ":id") }}';
var getUrl = url.replace(':id', id);


$('table#countdown').DataTable({
    processing: true,
    responsive: true,
    "dom": 'Blfrtip',
    "buttons": [{
        extend: 'excel',
        text: 'Excel',
        titleAttr: 'CountDown',
        title: 'CountDown'
    }],
    ajax: getUrl,
    columns: [
        {"data": "DT_Row_Index", orderable: false, searchable: false},
        {"data": "expired"},
        {"data": "initial"},
        {"data": "difforHumans"},
        {"data": "note"},
    ]
});

var transUrl = '{{ route("hr/exdo/view/transaction/datatables", ":iaku") }}';
var getTrans = transUrl.replace(':iaku', id);


$('table#transaction').DataTable({
    processing: true,
    responsive: true,
    "dom": 'Blfrtip',
    "buttons": [{
        extend: 'excel',
        text: 'Excel',
        titleAttr: 'transaction',
        title: 'transaction'
    }],
    ajax: getTrans,
    columns: [
        {"data": "DT_Row_Index", orderable: false, searchable: false},
        { "data": "request_nik"},
        { "data": "fullname"},
        { "data": "leave_date"},
        { "data": "end_leave_date"},
        { "data": "total_day"},
        { "data": "statusForm"},
    ]
});
@endsection