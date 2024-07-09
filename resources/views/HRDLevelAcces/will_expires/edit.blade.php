@extends('layout')

@section('title')
    (it) Edit Asset Item
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
},
</style>

<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Item</h1>                     
        </div>
    </div>
   <div class="panel-body">
         {!! Form::open(['route' => ['post-edit-Asset-IT', $aset->id], 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                    {{ csrf_field() }}
     <div class="row">  
                  <div class="col-lg-3">
                                @if ($errors->has('instansi_name'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('instansi_name', 'Instansi Name') !!}<font color="red"> (*)</font>
                                    {!! Form::select('instansi_name', $instansi_name, $aset->instansi_id, ['class' => 'form-control', 'maxlength' => 10, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('instansi_name') !!}</p>
                                </div>
                            </div>                 
                        <div class="col-lg-3">                              
                                @if ($errors->has('dept'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('dept', 'Department') !!}
                                   <select class="form-control" name="dept" id="dept">
                                    <option value="0">- Select Department -</option>
                                        <optgroup label="Kinema Animasi">
                                            <?php foreach ($department as $value):?>
                                                <option value="{{$value->id}}" 
                                                    <?php               
                                                    if ($value->id === $deptt->id) {
                                                        echo "selected";
                                                    }
                                                     ?>              
                                                    >{{$value->dept_category_name}}
                                            </option> 
                                            <?php endforeach ?>                        
                                        </optgroup>

                                        <optgroup label="Kinema Production Services">
                                        </optgroup>                                 
                                        <optgroup label="Infinite Learning">
                                        </optgroup>  
                                   </select>
                                   
                                    <p class="help-block">{!! $errors->first('dept') !!}</p>
                                </div>
                            </div>                       
                            <div class="col-lg-3">
                                @if ($errors->has('asset_type'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('asset_type', 'Asset Type') !!}<font color="red"> (*)</font>
                                    {!! Form::select('asset_type', $asset_type, $aset->asset_type_id, ['class' => 'form-control', 'maxlength' => 5, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('asset_type') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                @if ($errors->has('asset_category'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('asset_category', 'Asset Category') !!}<font color="red"> (*)</font>
                                    {!! Form::select('asset_category', $asset_category, $aset->asset_category_id, ['class' => 'form-control', 'maxlength' => 5, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('asset_category') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                @if ($errors->has('category_type'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('category_type', 'Category Type') !!}<font color="red"> (*)</font>
                                    {!! Form::select('category_type', $category_type, $aset->category_type_id, ['class' => 'form-control', 'maxlength' => 5, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('category_type') !!}</p>
                                </div>
                            </div>
                         <div class="col-lg-3">                              
                                @if ($errors->has('date'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('incoming', 'Date Incoming') !!}<font color="red"> (*)</font>
                                    {!! Form::date('incoming',  $aset->date_incoming, ['class' => 'form-control', 'placeholder' => 'incoming Item', 'readonly' => false]) !!}
                                    <p class="help-block">{!! $errors->first('incoming') !!}</p>
                                </div>
                            </div>
                              <div class="col-lg-3">
                                @if ($errors->has('category_name'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('category_name', 'Category Name') !!}<font color="red"> (*)</font>
                                    {!! Form::select('category_name', $category_name, $aset->category_name, ['class' => 'form-control', 'maxlength' => 5, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('category_name') !!}</p>
                                </div>
                            </div>
                         <div class="col-lg-3">                              
                                @if ($errors->has('brand'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('brand', 'Brand') !!}
                                    {!! Form::text('brand',  $aset->item_description_name, ['class' => 'form-control', 'placeholder' => 'Brand', 'readonly' => false, 'required']) !!}
                                    <p class="help-block">{!! $errors->first('brand') !!}</p>
                                </div>
                            </div> 
                        
                            <div class="col-lg-3">                              
                                @if ($errors->has('series'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('series', 'Series/Type/Model') !!}
                                    {!! Form::text('series', $aset->model, ['class' => 'form-control', 'placeholder' => 'Series/Type/Model', 'readonly' => false, 'required']) !!}
                                    <p class="help-block">{!! $errors->first('series') !!}</p>
                                </div>
                            </div> 
                              <div class="col-lg-3">                              
                                @if ($errors->has('sn'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('sn', 'S/N') !!}
                                    {!! Form::text('sn', $aset->SN, ['class' => 'form-control', 'placeholder' => 'S/N', 'readonly' => false]) !!}
                                    <p class="help-block">{!! $errors->first('sn') !!}</p>
                                </div>
                            </div> 
                            <div class="col-lg-3">                              
                                @if ($errors->has('vendor'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('vendor', 'Vendor') !!}
                                    {!! Form::text('vendor', $aset->vendor, ['class' => 'form-control', 'placeholder' => 'Vendor Name', 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('vendor') !!}</p>
                                </div>
                            </div>
                              <div class="col-lg-3">
                                @if ($errors->has('status'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('status', 'Status Item') !!}<font color="red"> (*)</font>
                                    {!! Form::text('status', $aset->status, ['class' => 'form-control', 'maxlength' => 5, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('status') !!}</p>
                                </div>
                            </div> 
                            </div>       
  <div class="row">                     
                      <div class="col-lg-6">
                                @if ($errors->has('addtional'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('addtional', 'Addtional') !!}<font color="red"> (*)</font>
                                    {!! Form::textarea('addtional', $aset->addtional, ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('addtional') !!}</p>
                                </div>
                        </div>  

                  
<div class="col-lg-12">  
     {!! Form::submit('Save', ['class' => 'btn btn-sm btn-success']) !!}
        <a class="btn btn-sm btn-warning" href="{!! URL::route('asset-it') !!}">Back</a>
      {!! Form::close() !!}
</div>  
</div> 
</div>                    

@stop

