@extends('layout')

@section('title')
    (hr) Add Department
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
            <h1 class="page-header">Add Department</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Add Department</b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['hr_mgmt-data/department/store'], 'role' => 'form', 'autocomplete' => 'off']) !!}
                        <div class="row">
                            <div class="col-lg-6">
                                @if ($errors->has('department'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('department', 'Department') !!}<font color="red"> (*)</font>
                                    {!! Form::text('department', old('department'), ['class' => 'form-control', 'placeholder' => 'Department', 'maxlength' => 100, 'autofocus' => true, 'required' => true]) !!}
                                    <p class="help-block">{!! $errors->first('department') !!}</p>
                                </div>
                            </div>
                        </div>

                         {!! Form::submit('Add', ['class' => 'btn btn-sm btn-success']) !!}
							<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Add</button>
                       <a class="btn btn-sm btn-warning" href="{!! URL::route('hr_mgmt-data/department') !!}">Back</a>
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
		{!! Form::submit('Yes', ['onclick' => 'myFunction', 'title' => 'Add', 'class' => 'btn btn-sm btn-success', 'data-toggle' => 'modal', 'data-target' => '#Save'])!!}
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
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