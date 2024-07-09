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
        <h1 class="page-header">Add Stationary Stock</h1> 
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
        <div>
            <form action="{{route('storeAddStockStationaryWater')}}" method="POST" enctype="multipart/form-data">
               {{ csrf_field() }}
               <div class="form-group">
                <label for="kategori">Category</label>
                <input type="hidden" name="key_param" value="2">
                <select class="form-control" id="kategori" required="true" name="kategori">
                  <option value=" "> </option>
                  <?php foreach ($categories as $category): ?>
                     <option value="{{$category->id}}" selected="true">{{$category->kategori_stock }}</option>
                  <?php endforeach ?>
                </select>
              </div>
               <div class="form-group">
                <label for="kode_barang">Code Item</label>
                <input type="text" name="kode_barang" required="true" class="form-control" id="kode_barang">
              </div>
              <div class="form-group">
                <label for="nama_item">Item</label>
                <input type="text" name="nama_item" required="true" class="form-control" id="nama_item">
              </div>              
              <div class="form-group">
                <label for="merek">Brand</label>
                <input type="text" name="merek" required="true" class="form-control" id="merek">
              </div>
              <div class="form-group">
                <label for="satuan">UOM</label>
                <input type="text" min="3" id="satuan" name="satuan" required="true" class="form-control">
              </div>
              <div class="form-group">
                <label for="date_stock">Date Stock</label>
                <input type="date" name="date_stock" required="true" class="form-control" id="date_stock" value="{{ date('Y-m-d') }}">
              </div>
              <div class="form-group">
                <label for="jumlah">Amount</label>
                 <input type="text" name="jumlah" min="0" required="true" class="form-control" id="jumlah" />
              </div>  
              <button type="submit" class="btn btn-primary btn-sm">Add</button>
              <a href="{{route('indexStockStationaryWater')}}" class="btn btn-default btn-sm">Back</a>
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
