@extends('layout')

@section('title')
    (hr) Stocked
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c16' => 'active'
    ])
@stop
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Category Stationary</h1> 
    </div>
</div>

<div class="row" style="margin-bottom: 15px;">
    <div class="col-lg-4">
    <a href="{{route('addKategoryStationary')}}" class="btn btn-sm btn-info pull-right" title="Add Category"><span class="fa fa-plus"></span></a>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="table-responsive table-sm">
             <table id="employeeData" class="table table-bordered table-hover text-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="text-align: center">Unique Code</th>
                        <th style="text-align: center">Kategory</th>
                        <th style="text-align: center">Action</th>
                    </tr>
                </thead>          
            </table>
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
$('#employeeData').DataTable({
                processing: true,
                responsive: true,
                ajax: '{{ route('dataKategoryStationary') }}',
                columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable : false},     
                    { data: 'unik_kategori'},
                    { data: 'kategori_stock'},
                    { data: 'action'}          
                     
                ],
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ]                 
        });


     $(document).on('click','#employeeData tr td a[title="Detail"]',function(e) {
        e.preventDefault();
        var id = $(this).attr('data-role');
       
        $.ajax({
            url: id,            
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    }); 
@stop