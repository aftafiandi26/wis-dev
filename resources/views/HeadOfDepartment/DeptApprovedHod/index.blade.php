@extends('layout')

@section('title')
    Index Head of Department Approval
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
 <div class="row">
        <div class="col-lg-12">
            <h1>Head of Department Approval</h1>
        </div>
    </div>
 <div class="row">
 <div class = "col-lg-12">
   <table class="table table-striped table-hover" width="100%" id="tables">
    <thead>
      <tr>
        <th>Leave Date</th>
        <th>NIK</th>
        <th>Name</th>
        <th>Leave Category</th>
        <th>Department</th>
        <th>Total Day</th>
        <th>Head of Department Approval</th>
        <th>General Manager Approval</th>
        <th>Actions</th>
      </tr>
     </thead>
    </table>
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
        serverSide: true,
        responsive: true,
        ajax: '{{ route("head-of-approval/index/data") }}',
        columns: [
           { data: 'leave_date'},
           { data: 'request_nik'},
           { data: 'request_by'},
           { data: 'leave_category_name'},
           { data: 'request_dept_category_name'},
           { data: 'total_day'},
           { data: 'ap_producer'},
           { data: 'ap_gm'},
           { data: 'action'}
        ]
    });

    $(document).on('click','#tables tr td a[title="Approved"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id,
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });
@stop

