@extends('layout')

@section('title')
    (it) New WS Idle Availability
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
            <h1 class="page-header">Edit Data Avaibility</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Edit</b>
                    </h5>
                </div>               

                <div class="panel-body">
                        {!! Form::open(['route' => ['store-edit/Idle', $hostname->id], 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-2">
                                @if ($errors->has('hostname'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('hostname', 'Hostname') !!}
                                    {!! Form::text('hostname', $hostname->hostname, ['class' => 'form-control', 'placeholder' => 'Enter Name Workstation', 'maxlength' => 100, 'autofocus' => true, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('hostname') !!}</p>
                                </div>
                            </div>
                       
                        <div class="col-lg-2">
                                @if ($errors->has('type'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('type', 'Type') !!}
                                    {!! Form::text('type', $hostname->type, ['class' => 'form-control', 'placeholder' => 'Enter type Workstation', 'maxlength' => 100, 'autofocus' => true, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('type') !!}</p>
                                </div>
                            </div>
                         <div class="col-lg-2">
                                @if ($errors->has('user'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('user', 'Username') !!}
                                    {!! Form::text('user', $hostname->user, ['class' => 'form-control', 'placeholder' => 'Enter a Workstation Username', 'maxlength' => 100, 'autofocus' => false, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('user') !!}</p>
                                </div>
                            </div> 

                    <div class="col-lg-2">
                                @if ($errors->has('os'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('os', 'Operating System') !!}
                                    {!! Form::text('os', $hostname->os, ['class' => 'form-control', 'placeholder' => 'Enter OS used', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('os') !!}</p>
                                </div>
                            </div>
                             <div class="col-lg-2">
                                @if ($errors->has('memory'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('memory', 'Memory') !!}
                                    {!! Form::text('memory',$hostname->memory, ['class' => 'form-control', 'placeholder' => 'Enter RAM Used', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('memory') !!}</p>
                                </div>
                            </div>
                             <div class="col-lg-2">
                                @if ($errors->has('vga'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('vga', 'VGA') !!}
                                    {!! Form::text('vga', $hostname->vga, ['class' => 'form-control', 'placeholder' => 'Enter VGA Used', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('vga') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                @if ($errors->has('location'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('location', 'Location') !!}
                                    {!! Form::text('location', $hostname->location, ['class' => 'form-control', 'placeholder' => 'Enter Location WS', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('location') !!}</p>
                                </div>
                            </div>                       
                            <div class="col-lg-10">
                                @if ($errors->has('notes'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('notes', 'Notes') !!}
                                    {!! Form::text('notes', $hostname->notes, ['class' => 'form-control', 'placeholder' => 'Enter Your Notes', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('notes') !!}</p>
                                </div>
                            </div> 
                              <div class="col-lg-12">  
                                {!! Form::submit('Add', ['class' => 'btn btn-sm btn-success']) !!}
                            <a class="btn btn-sm btn-warning" href="{!! URL::route('idle') !!}">Back</a>
                            {!! Form::close() !!}
                            </div> 
                </div>
                      <!-- {!! Form::submit('Save', ['onclick' => 'myFunction', 'title' => 'Save', 'class' => 'btn btn-sm btn-success', 'data-toggle' => 'modal', 'data-target' => '#Save'])!!}-->
						<!--<button  class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Save</button>-->
				
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

