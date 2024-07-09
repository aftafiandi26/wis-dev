@extends('layout')

@section('title')
    (hr) Summary Statinery
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c11' => 'active'
    ])
@stop
@section('body')
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Summary Stationery</h1> 
    </div>
</div> 
<div class="row">
    <div class="col-lg-12">
       <table class="table table-sm table-striped table-bordered table-hover table-confidend" width="100%" id="summaryStationery">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Out</th>
                    <th>Date Out</th>
                    <th>In</th>
                    <th>Date In</th>
                    <th>Action</th>
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
 $('#summaryStationery').DataTable({
                processing: true,
                responsive: true,
                ajax: '{{ route('stationery/summary/stock/index/data') }}',
                columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable : false},
                    { data: 'kode_barang'},
                    { data: 'item'},
                    { data: 'total_out_items'},
                    { data: 'date_out_stock_historical'},
                    { data: 'total_in_items'},
                    { data: 'date_in_stock_historical'},
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
