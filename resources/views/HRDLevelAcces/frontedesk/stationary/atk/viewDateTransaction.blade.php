@extends('layout')

@section('title')
    (hr) Stationery (atk)
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')   
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'cd3' => 'active'
    ])
      
@stop

@push('style')

@endpush
@section('body')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Transactions of Stationery</h1>        
    </div>
</div>
<div class="row pull">
    <div class="col-lg-6 test">        
        <h4>Period : {{ date('F Y', strtotime($month)) }}</h4>        
    </div>
    <div class="col-lg-6">
        <a href="{{ route('stationery/atk/index') }}" class="btn btn-sm btn-default pull-right"><i class="fa fa-long-arrow-left"></i> back</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover table-striped table-condensed table-bordered" id="tablesTransactions" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Item</th>
                    <th>UOM</th>
                    <th>Brand</th>
                    <th>Out Stock</th>
                    <th>Date Out Stock</th>
                    <th>Remark</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content">
           
        </div>
    </div>
</div>
@stop

@section('bottom')
@include('assets_script_1')
@include('assets_script_2')
@include('assets_script_7')
@stop

@push('js')
@endpush

@section('script')

$('#tablesTransactions').DataTable({
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
            extend:    'excel',
            titleAttr: 'Transaction of Stationery',
            title: 'Transaction of Stationery'
        }],
    ajax: '{!! URL::route("stationery/atk/transactions/index/data", [$code, $month]) !!}',
    columns: [
            { data: 'DT_Row_Index', orderable: false, searchable : false}, 
            { data: 'employes'},         
            { data: 'item'},         
            { data: 'uom'},         
            { data: 'brand'},         
            { data: 'out_stock'},
            { data: 'date_out_stock'},
            { data: 'describe'}
        ],

}); 

@stop