@extends('layout')

@section('title')
    (hr) Change Previlege
@stop

@section('top')
    @include('assets_css_1')
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
            <h1 class="page-header">Change User Previlege</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Change User Previlege</b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['hr_mgmt-data/previlege/update-previlege', $users->id], 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
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

                            <!-- <div class="col-lg-2">
                                @if ($errors->has('level'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('level', 'Level Access') !!}
                                    {!! Form::select('level', $level, $access, ['class' => 'form-control', 'maxlength' => 5]) !!}
                                    <p class="help-block">{!! $errors->first('level') !!}</p>
                                </div>
                            </div> -->
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <table class="table " width="100%" id="tables">  
                                       <!--  <tr>
                                            <td style="width: 400px;">
                                                {!! Form::label('hr', 'Human Resource Menus') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('hr'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->hr === 1)
                                                        {!! Form::checkbox('hr', 'Human Resource', true, ['placeholder' => 'Human Resource', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('hr', 'Human Resource', false, ['placeholder' => 'Human Resource', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('hr') !!}</p>
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <td style="width: 400px;">
                                                {!! Form::label('hd', 'Head of Department') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('hd'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->hd === 1)
                                                        {!! Form::checkbox('hd', 'Head of Department', true, ['placeholder' => 'Head of Department', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('hd', 'Head of Department', false, ['placeholder' => 'Head of Department', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('hd') !!}</p>
                                            </td>
                                        </tr>
                                         <!-- <tr>
                                            <td style="width: 400px;">
                                                {!! Form::label('hd', 'HR Head of Department') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('hrd'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->hrd === 1)
                                                        {!! Form::checkbox('hrd', 'HR Head of Department', true, ['placeholder' => 'HR Head of Department', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('hrd', 'HR Head of Department', false, ['placeholder' => 'HR Head of Department', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('hrd') !!}</p>
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <td style="width: 400px;">
                                                {!! Form::label('gm', 'General Manager') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('gm'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->gm === 1)
                                                        {!! Form::checkbox('gm', 'General Manager', true, ['placeholder' => 'General Manager', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('gm', 'General Manager', false, ['placeholder' => 'General Manager', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('gm') !!}</p>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td style="width: 400px;">
                                                {!! Form::label('koor', 'Koordinator') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('koor'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->koor === 1)
                                                        {!! Form::checkbox('koor', 'Koordinator', true, ['placeholder' => 'Koordinator', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('koor', 'Koordinator', false, ['placeholder' => 'Koordinator', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('koor') !!}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 400px;">
                                                {!! Form::label('spv', 'Supervisor') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('spv'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->spv === 1)
                                                        {!! Form::checkbox('spv', 'Supervisor', true, ['placeholder' => 'Supervisor', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('spv', 'Supervisor', false, ['placeholder' => 'Supervisor', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('spv') !!}</p>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td style="width: 400px;">
                                                {!! Form::label('pm', 'Project Manager') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('pm'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->pm === 1)
                                                        {!! Form::checkbox('pm', 'Project Manager', true, ['placeholder' => 'Project Manager', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('pm', 'Project Manager', false, ['placeholder' => 'Project Manager', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('pm') !!}</p>
                                            </td>
                                        </tr>
                                          <tr>
                                            <td style="width: 400px;">
                                                {!! Form::label('producer', 'Producer') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('producer'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->producer === 1)
                                                        {!! Form::checkbox('producer', 'Producer', true, ['placeholder' => 'producer', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('producer', 'Producer', false, ['placeholder' => 'Producer', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('producer') !!}</p>
                                            </td>
                                        </tr>
                                </table>
                            </div>
                        </div>
                      
                       <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Save</button>
                       
                        <a class="btn btn-sm btn-warning" href="{!! URL::route('hr_mgmt-data/previlege') !!}">Back</a>
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
@stop

@section('bottom')
    @include('assets_script_1')
      @include('assets_script_2')
@stop