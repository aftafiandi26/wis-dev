@extends('layout')

@section('title')
    Create Freelance
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1' => 'active'
    ])
@stop

@push('style')
@include('asset_select2')
<style>
    table tbody {
        font-size: 14px;
    }
</style>
@endpush

@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">List Freelance</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-hover table-stripped table-bordered" id="tables" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Join Date</th>
                    <th>End of Date</th>
                    <th>Request</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="modalRequest" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content-request">
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
$('#tables').DataTable({
    processing: true,
    responsive: true,

    ajax: {
        url: '{{ route('freelance/list/datatables') }}',
        type: 'GET',         
    },

    columns: [
        { data: 'DT_Row_Index', orderable: true, searchable: false},      
        { data: 'username' },      
        { data: 'fullname' },      
        { data: 'position' },      
        { data: 'joinDate' },      
        { data: 'endDate' },      
        { data: 'requested', orderable: false, searchable: false },      
        { data: 'actions', orderable: false, searchable: false },      
    ]

});
$(document).on('click','#tables tr td a[id="delete"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-delete").html(e);
        }
    });
});
$(document).on('click','#tables tr td a[id="request"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-request").html(e);
        }
    });
});

@stop