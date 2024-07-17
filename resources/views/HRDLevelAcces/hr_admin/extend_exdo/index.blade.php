@extends('layout')

@section('title')
    HR - Extended of Exdo
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')
@stop

@push('style')
<style>
    .text-center {
        text-align: center;
    }
    .btn-excel {
        background-color: #4CAF50; /* Warna latar belakang hijau */
        color: white; /* Warna teks putih */
        border: none; /* Hapus border */
        padding: 10px 20px; /* Padding */
        text-align: center; /* Rata tengah teks */
        text-decoration: none; /* Hapus garis bawah teks */
        display: inline-block; /* Tampilkan sebagai blok sebaris */
        font-size: 16px; /* Ukuran font */
        margin: 4px 2px; /* Margin */
        cursor: pointer; /* Ganti kursor menjadi pointer */
        border-radius: 8px; /* Sudut membulat */
    }
    .bg-whitesmoke {
        background-color: whitesmoke;
    }
</style>
@endpush

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop

@section('body')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Extended of Exdo</h1>
    </div>
</div>  
<div class="row">
    <div class="col-lg-6">
        <table class="table table-hover table-stripped table-condensed table-bordered" width="100%" id="tableExtends">
            <thead>
                <tr>
                    <th colspan="8" class="text-center bg-whitesmoke">Approval Extended</th>
                </tr>
                <tr>
                    <th>Form ID</th>                     
                    <th>Requestor</th>
                    <th>Employes</th>
                    <th>Exdo</th>
                    <th>Expired</th>
                    <th>Changed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>        
    </div>
    <div class="col-lg-6">
        <table class="table table-hover table-stripped table-condensed table-bordered" width="100%" id="tableProgress">
            <thead>
                <tr>
                    <th colspan="9" class="text-center bg-whitesmoke">Progressing Extended</th>
                </tr>
                <tr>
                    <th>No</th>        
                    <th>Form ID</th>            
                    <th>Requestor</th>
                    <th>Employes</th>
                    <th>Exdo</th>
                    <th>Expired</th>
                    <th>Changed</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>        
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <table class="table table-hover table-stripped table-condensed table-bordered" width="100%" id="tableSummary">
            <thead>
                <tr>
                    <th colspan="9" class="text-center bg-whitesmoke">Summary Extended</th>
                </tr>
                <tr>
                    <th>No</th>                     
                    <th>Form ID</th>                     
                    <th>Requestor</th>
                    <th>Employes</th>
                    <th>Exdo</th>
                    <th>Expired</th>
                    <th>Changed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>    
    </div>
</div>

<div class="modal fade" id="showModalApproval" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content-approval">
            <!--  -->
        </div>
    </div>
</div>

<div class="modal fade" id="showModalProgress" tabindex="-1" role="dialog" aria-labelledby="showModalProgress" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content-progress">
            <!--  -->
        </div>
    </

<div class="modal fade" id="showModalSummary" tabindex="-1" role="dialog" aria-labelledby="showModalSummary" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content-summary">
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

$('#tableExtends').DataTable({
    processing: true,
    responsive: true,
    dom: 'Bftip',
    buttons: [
        {
            extend: 'excel',
            className: 'btn-excel'
        },
        {
            extend: 'pdf',
            className: 'btn-pdf'
        }
    ],
    ajax: {
        "url": "{{ route('hrd/exdo-extended/data') }}",
        "type": "GET",
    },
    columns: [       
        { data: 'initial_leave_id', orderable: false},
        { data: 'coor'},
        { data: 'employee'},
        { data: 'amount'},
        { data: 'init_expired'},
        { data: 'expired'},
        { data: 'status'},
        { data: 'actions', orderable: false, searchable: false},
    ],
});

$(document).on('click','#tableExtends tr td a[id="approval"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-approval").html(e);
        }
    });
});

$('#tableProgress').DataTable({
    processing: true,
    responsive: true,
    dom: 'Bftip',
    buttons: [
        {
            extend: 'excel',
            className: 'btn-excel'
        },
        {
            extend: 'pdf',
            className: 'btn-pdf'
        }
    ],
    ajax: {
        "url": "{{ route('hrd/exdo-extended/progress') }}",
        "type": "GET",
    },
    columns: [
        { data: 'DT_Row_Index', orderable: false, searchable : false},   
        { data: 'initial_leave_id'},
        { data: 'coor'},
        { data: 'employee'},
        { data: 'amount', searchbale: false},
        { data: 'init_expired'},
        { data: 'expired'},
        { data: 'status'},
        { data: 'actions', orderable: false, searchable: false},
    ],
});
$(document).on('click','#tableProgress tr td a[id="viewProgress"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-summary").html(e);
        }
    });
});

$('#tableSummary').DataTable({
    processing: true,
    responsive: true,
    dom: 'Bftip',
    buttons: [
        {
            extend: 'excel',
            className: 'btn-excel'
        },
        {
            extend: 'pdf',
            className: 'btn-pdf'
        }
    ],
    ajax: {
        "url": "{{ route('hrd/exdo-extended/summary') }}",
        "type": "GET",
    },
    columns: [
        { data: 'DT_Row_Index', orderable: false, searchable : false},   
        { data: 'initial_leave_id'},
        { data: 'coor'},
        { data: 'employee'},
        { data: 'amount', searchbale: false},
        { data: 'init_expired'},
        { data: 'expired'},
        { data: 'status'},
        { data: 'actions', orderable: false, searchable: false},
    ],
});
$(document).on('click','#tableSummary tr td a[id="view"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-summary").html(e);
        }
    });
});

@stop