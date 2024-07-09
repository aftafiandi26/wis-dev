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
        <h1 class="page-header">Add Category Stationary</h1> 
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
        <div>
            <form action="{{route('storeKategoryStationary')}}" method="POST" enctype="multipart/form-data">
               {{ csrf_field() }}
               <div class="form-group">
                <label for="kode">Unique Code Category</label>
                <input type="number" min="1" name="kode" required="true" class="form-control" id="kode">
              </div>
              <div class="form-group">
                <label for="category">Name Category Stationary</label>
                <input type="text" name="category" required="true" class="form-control" id="category">
              </div>              
              <button type="submit" class="btn btn-warning btn-sm">Save In Item</button>
              <a href="{{route('indexKategoryStationary')}}" class="btn btn-default btn-sm">Back to Page</a>
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
