@extends('layout')

@section('title')
    (hr) Index Employee Privilege
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active'
    ])
@stop
@section('body')

  <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Unpaid Leave</h1>
        </div>
    </div>

     <div class="row">
        <div class="col-lg-12">
            <div>
            <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>ID</td>
                        <td>NIK</td>                        
                        <td>First Name</td>                       
                        <td>Last Name</td>                       
                        <td>Department</td>
                        <td>Position</td>
                        <td>Date of Leave</td> 
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
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [ 0, "desc" ]
        ],
        processing: true,
        responsive: true,        
       ajax: '{!! URL::route("getUnpaidLeave") !!}' 
    });

    $(document).on('click','#tables tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });
@stop

