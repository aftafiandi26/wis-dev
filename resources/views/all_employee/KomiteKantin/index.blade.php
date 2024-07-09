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
<?php if (date('D') != 'Sun'): ?>
 
  <div class="row">
  <div class="col-lg-12">
    <h3>Rating the food this week?</h3><small><i><span style="color: red;">*</span>range value 1 - 10</i></small>
  </div>
  </div>
    
  <div class="row">
  <div class="col-lg-12">
    <form class="form-horizontal" action="{{route('storePolingKantinEmployee')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
       <div class="form-group">
          <label class="control-label col-sm-2" for="taste">Taste score:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10"  class="form-control" id="taste" name="taste" required="true" placeholder="0" title="min : 1 | max : 10">
          </div>
          <label class="control-label col-sm-2" for="quantity">Quantity Of Main Dish: <br><i style="font-size: 12px; font-weight: normal;">(<span style="color: red;">note</span> : like chicken, beef, fish, etc)</i></label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="quantity" name="quantity" required="true" placeholder="0" title="min : 1 | max : 10">
          </div>
          <label class="control-label col-sm-2" for="quality">Quality Of Side Dish: <br><i style="font-size: 12px; font-weight: normal;">(<span style="color: red;">note</span> : like tofu and its kind)</i></label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="quality" name="quality" required="true" placeholder="0" title="min : 1 | max : 10">
          </div>
       </div>
       <div class="form-group">
          <label class="control-label col-sm-2" for="freshness">Freshness Of Food:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="freshness" name="freshness" required="true" placeholder="0" title="min : 1 | max : 10">
          </div>
          <label class="control-label col-sm-2" for="cleanliness">Cleanliness Of Food Utensils:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="cleanliness" name="cleanliness" required="true" placeholder="0" title="min : 1 | max : 10">
          </div>
          <label class="control-label col-sm-2" for="service">Canteen Service:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="service" name="service" required="true" placeholder="0" title="min : 1 | max : 10">
          </div>
       </div>
       <div class="form-group">
        <?php if (auth::user()->dept_category_id === 6 and auth::user()->level_hrd === "0"): ?>
          <label class="control-label col-sm-2" for="supper">Supper Score:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="supper" name="supper" required="true" placeholder="0" title="min : 1 | max : 10">
          </div>         
        <?php endif ?>
           <label class="control-label col-sm-2" for="combination">Menu Combination:</label>
          <div class="col-sm-1">
            <input type="number" min="0" max="10" class="form-control" id="combination" name="combination" required="true" placeholder="0" title="min : 1 | max : 10">
          </div>
       </div>
       <hr>
       <div class="form-group">
            <label class="control-label col-sm-2" for="want" style="margin-top: 35px;">Food You Want To Eat:</label>
             <div class="col-sm-2">
             <p class="text-center"><label>Main dish</label></p>
            <input type="text" name="lauk_utama_option1" class="form-control" required="true" maxlength="30" title="ex: chicken, beef, fish, etc | max: 30 words" placeholder="ex: chicken, beef, fish, etc">
            </div>
            <div class="col-sm-2">
             <p class="text-center"><label>Vegetables</label></p>
            <input type="text" name="sayuran_option1" class="form-control" required="true" maxlength="30" title="ex: cabbage, toge, spinach, etc | max: 30 words" placeholder="ex: cabbage, toge, spinach, etc">
            </div>
            <div class="col-sm-2">
             <p class="text-center"><label>Side dish</label></p>
            <input type="text" name="lauk_sampingan_option1" class="form-control" required="true" maxlength="30" title="ex: tofu, tempe, etc | max: 30 words" placeholder="ex: tofu, tempe, etc">
            </div> 
       </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="unwant"  style="margin-top: 15px;">Food That You Don't Want To Eat:</label>            
        
           <div class="col-sm-2">
           <p class="text-center"><label>Main dish</label></p>
           <input type="text" name="lauk_utama_option3" class="form-control" required="true" maxlength="30" title="ex: chicken, beef, fish, etc |max: 30 words" placeholder="ex: chicken, beef, fish, etc">
          </div>
          <div class="col-sm-2">
           <p class="text-center"><label>Vegetables</label></p>
          <input type="text" name="sayuran_option3" class="form-control" required="true" maxlength="30" title="ex: cabbage, toge, spinach, etc | max: 30 words" placeholder="ex: cabbage, toge, spinach, etc">
          </div>
          <div class="col-sm-2">
           <p class="text-center"><label>Side dish</label></p>
          <input type="text" name="lauk_sampingan_option3" class="form-control" required="true" maxlength="30" title="ex: tofu, tempe, etc | max: 30 words" placeholder="ex: tofu, tempe, etc">
          </div>
         
       </div> 
       <hr>
       <div class="form-group">
          <label class="control-label col-sm-2" for="comment">Which one do you prefer:</label>
          <div class="col-sm-6">
            <div class="custom-control custom-radio" style="margin-bottom: 10px;">
              <input type="radio" id="customRadio1" name="prefer" class="custom-control-input" value="1">
              <label class="custom-control-label" for="customRadio1">Rice + Main Dish + Vegetables</label>
              <div>
              <small><span style="color: red;">*</span> Increase the portion of main dish</small>                
              </div>            
            </div>
            <div class="custom-control custom-radio">
              <input type="radio" id="customRadio2" name="prefer" class="custom-control-input" value="2">
              <label class="custom-control-label" for="customRadio2">Rice + Main Dish + Side Dish + Vegetables</label>
              <div>
              <small><span style="color: red;">*</span> The portion as usual</small>                
              </div>
            </div>
          </div>
       </div>
       <div class="form-group">
          <label class="control-label col-sm-2" for="comment">Are you vegetarian:</label>
          <div class="col-sm-6">
               <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="vegetarian" id="vegetarian1" value="1">
                <label class="form-check-label" for="vegetarian1">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="vegetarian" id="vegetarian2" value="2">
                <label class="form-check-label" for="vegetarian2">No</label>
              </div>              
          </div>
       </div>
       <hr>     
       <div class="form-group">
          <label class="control-label col-sm-2" for="comment">Comment:</label>
          <div class="col-sm-6">
            <textarea class="form-control" maxlength="500" id="comment" name="comment" placeholder="What are your comments about the food this week? (max:500 words)" style="height: 220px;" title="max: 500 words"></textarea>
          </div>
       </div>
       <div class="form-group">
          <label class="control-label col-sm-2" for="service"> </label>
          <div class="col-sm-6">
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
    <!-- <h2>Sorry, Assessment opened every friday</h2> -->
    <h2>Sorry, assessment under maintenance</h2>    
  </div>  
</div>
<?php endif ?>
 @stop 

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 

