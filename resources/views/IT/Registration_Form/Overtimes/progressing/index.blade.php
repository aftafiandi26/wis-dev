@extends('layout')

@section('title')
Progress Overtimes Access VPN (it)
@stop

@section('top')
@include('assets_css_1')
@include('assets_css_2')
@include('assets_css_3')
@include('assets_css_4')
<style>
.text-red {
    color: red;
}

.text-lightgray {
    color: lightgray;
}
</style>
@stop

@section('navbar')
@include('navbar_top')
@include('navbar_left', [
'c64' => 'active'
])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">List Form Remote Access Request Above 23:00</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-hover table-bordered table-strip" id="tables">
            <thead>
                <th>No</th>
                <th>Username</th>
                <th>Employee</th>
                <th>Position</th>
                <th>Started</th>
                <th>Ended</th>
                <th>VPN</th>
                <th>Coordinator</th>
                <th>General Manager</th>
                <th>actions</th>
            </thead>
        </table>
    </div>
</div>


<div class="modal fade" id="modalProject" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content">
            <!--  -->
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content-edit">
            <!--  -->
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="modal-content-delete">
            <!--  -->
        </div>
    </div>
</div>

<form action="" method="post" id="postApproval">
    {{ csrf_field() }}
    <input type="submit" value="1" style="display: none">
</form>

@stop

@section('bottom')
@include('assets_script_1')
@include('assets_script_2')
@include('assets_script_7')
@stop

@section('script')
$('[data-toggle="tooltip"]').tooltip();

$('#tables').DataTable({
    "columnDefs": [
        { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [] }
    ],
    "order": [
        [0, "asc" ]
    ],
    processing: true,
    responsive: true,
    "dom": 'Blfrtip',
    "buttons": [{
        extend: 'excelHtml5',
        text: '<i class="fa fa-download" style="font-size: 20px;"></i>',
        titleAttr: 'Download List Overtimes Remote Access VPN'
    }],
    ajax: '{!! URL::route("form/overtime/progress/index/data") !!}',
    columns: [
        { data: 'DT_Row_Index', orderable: false, searchable : false},
        { data: 'username'},
        { data: 'fullname'},
        { data: 'position'},
        { data: 'startovertime'},
        { data: 'endovertime'},
        { data: 'vpn'},
        { data: 'app_coor'},
        { data: 'app_gm'},
        { data: 'actions'},
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
