@extends('layout')

@section('title')
    (hr) Add Initial Leave - Exdo Expired
@stop

@section('top')
    @include('assets_css_1')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c1' => 'active'
    ])
@stop

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Change Date Exdo Expired</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Change Date Exdo</b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['hr_mgmt-data/initial/exdo/update', $id],'role' => 'form', 'autocomplete' => 'off']) !!}
                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('NIK'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('nik', 'NIK') !!}
                					{!! Form::text('nik', $data->nik, ['class' => 'form-control', 'placeholder' => 'NIK', 'maxlength' => 20, 'required' => true, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('nik') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('name'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('name', 'Employess') !!}
                                    {!! Form::text('name', $data->first_name.' '.$data->last_name, ['class' => 'form-control', 'placeholder' => 'First Name', 'maxlength' => 20, 'required' => true, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('name') !!}</p>
                                    </div>
                            </div>                           

                            <div class="col-lg-2">
                                @if ($errors->has('department'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('department', 'Department') !!}
                                    {!! Form::text('department', $data->dept_category_name, ['class' => 'form-control', 'placeholder' => 'Department', 'maxlength' => 20, 'required' => true, 'readonly' => true]) !!}
                                    <p class="help-block">{!! $errors->first('department') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('expired'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('expired', 'Exdo Expired') !!}
                                    {!! Form::date('expired', $data->expired, ['class' => 'form-control', 'maxlength' => 20, 'required' => true, 'readonly' => false]) !!}
                                    <p class="help-block">{!! $errors->first('expired') !!}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                @if ($errors->has('initial'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('initial', 'Entitlement Leave') !!}
                                    {!! Form::text('initial', $data->initial, ['class' => 'form-control', 'maxlength' => 20, 'required' => true, 'readonly' => false]) !!}
                                    <p class="help-block">{!! $errors->first('initial') !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                @if ($errors->has('note'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('note', 'Note Date') !!}
                                    {!! Form::textarea('note', $data->note, ['class' => 'form-control', 'maxlength' => 50, 'required' => true, 'readonly' => false]) !!}
                                    <p class="help-block">{!! $errors->first('note') !!}</p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                @if ($errors->has('note2'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('note2', 'Note') !!}
                                    {!! Form::textarea('note2', $data->note2, ['class' => 'form-control', 'maxlength' => 200, 'required' => false, 'readonly' => false]) !!}
                                    <p class="help-block">{!! $errors->first('note2') !!}</p>
                                </div>
                            </div>
                        </div>
                      
						 <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Add</button>
                       
                         <a class="btn btn-sm btn-warning" href="{!! URL::route('hr_mgmt-data/initial') !!}">Back</a>

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
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
@stop