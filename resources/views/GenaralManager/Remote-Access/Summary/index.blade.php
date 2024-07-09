@extends('layout')

@section('title')
    {{ $headline }}
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
        'c2001' => 'active'
    ])
@stop

@push('style')
<style>
    sup#date {
        color: red;
    }
    div#monthly {
        margin-bottom: 10px;
    }
</style>
@endpush
@section('body')
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Summary Remote Access <sup id="date">({{ date('F', strtotime($date)) }})</sup></h1> 
    </div>
</div> 
<div class="row" id="monthly">
    <div class="col-lg-12">
        <a href="{{ route('gm/remote-access/summary/month/index', [date('Y-m', strtotime('previous month', strtotime($date)))]) }}" class="btn btn-sm btn-default" id="previous"><i class="fa fa-long-arrow-left"></i> {{ date('F', strtotime('previous month', strtotime($date))) }}</a>     
        <a href="{{ route('gm/remote-access/summary/month/index', [date('Y-m', strtotime('next month', strtotime($date)))]) }}" class="btn btn-sm btn-default" id="next">{{ date('F', strtotime('next month', strtotime($date))) }} <i class="fa fa-long-arrow-right"></i></a>
        <a href="" class="btn btn-sm btn-default" id="search"><i class="fa fa-search"></i> Search</a>
    </div>
</div>
<div class="row" id="monthly" hidden>
    <div class="col-lg-12">
       tes
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-hover table-striped table-bordered" id="tables" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Employee</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Duration <sup>(Hours)</sup></th>
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
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_4')
    @include('assets_script_7')
@stop 

@section('script')
$('table#tables').DataTable({
    "order": ["4", 'desc'],
    processing: true,
    responsive: true,
    "dom": 'Blfrtip',
    "buttons": [{
        extend: 'excel',
        text: 'Excel',
        titleAttr: 'Download List Overtimes Remote Access VPN',
        title: 'Summary Overtimes Remote Access VPN',
    }],
    ajax: '{{ route('gm/remote-access/summary/index/data', [$date]) }}',
    columns: [
        { data: 'DT_Row_Index', orderable: true, searchable : false},  
        { data: 'fullname'},
        { data: 'position'},   
        { data: 'department', orderable: false, searchable : false},
        { data: 'duration'},
    ],
});

$(document).on('click','#tables tr td a[id="detail"]',function(e) {
    var id = $(this).attr('data-role');
   
    $.ajax({
        url: id,
            success: function(e) {
            $("#modal-content").html(e);
        }
    });
});

$('a#search').on('click', function () {
    console.log("123");
});
@stop