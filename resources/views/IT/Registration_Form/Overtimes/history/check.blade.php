@extends('layout')

@section('title')
User of Duration Access ({{ date('M') }})
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
        'c66' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ $id }} of Duration Access ({{ date('M') }})</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-hover table-bordered table-strip" id="tables" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Employee</th>
                    <th>Position</th>
                    <th>Start OVertimes</th>
                    <th>End OVertimes</th>
                    <th>Duration (hours)</th>
                </tr>
            </thead>
        </table>
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

$('#tables').DataTable({
    "columnDefs": [
        { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [] }
    ],
    processing: true,
    responsive: true,
    "dom": 'Blfrtip',
    "buttons": [{
        extend: 'excelHtml5',
        text: '<i class="fa fa-download" style="font-size: 20px;"></i>',
        titleAttr: 'Download List Overtimes Remote Access VPN'
    }],
    ajax: '{!! URL::route("it/form/history/user/index/check/data", $id) !!}',
    columns: [
        { data: 'DT_Row_Index', orderable: false, searchable : false},
        { data: 'nik', orderable: false, searchable : false},
        { data: 'fullname', orderable: false, searchable : false},
        { data: 'deprtment', orderable: false, searchable : false},
        { data: 'startovertime'},
        { data: 'endovertime'},
        { data: 'duration'},

    ],
    });

$(document).on('click','#tables tr td a[id="detail"]',function(e) {
    var id = $(this).attr('data-role');
    console.log(id);
    $.ajax({
        url: id,
            success: function(e) {
            $("#modal-content").html(e);
        }
    });
});

@stop
