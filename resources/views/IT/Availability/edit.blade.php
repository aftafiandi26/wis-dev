@extends('layout')

@section('title')
    (it) Edit Data WS Availability
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
                        {!! Form::open(['route' => ['store-edit', $hostname->id], 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
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
                                    
                                    <select name="type" id="type" class="form-control" required> 
                                        @foreach ($wstype as $type)
                                            <option value="{{ $type }}"
                                            @if ($type == $hostname->type)
                                                selected
                                            @endif
                                            >{{ $type }}</option>                                            
                                        @endforeach
                                    </select>
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
                                    {!! Form::select('os', $opsystem, $hostname->os, ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
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
                                    {!! Form::text('memory', $hostname->memory, ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
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
                                    {!! Form::select('location', $map_area, $hostname->location, ['class' => 'form-control', 'placeholder' => 'Enter Location WS', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
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
                            <hr>
                            <?php if ($main_workstation != null): ?>
                            
                             <div class="col-lg-1">
                                @if ($errors->has('no_seat'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('no_seat', 'No Seat') !!}
                                    {!! Form::number('no_seat', $main_workstation->no_seat, ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true, 'required' => false, 'min' => '1']) !!}
                                    <p class="help-block">{!! $errors->first('no_seat') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                @if ($errors->has('map_user'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('map_user', 'WS MAP Name') !!}
                                    {!! Form::text('map_user', $main_workstation->user, ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true, 'readonly']) !!}
                                    <p class="help-block">{!! $errors->first('map_user') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                @if ($errors->has('area_map'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('area_map', 'Area Map') !!}
                                    {!! Form::select('area_map', $map_area, $main_workstation->area, ['class' => 'form-control', 'maxlength' => 100, 'autofocus' => true, 'required' => false]) !!}
                                    <p class="help-block">{!! $errors->first('area_map') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                @if ($errors->has('main_workstation'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('main_workstation', 'Status Workstation') !!}
                                    <select class="form-control" name="main_workstation" id="main_workstation">
                                        <option value="Main Workstations" <?php 
                                            if ($mainws != null) {
                                                echo "selected";
                                            }
                                         ?>>Main Workstations</option>
                                        <option value="Secondary Workstation" <?php 
                                            if ($secws != null) {
                                                echo "selected";
                                            }
                                         ?>>Secondary Workstation</option>
                                    </select>
                                    <p class="help-block">{!! $errors->first('main_workstation') !!}</p>
                                </div>
                            </div>
                            <hr> 
                             <?php else: ?>
                                   
                                <?php endif ?>
                              <div class="col-lg-12">  
                                {!! Form::submit('Add', ['class' => 'btn btn-sm btn-success']) !!}
                            <a class="btn btn-sm btn-warning" href="{!! URL::route('indexIT') !!}">Back</a>
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
    @include('assets_script_7')
@stop

