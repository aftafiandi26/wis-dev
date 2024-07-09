@extends('layout')

@section('title')
    Working on Weekends- history
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
        'workingWeekends01' => 'active'
    ])
@stop
@push('style')
<style> 
    .mb-10 {
        margin-bottom: 10px;
    }   
    .btn-default {
        background-color: darkcyan;
        color: white;
    }
</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12"><h1 class="page-header">History - Working on Weekends</h1>
    </div>
</div>

<div class="row mb-10">
    <div class="col-lg-12">
        <form action="{{ route('hrd/weekend-crew/history/detail') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <label for="dateLabe">Date: </label>
            <input type="date" name="started" id="started" class="form-control" value="{{ request()->input('started', null) }}" required>
            -
            <input type="date" name="ended" id="ended" class="form-control" value="{{ request()->input('ended', null) }}" required>
            <button type="submit" class="btn-sm btn btn-default"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('hrd/weekend-crew/history/detail/emp') }}" method="post" class="form-inline">
            {{ csrf_field() }}
            <label for="dateLabe">Employee: </label>
            <select name="employee" id="employee" class="form-control" required>
                <option value=""></option>
                @foreach ($prods as $prod)
                    <option value="{{ $prod->id }}">{{ $prod->getFullName() }}</option>
                @endforeach
            </select>
            <input type="date" name="started" class="form-control" required>
            -
            <input type="date" name="ended" class="form-control" required>
            <button type="submit" class="btn-sm btn btn-default"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-hover table-striped table-bordered" width="100%" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Emloyes</th>
                    <th>Coordinator</th>
                    <th>Producer</th>
                    <th>Position</th>
                    <th>Project</th>
                    <th>Work Stat</th>
                    <th>Start</th>                    
                    <th>End</th>
                    <th>Time</th>
                    <th>With:</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="modalAction" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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

@section('script')
$('table#tables').DataTable({
    processing: true, 
    responsive: true, 

    ajax: {
        url: '{{ route('hrd/weekend-crew/history/detail/data') }}',
        type: 'POST',
        data: { 
            started: function () { return $('#started').val(); },
            ended: function () { return $('#ended').val(); },
            _token: '{{ csrf_token() }}'
        }
    },
    columns: [
            {"data": "DT_Row_Index", orderable: false, searchable : false},   
            {"data": "nik"},        
            {"data": "employes"},        
            {"data": "coordinator"},        
            {"data": "producer"},        
            {"data": "position"},        
            {"data": "project"},        
            {"data": "workStat"},        
            {"data": "start"},        
            {"data": "end"},
            {"data": "time"},
            {"data": "extra"},
            {"data": "approved"},
        ],
    dom: 'Bfrtip',
    buttons: [
            'excel'
    ],
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
});
$('select#employee').select2();
@stop
