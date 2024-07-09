@extends('layout')

@section('title')
    (it) New Asset Item
@stop

@section('top')
    @include('assets_css_1')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left')
@stop

@section('body')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script> 
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideDown("slow");
  });
});
</script>
<style> 
#panel, #flip {
  padding: 5px;
  text-align: center;
  background-color: #e5eecc;
  border: solid 1px #c3c3c3;
}

#panel {
  padding: 50px;
  display: none;
}
</style>

<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Input Item</h1>                     
        </div>
    </div>
   <div class="panel-body">
       <form class="form-horizontal">
        <div class="form-group">
          <label for="dept">Department</label>
          <input type="text" class="form-control" id="dept" placeholder="{{auth::user()->dept_category_id}}" name="dept" readonly="true">
        </div>
        <div class="form-group">
          <label>Asset Category</label>
          <br>
          <label class="radio-inline"><input type="radio" value="" name="1">Purchase
          <input type="radio" value="" name="2">Transfer</label>      
        </div>

       <div class="form-group">
        <button type="submit" class="btn btn-success">Save</button>
      </div>
      </form>
  </div>
@stop

