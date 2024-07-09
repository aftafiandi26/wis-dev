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
        <h1 class="page-header">Edit Name Item Stationary</h1> 
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-lg-10">
        <div>
            <form action="{{route('saveStationaryName', [$stocks->id])}}" method="POST" enctype="multipart/form-data">
               {{ csrf_field() }}
               <div class="form-group">
                <label for="kode">Kode Barang</label>
                <input type="text" name="kode" value="{{$stocks->kode_barang}}" required="true" class="form-control">
                <input type="hidden" name="id" value="{{$stocks->id}}">
              </div>
              <div class="form-group">
                <label for="nama_item">Name Item</label>
                <input type="text" name="nama_item" id="nama_item" value="{{$stocks->name_item}}" required="true" class="form-control">
              </div>
              <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" name="satuan" id="satuan" value="{{$stocks->satuan}}" required="true" class="form-control">
              </div>
              <div class="form-group">
                <label for="merek">Brand</label>
                <input type="text" name="merek" id="merek" value="{{$stocks->merk}}" required="true" class="form-control">
              </div>
              <div class="form-group">
                <label for="total_stock">Total Stock</label>
                <input type="text" name="total_stock" id="total_stock" value="{{$stocks->stock_barang}}" required="true" class="form-control">
              </div>
              <div class="form-group">
                <label for="total_in_stock">Total In Stock</label>
                <input type="text" name="total_in_stock" id="total_in_stock" value="{{$stocks->total_in_stock}}" required="true" class="form-control">
              </div>
              <div class="form-group">
                <label for="total_out_stock">Total Out Stock</label>
                <input type="text" name="total_out_stock" id="total_out_stock" value="{{$stocks->total_out_stock}}" required="true" class="form-control">
              </div>
              <div class="form-group">
                <label for="in_purchase">In Purchase</label>
                <input type="text" name="in_purchase" id="in_purchase" value="{{$stocks->in_purchase}}" required="true" class="form-control">
              </div>
              <div class="form-group">
                <label for="balance_stock">Balance Stock</label>
                <input type="text" name="balance_stock" id="balance_stock" value="{{$stocks->balance_stock}}" required="true" class="form-control">
              </div>
              <button type="submit" class="btn btn-warning btn-sm">Save out Item</button>
              <a href="{{route('Statoonery/index')}}" class="btn btn-default btn-sm">Back to Page</a>
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
