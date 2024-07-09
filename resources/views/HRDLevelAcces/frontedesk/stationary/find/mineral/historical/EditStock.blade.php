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
        <h1 class="page-header">Edit Mineral Stock</h1> 
    </div>
</div>

@include('asset_feedbackErrors')

<div class="row">
    <div class="col-lg-10">
        <div>
            <form action="{{route('stationery/mineral/update', [$stock->id])}}" method="post">
               {{ csrf_field() }}
               <div class="form-group">
                <label for="code_item">Code Item</label>
                <input type="text" name="code_item" value="{{$stock->kode_barang}}" readonly class="form-control">
                <input type="hidden" name="id" value="{{$stock->id}}">
              </div>
              <div class="form-group">
                <label for="item">Name Item</label>
                <input type="text" name="item" id="item" value="{{$stock->name_item}}" required="true" class="form-control">
              </div>
              <div class="form-group">
                <label for="uom">UOM</label>
                <input type="text" name="uom" id="uom" value="{{$stock->satuan}}" required="true" class="form-control">
              </div>
              <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" value="{{$stock->merk}}" required="true" class="form-control">
              </div>             
              <button type="submit" class="btn btn-sm btn-warning btn-sm">Save</button>
              <a href="{{route('stationery/mineral/index')}}" class="btn btn-default btn-sm">Back</a>
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
