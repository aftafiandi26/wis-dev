@extends('layout')

@section('title')
    {{ $headline }}
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('asset_select2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active'
    ])
@stop

@push('style')
   <style>
    sup {
        color: grey;
    }
   </style>
@endpush
@section('body')
<!-- isi blade -->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Mineral Stock</h1> 
    </div>
</div>
@include('asset_feedbackErrors')
<div class="row">
    <div class="col-lg-10">
        <div>
            <form action="{{route('stationery/mineral/store', $month)}}" method="post">
               {{ csrf_field() }}
               <div class="form-group">
                <label for="category">Category <sup>(unique key)</sup></label>
                <input type="hidden" name="key_param" value="2">
                <select class="form-control" id="category" required="true" name="category">
                  <option value=" "> </option>
                  <?php foreach ($categories as $category): ?>
                     <option value="{{$category->unik_kategori}}">[{{$category->unik_kategori}}] - {{$category->kategori_stock }}</option>
                  <?php endforeach ?>
                </select>
              </div>
               <div class="form-group">
                <label for="code_item">Code Item <sup>(parameter key)</sup></label>
                <input type="text" name="code_item" required="true" class="form-control" id="code_item" value="{{ old('code_item') }}">
              </div>
              <div class="form-group">
                <label for="item">Item</label>
                <input type="text" name="item" required="true" class="form-control" id="item" value="{{ old('item') }}">
              </div>              
              <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" name="brand" required="true" class="form-control" id="brand" value="{{ old('brand') }}">
              </div>
              <div class="form-group">
                <label for="uom">UOM</label>
                <input type="text" min="3" id="uom" name="uom" required="true" class="form-control" value="{{ old('uom') }}">
              </div>
              <div class="form-group">
                <label for="date_stock">Date Stock</label>
                <input type="date" name="date_stock" required="true" class="form-control" id="date_stock" value="{{ date('Y-m-d') }}">
              </div>
              <div class="form-group">
                <label for="qty">Qty</label>
                 <input type="text" name="qty" min="0" required="true" class="form-control" id="jumlah" value="{{ old('qty') }}">
              </div> 
              <div class="form-group">
                <label for="price">Price</label>
                 <input type="text" name="price" min="0" required="true" class="form-control" id="price" value="{{ old('price') }}" placeholder="0">
              </div>  
              <button type="submit" class="btn btn-primary btn-sm" id="add">Add</button>
              <a href="{{route('stationery/mineral/find/index', $month)}}" class="btn btn-default btn-sm">Back</a>
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

@section('script')
    $('select#category').select2();
@endsection
