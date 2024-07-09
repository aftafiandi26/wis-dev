@extends('layout')

@section('title')
    {{ $headline }}
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active'
    ])
@stop
@section('body')
<!-- isi blade -->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Stationery Purchase</h1> 
    </div>
</div>
@include('asset_feedbackErrors')
<div class="row">
    <div class="col-lg-10">
        <div>            
            <form action="{{route('stationery/atk/month/purchase/store', [$stocks->id, $month])}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="code_item">Code Item</label>
                    <input type="text" name="code_item" value="{{$stocks->kode_barang}}" readonly="true" required="true" class="form-control">
                    <input type="hidden" name="id" value="{{$stocks->id}}">
                </div>
                <div class="form-group">
                    <label for="name_item">Item</label>
                    <input type="text" name="name_item" value="{{$stocks->name_item}}" readonly="true" required="true" class="form-control">
                </div>
                <div class="form-group">
                    <label for="brank">Brand</label>
                    <input type="text" name="brank" value="{{$stocks->merk}}" readonly="true" required="true" class="form-control">
                </div>
                <div class="form-group">
                    <label for="date_stock">Date</label>
                    <input type="date" name="date_stock" required="true" class="form-control" value="{{ date('Y-m', strtotime($month)).'-'.date('d') }}">
                </div>
                <div class="form-group">
                    <label for="qty">Qty</label>
                    <input type="number" name="qty" min="1" required="true" class="form-control" id="qty" />
                </div>  
                <button type="submit" class="btn btn-primary btn-sm">Add</button>
                <a href="{{route('stationery/atk/index')}}" class="btn btn-default btn-sm">Back</a>
            </form>
        </div>
    </div>
</div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
