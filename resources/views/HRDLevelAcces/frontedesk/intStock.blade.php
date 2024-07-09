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
        'c3' => 'active'
    ])
@stop
@section('body')
<!-- isi blade -->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Stationary In Stock</h1> 
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
        <div>            
            <form action="{{route('Statoonery/storeInStock', [$stocks->id])}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="kode">Kode Barang</label>
                    <input type="text" name="kode" value="{{$stocks->kode_barang}}" readonly="true" required="true" class="form-control">
                    <input type="hidden" name="id" value="{{$stocks->id}}">
                </div>
                <div class="form-group">
                    <label for="nama_item">Name Item</label>
                    <input type="text" name="nama_item" value="{{$stocks->name_item}}" readonly="true" required="true" class="form-control">
                </div>
                <div class="form-group">
                    <label for="merek">Brand</label>
                    <input type="text" name="merek" value="{{$stocks->merk}}" readonly="true" required="true" class="form-control">
                </div>
                <div class="form-group">
                    <label for="date_stock">Date</label>
                    <input type="date" name="date_stock" required="true" class="form-control">
                </div>
                <div class="form-group">
                    <label for="jumlah">Qty</label>
                    <input type="number" name="jumlah" min="1" required="true" class="form-control" id="jumlah" />
                </div>  
                <button type="submit" class="btn btn-primary btn-sm">Add</button>
                <a href="{{route('Statoonery/index')}}" class="btn btn-default btn-sm">Back</a>
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
