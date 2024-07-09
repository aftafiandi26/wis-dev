@extends('layout')

@section('title')
(hr) Initial Leave - Entitlement Exdo
@stop

@section('top')
@include('assets_css_1')
@include('assets_css_2')
@include('assets_css_4')
@stop

@section('navbar')
@include('navbar_top')
@include('navbar_left', [
'c1' => 'active'
])
@stop

@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Entitlement Exdo Leave <sup><small>({{ $id }})</small></sup></h1>
    </div>
    <div class="col-lg-12" style="margin-top: -20px;">
        <a href="{{ route('hr_mgmt-data/initial') }}" class="btn btn-sm btn-default">back</a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div>
            <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables2">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>No</td>
                        <td>NIK</td>
                        <td>Employee</td>
                        <td>Department</td>
                        <td>Position</td>
                        <td>Entitlement</td>
                        <td>Expired</td>
                        <td>Created</td>
                        <td>Note</td>
                        <td style="width: 78px;">Action</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
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
@include('assets_script_7')
@stop

@section('script')
$('[data-toggle="tooltip"]').tooltip();

$('table#tables2').DataTable({
    processing: true,
    responsive: true,
    ajax: '{{ route('hr/entitlement/exdo/data', [$id]) }}',
    columns: [
        { data: 'DT_Row_Index', orderable: true, searchable : false},
        { data: 'nik'},
        { data: 'fullname'},
        { data: 'department'},
        { data: 'position'},
        { data: 'initial'},
        { data: 'expired'},
        { data: 'note'},
        { data: 'note2'},
        { data: 'actions'},
    ],
    dom: 'Bfrtip',
            buttons: [
            'excel'
    ],
});

$(document).on('click','#tables2 tr td a[title="edit"]',function(e) {
    e.preventDefault();
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
