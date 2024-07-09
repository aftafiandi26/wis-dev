@extends('layout')

@section('title')
    (dev) Freelancer
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
        <h1 class="page-header">Freelancer</h1> 
    </div>
</div> 
<div class="row">
    <div class="col-lg-12">
        @include('asset_feedbackErrors')
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover table-condensed table-striped table-bordered" id="tableFreelancer" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Position</th>
                    <th>Create By</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content-username">
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
$('#tableFreelancer').DataTable({
    processing: true,
    responsive: true,

    ajax: {
        url: '{{ route('dev/user/freelance/datatables') }}',
        type: 'GET',         
    },

    columns: [
        { data: 'DT_Row_Index', orderable: true, searchable: false},      
        { data: 'username' },      
        { data: 'fullname' }, 
        { data: 'position' }, 
        { data: 'create_by' }, 
        { data: 'actions', orderable: false, searchable: false},      
    ]

});
$(document).on('click','#tableFreelancer tr td a[id="username"]',function(e) {
    var id = $(this).attr('data-role');
    $.ajax({
        url: id,
        success: function(e) {
            $("#modal-content-username").html(e);
        }
    });
});

@stop