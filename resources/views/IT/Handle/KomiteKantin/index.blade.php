@extends('layout')

@section('title')
    (it) Index Voting
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@section('body')
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Canteen Assessment</h1> 
    </div>
</div> 
<?php if (date("D") === 'Mon'): ?>
  <div class="row">
  <div class="col-lg-12">
    <h3>How about rating food this week?</h3>
  </div>
  <div class="col-lg-12">
    <form class="form-horizontal" action="{{route('storePolingKantin')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
       <div class="form-group">
          <label class="control-label col-sm-4" for="taste">Taste value:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10"  class="form-control" id="taste" name="taste" required="true" placeholder="0" title="Nilai Rasa">
          </div>
       </div>
       <div class="form-group">
          <label class="control-label col-sm-4" for="quantity">Quantity of main side dishes:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="quantity" name="quantity" required="true" placeholder="0" title=" Quantity Lauk Utama">
          </div>
       </div>
       <div class="form-group">
          <label class="control-label col-sm-4" for="nutritional">Nutritional value:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="nutritional" name="nutritional" required="true" placeholder="0" title="Nili Gizi">
          </div>
       </div>
       <div class="form-group">
          <label class="control-label col-sm-4" for="combination">Menu combination:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="combination" name="combination" required="true" placeholder="0" title="Kombinasi Menu">
          </div>
       </div>
       <div class="form-group">
          <label class="control-label col-sm-4" for="freshness">Freshness of food:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="freshness" name="freshness" required="true" placeholder="0" title="Kesegaran Bahan Makanan">
          </div>
       </div> 
      <div class="form-group">
          <label class="control-label col-sm-4" for="cleanliness">Cleanliness of food utensils:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="cleanliness" name="cleanliness" required="true" placeholder="0" title="Kebersihan Peralatan Makanan">
          </div>
       </div> 
       <div class="form-group">
          <label class="control-label col-sm-4" for="service">Canteen service:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="service" name="service" required="true" placeholder="0" title="Pelayanan Kantin">
          </div>
       </div>
       <div class="form-group">
          <label class="control-label col-sm-4" for="comment">Comment:</label>
          <div class="col-sm-8">
            <textarea class="form-control" maxlength="300" id="comment" name="comment" placeholder="What are your comments about the food this week? (max:300 words)"></textarea>
          </div>
       </div>
       <div class="form-group">
          <label class="control-label col-sm-4" for="service"></label>
          <div class="col-sm-4">
            <button type="submit" class="btn btn-sm btn-info" title="send your votes">voting</button>
             <button type="reset" class="btn btn-sm btn-danger" title="bersihkan kolom">Clean</button>
          </div>
       </div>    
    </form>
  </div>
</div>
<?php else: ?>
<div class="row">
  <div class="col-lg-12 text-center">
  <h2>Your Score : {{$score->averange}}</h2> 
  </div>  
</div>
<?php endif ?>
 @stop 


@section('bottom')
      @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 

