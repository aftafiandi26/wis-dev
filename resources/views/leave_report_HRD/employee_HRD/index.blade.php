@extends('layout')

@section('title')
    Employee Report
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
            <h1 class="page-header">Data Employee</h1>
        </div>
    </div>

   <div class="row">
        <div class="col-lg-12">
           <!--  <div align="right">
                <a style="margin-bottom: 15px;" class="btn btn-sm btn-primary" data-original-title="Add Data Employee" data-toggle="tooltip" data-placement="top" href="{!! URL::route('addEmployee') !!}"><span class="fa fa-plus"></span></a>
            </div> -->
            
            <div  class="col-lg-12">
            <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tables">
                <thead>
                    <tr style="white-space:nowrap">
                        <td>ID</td>
                        <td>Username</td>
                        <td>NIK</td>                        
                        <td>First Name</td>                       
                        <td>Last Name</td>
                        <td>Department</td>
                        <td>Title</td>
                        <td>Join Date</td>
                        <td>End Date</td>                       
                        <td>HD</td>
                        <td>HR</td>
                        <td>GM</td>                      
                        <td>Status</td>
                        <td>Annual<br>Balance</td>
                        <td>Exdo<br>Balance</td>
                        <td style="width: 78px;">Action</td>
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
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 9,10,11] }
        ],
        "order": [
            [ 3, "asc" ]
        ],
         "scrollX": true,
        "dom": 'Blfrtip',
        "buttons": ['excel'],
         processing: true,
        responsive: true,        
        ajax: '{!! URL::route("getEmployee-HRD") !!}'
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
