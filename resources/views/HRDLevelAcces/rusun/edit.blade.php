@extends('layout')

@section('title')
   (hr) Change Rusun
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c3' => 'active'
    ])
@stop
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Rusun</h1>
        </div>
    </div>
     <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Editing Rusun</b>
                    </h5>
                </div>
                     <div class="panel-body">
                      {!! Form::open(['route' => ['post', $users->id], 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                       {{ csrf_field() }}
                        <div class="row">
                           <div class="col-lg-2">
                                @if ($errors->has('nik'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('nik', 'NIK') !!}
                                    {!! Form::text('nik', $users->nik, ['class' => 'form-control', 'placeholder' => 'NIK', 'maxlength' => 100, 'readonly' => true]) !!}
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
                                    {!! Form::text('first_name', $users->first_name.' '.$users->last_name, ['class' => 'form-control', 'placeholder' => 'First Name', 'readonly' => true]) !!}
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
                                    {!! Form::text('position', $users->position, ['class' => 'form-control', 'placeholder' => 'Position', 'maxlength' => 100, 'readonly' => true]) !!}
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
                                    {!! Form::text('position', $dept, ['class' => 'form-control', 'placeholder' => 'Position', 'maxlength' => 100, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('dept_category_id') !!}</p>
                                </div>
                            </div>
                             <div class="col-lg-2">
                                @if ($errors->has('rusun'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('rusun', 'Rusun') !!}
                                    {!! Form::text('rusun', $users->rusun, ['class' => 'form-control', 'placeholder' => 'Rusun', 'maxlength' => 100]) !!}
                                    <p class="help-block">{!! $errors->first('rusun') !!}</p>
                                </div>
                            </div>
                             <div class="col-lg-2">
                                @if ($errors->has('rusun_stat'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('rusun_stat', 'Rusun Status') !!}
                                    {!! Form::select('rusun_stat', $rusun_stat, old('Rusun Status'), ['class' => 'form-control']) !!}
                                    <p class="help-block">{!! $errors->first('rusun_stat') !!}</p>
                                </div>
                            </div> 
                        </div>
                       <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal" >Save</button>                          
                         <a class="btn btn-sm btn-warning" href="{!! URL::route('rusun') !!}">Back</a>
                     
                    <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">  
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
                {!! Form::close() !!}
         </div>
        </div>
       </div>
   </div>
</div>                           
  </div>
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

