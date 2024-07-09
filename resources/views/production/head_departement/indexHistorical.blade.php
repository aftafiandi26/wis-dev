@extends('layout')

@section('title')
    Leave
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
            <h1 class="page-header">History of Leave of the <?php $u = DB::table('dept_category')->where('dept_category.id', '=', auth::user()->dept_category_id)->value('dept_category_name'); echo $u; ?>  Department</h1>
        </div>
    </div>
  <?php if (Auth::user()->dept_category_id === 6): ?>
    <div class="row">
        <div class="col-lg-12">
            <div align="right">
             <!-- <a style="margin-bottom: 15px;" class="btn btn-sm btn-info" data-original-title="Chart Diagram" data-toggle="tooltip" data-placement="top" href="{!! URL::route('hr_mgmt-data/getchart') !!}"><span>Chart</span></a>-->
            </div>
            
            <div>
          
            <table class="table table-striped table-hover" width="100%" id="tables">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>NIK</td>
                        <td>Name</td>
                        <td>Leave Category</td>
                        <td>Leave Date</td>
                        <td>Back Work</td>
                        <td>Total Day</td>
                        <td>Main Project</td>
                        <td>Superviosr</td>
                        <td>Coordinator</td>
                        <td>Project Manager</td>
                        <td>Producer</td>
                        <td>Head Of Department</td>
                        <td>HR Verify</td>
                        <td>HR Verification</td>
                        <td>Leave Status</td>                        
                    </tr>
                </thead>
            </table>
    </div>
  <?php else : ?>
                
        <div>          
            <table class="table table-striped table-hover" width="100%" id="tables1">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>NIK</td>
                        <td>Name</td>
                        <td>Leave Category</td>
                        <td>Leave Date</td>
                        <td>Back Work</td>
                        <td>Total Day</td>
                        <td>Head Of Department</td>
                        <td>HR Verify</td>
                        <td>HR Verification</td>                        
                        <td>Leave Status</td>                        
                    </tr>
                </thead>
            </table>
      
            </div>
        </div>
    </div>
        <?php endif ?>
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
@stop

@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 11, 13] }
        ],
        "order": [
            [ 0, "des" ]
        ],
        processing: true,
        responsive: true,        
        ajax: '{!! URL::route("get-History") !!}'
    });

     $('#tables1').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 8] }
        ],
        "order": [
            [ 0, "des" ]
        ],
        
        responsive: true,        
        ajax: '{!! URL::route("get-History-office") !!}'
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