@extends('layout')

@section('title')
   pipeline - WS Availability (scrapped)
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
        <h1 class="page-header">Workstation Scrapped</h1> 
    </div>
</div> 
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-hover table-bordered" id="workstations">
            <thead>
                <th>No</th>
                <th>Hostname</th>
                <th>Type</th>
                <th>User</th>
                <th>Operation Systems</th>
                <th>Memory</th>
                <th>GPU</th>
                <th>Updated by</th>
                <th>Updated Date</th>
                <th>Notes</th>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="showModalNotes" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content-notes">
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
$('table#workstations').DataTable({
    prosessing: true,
    responsive: true,
    ajax: '{{ route('pipeline/workstations/availability/scrapped/data') }}',
    columns: [
        { data: 'DT_Row_Index', orderable: false, searchable : false},
        { data: 'hostname'},
        { data: 'type'},
        { data: 'user'},
        { data: 'os'},
        { data: 'memory'},
        { data: 'vga'},
        { data: 'update_by'},
        { data: 'updated_at'},
        { data: 'noted'}
    ],
    dom: 'Bfrtip',
    buttons: [
         'excel', 'pageLength'
    ],
    deferRender: true,

});

$(document).on('click','#workstations tr td a[id="noted"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-notes").html(e);
        }
    });
});
@stop

