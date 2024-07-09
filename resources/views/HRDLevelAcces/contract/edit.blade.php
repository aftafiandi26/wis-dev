@extends('layout')

@section('title')
    (hr) Change Contract Employee
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
	 @include('assets_css_3')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1u' => 'collape in',
        'c1' => 'active', 'c15' => 'active'
    ])
@stop

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Contract Employee</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Update Conctract Employee</b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['storeContract/Employee', $users->id], 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('nik'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('nik', 'nik') !!}
                					{!! Form::text('nik', $users->nik, ['class' => 'form-control', 'placeholder' => 'nik', 'maxlength' => 20, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('nik') !!}</p>
                                </div>
                            </div>
                             <div class="col-lg-2">
                                @if ($errors->has('first_name'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('first_name', 'Full Name') !!}
                                    {!! Form::text('first_name', $users->first_name.' '.$users->last_name, ['class' => 'form-control', 'placeholder' => 'first_name', 'maxlength' => 20, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('first_name') !!}</p>
                                </div>
                            </div>
                             <div class="col-lg-2">
                                @if ($errors->has('position'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('position', 'Position') !!}
                                    {!! Form::text('position', $users->position, ['class' => 'form-control', 'placeholder' => 'position', 'maxlength' => 20, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('position') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                @if ($errors->has('dept_category_id'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('dept_category_id', 'Department') !!}
                                    {!! Form::text('dept_category_id', $dept, ['class' => 'form-control', 'placeholder' => 'dept_category_id', 'maxlength' => 20, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('dept_category_id') !!}</p>
                                </div>
                            </div>
                             <div class="col-lg-2">
                                @if ($errors->has('join_date'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('join_date', 'Join Date') !!}
                                    {!! Form::date('join_date', $users->join_date, ['class' => 'form-control', 'placeholder' => 'join_date', 'maxlength' => 20]) !!}
                                    <p class="help-block">{!! $errors->first('join_date') !!}</p>
                                </div>
                            </div>
                             <div class="col-lg-2">
                                @if ($errors->has('Annual'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('end_date', 'End Date') !!}
                                    {!! Form::date('end_date', $users->end_date, ['class' => 'form-control', 'placeholder' => 'end_date', 'maxlength' => 20]) !!}
                                    <p class="help-block">{!! $errors->first('end_date') !!}</p>
                                </div>                                
                            </div>
                            <div class="col-lg-2">
                                @if ($errors->has('remainannual'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('remainannual', 'Remain Annual') !!}
                                    <input type="numeric" name="remainannual" class="form-control" value="{{ $annual->remainannual }}" readonly="">
                                    <p class="help-block">{!! $errors->first('remainannual') !!}</p>
                                </div>                                
                            </div>
                            <div class="col-lg-2">
                                @if ($errors->has('remainexdo'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('remainexdo', 'Remain Exdo') !!}
                                    <input type="numeric" name="remainexdo" class="form-control" value="{{ $exdo->remainexdo }}" readonly="">
                                    <p class="help-block">{!! $errors->first('remainexdo') !!}</p>
                                </div>                                
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-12">
                             <div class="col-lg-2">
                               <div class="custom-control custom-radio" style="margin-bottom: 15px;">
                                <label>Status Employee </label>
                                <br>

                                <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" id="{{$users->id}}" name="example1" 
                                  <?php if ($users->active === 1): ?>
                                    checked="true"                
                                  <?php endif ?>
                                   value="1"  >
                                  <label class="custom-control-label" for="{{$users->id}}">Actived</label>
                                </div>
                                 <div class="custom-control custom-radio">
                                  <input type="radio" class="custom-control-input" id="{{$users->id}}" name="example1" 
                                   <?php if ($users->active === 0): ?>
                                    checked="true"          
                                  <?php endif ?>                                  
                                  value = "0">
                                  <label class="custom-control-label" for="{{$users->id}}">Deactived</label>
                                </div> 
                                </div>    
                            </div>                            
                         </div>
                        </div>
                           
                      <!-- {!! Form::submit('Save', ['onclick' => 'myFunction', 'title' => 'Save', 'class' => 'btn btn-sm btn-success', 'data-toggle' => 'modal', 'data-target' => '#Save'])!!}-->
						<!--<button  class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Save</button>-->
						
						<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Save</button>
                       <a class="btn btn-sm btn-warning" href="{!! URL::route('contract-employee') !!}">Back</a>
					 

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>         
        </div>
        <div class="modal-body">
          <p>Are you sure want to update data.</p>
        </div>
        <div class="modal-footer">
		{!! Form::submit('Save', ['onclick' => 'myFunction', 'title' => 'Save', 'class' => 'btn btn-sm btn-success', 'data-toggle' => 'modal', 'data-target' => '#Save'])!!}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
					    
                    {!! Form::close() !!}
					
                </div>
            </div>
        </div>
    </div>
	
</div>
	
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
@stop

