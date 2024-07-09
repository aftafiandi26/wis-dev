@extends('layout')

@section('title')
    (it) Index Asset Item
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
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
            <h1 class="page-header">Data User</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>              
            <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>No</td>
                        <td>NIK</td>
                        <td>Username</td>
                        <td>Name</td>
                        <td>Department</td>
                        <td>Epm. Stat</td>
                        <td>EOC</td>
                        <td>Action</td>
                    </tr>
                </thead>
            </table>
            </div>
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
                extend:    'excelHtml5',
                text:      '<i class="fa fa-download" style="font-size: 20px;"></i>',
                titleAttr: 'Download List Workstation'
            }],
        ajax: '{!! URL::route("dataIndexResetPasswordIT") !!}',
         columns: [
                  { data: 'DT_Row_Index', orderable: false, searchable : false},
                  { data: 'nik'},
                  { data: 'username'},
                  { data: 'fullName'},
                  { data: 'deptName'},
                  { data: 'emp_status'},
                  { data: 'end_date'},
                  { data: 'action'}
                ],
    });    

    $(document).on('click','#tables tr td a[title="Reset Password"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });
   
@stop
