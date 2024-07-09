@extends('layout')

@section('title')
    {{ $headline }}
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'cd3' => 'active'
    ])
@stop

@push('style')
    <style>
        .textHeadling {
            margin-top: 20px;
        }   
       
    </style>
@endpush
@section('body')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mineral Water Summary <br> <small>{{ $stocked->name_item }}</small> </h1> 
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-condensed table-bordered table-striped table-hover" id="tables" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>UOM</th>
                    <th>Qty</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Total (price)</th>
                    <th>Remarks</th>
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
const formatter = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0,
});

$('table#tables').DataTable({
    processing: true,
    responsive: true,
    ajax: '{{ route('statinery/mineral/tracking/index/data', $stocked->kode_barang) }}',
    columns: [
        { data: 'DT_Row_Index', orderable: false, searchable : false},
        { data: 'employes'},
        { data: 'department'},
        { data: 'position'},
        { data: 'uom'},
        { data: 'out_stock'},
        { data: 'date_out_stock'},
        { data: 'price_format'},
        { data: 'totalPrice'},
        { data: 'describe'}
    ],
    dom: 'Bfrtip',
    buttons: [
       'excel', 'pdf'
    ]

});
@endsection