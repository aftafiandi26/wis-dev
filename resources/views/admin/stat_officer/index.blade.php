@extends('layout')

@section('title')
    (Adm) Officer Access
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
         <h1><i class="fas fa-sync"></i> Officer Access</h1><hr>
    </div>
</div>

<div class="row">
    <div class = "col-lg-12">
       <table class="table table-striped table-hover" width="100%" id="officerTable">
        <thead>
          <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Employee</th>
            <th>Department</th>
            <th>Position</th>
            <th>Title</th>
            <th>Coordinator</th> 
            <th>Actions</th>
          </tr>
         </thead>
    </table>
   </div>
</div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
@section('script')

    $('#officerTable').DataTable({
        processing: true,
        ajax: '{{ route('admin/statOfficer/data') }}',
        columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable : false},                
                    { data: 'nik'},
                    { data: 'fullname'},
                    { data: 'dept_category_id'},   
                    { data: 'position'},  
                    { data: 'stat_officer'},
                    { data: 'coordinator'},
                    { data: 'action'}
                ],
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ]                 
    });

@stop

