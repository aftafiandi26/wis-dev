@extends('layout')

@section('title')
    Change Previlege
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
            <h1 class="page-header">Change User Previlege s</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Change User Data</b>
                    </h5>
                </div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['mgmt-data/previlege/update-previlege', $users->id], 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
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
                                        <tr>
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
                                        </tr>
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
                                      <tr>
                                            <td style="width: 400px;">
                                                {!! Form::label('hrd', 'HR Manager') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('hrd'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->hrd === 1)
                                                        {!! Form::checkbox('hrd', 'HR Manager', true, ['placeholder' => 'HR Manager', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('hrd', 'HR Manager', false, ['placeholder' => 'HR Manager', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('hrd') !!}</p>
                                            </td>
                                        </tr>
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
                                        <tr>
                                            <td style="width: 400px;">
                                                {!! Form::label('infiniteApprove', 'Infinite Approved') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('infiniteApprove'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->infiniteApprove === 1)
                                                        {!! Form::checkbox('infiniteApprove', 'infiniteApprove', true, ['placeholder' => 'Infinite Approved', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('infiniteApprove', 'infiniteApprove', false, ['placeholder' => 'Infinite Approved', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('infiniteApprove') !!}</p>
                                            </td>
                                        </tr>
                                </table>
                            </div>
                           <div class="col-lg-4">
                                <table class="table " width="100%" id="tables">  
                                        <tr>
                                            <td style="width: 400px;">                                             
                                                {!! Form::label('lineGM', 'Special Case 1 | don\'t have PM |') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('lineGM'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->lineGM === 1)
                                                        {!! Form::checkbox('lineGM', 'Line GM', true, ['placeholder' => 'Line GM', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('lineGM', 'Line GM', false, ['placeholder' => 'Line GM', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('lineGM') !!}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 400px;">                                             
                                                {!! Form::label('forfeitcase', 'Special Case 2 | Forfeit Case |') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('forfeitcase'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($users->forfeitcase === 1)
                                                        {!! Form::checkbox('forfeitcase', 'Forfeit Case', true, ['placeholder' => 'Forfeit Case', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @else
                                                        {!! Form::checkbox('forfeitcase', 'Forfeit Case', false, ['placeholder' => 'Forfeit Case', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('forfeitcase') !!}</p>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 400px;">                                             
                                                {!! Form::label('skipCoordinator', 'Leave | Skip Coordinator') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('skipCoordinator'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($attempt)
                                                        @if ($attempt->coor == true)
                                                        {!! Form::checkbox('skipCoordinator', 'Skip Coordinator', true, ['placeholder' => 'Skip Coordinator', 'maxlength' => 5]) !!}&nbsp Yes                                                            
                                                        @else
                                                        {!! Form::checkbox('skipCoordinator', 'Skip Coordinator', false, ['placeholder' => 'Skip Coordinator', 'maxlength' => 5]) !!}&nbsp Yes
                                                        @endif
                                                    @else
                                                        {!! Form::checkbox('skipCoordinator', 'Skip Coordinator', false, ['placeholder' => 'Skip Coordinator', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('skipCoordinator') !!}</p>
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td style="width: 400px;">                                             
                                                {!! Form::label('skipSpv', 'Leave | Skip Supervisor') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('skipSpv'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($attempt)
                                                        @if ($attempt->spv == true)
                                                        {!! Form::checkbox('skipSpv', 'Skip Supervisor', true, ['placeholder' => 'Skip Supervisor', 'maxlength' => 5]) !!}&nbsp Yes                                                            
                                                        @else
                                                        {!! Form::checkbox('skipSpv', 'Skip Supervisor', false, ['placeholder' => 'Skip Supervisor', 'maxlength' => 5]) !!}&nbsp Yes
                                                        @endif
                                                    @else
                                                        {!! Form::checkbox('skipSpv', 'Skip Supervisor', false, ['placeholder' => 'Skip Supervisor', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('skipSpv') !!}</p>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 400px;">                                             
                                                {!! Form::label('skipPM', 'Leave | Skip Project Manager') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('skipPM'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($attempt)
                                                        @if ($attempt->pm == true)
                                                        {!! Form::checkbox('skipPM', 'Skip Project Manager', true, ['placeholder' => 'Skip Project Manager', 'maxlength' => 5]) !!}&nbsp Yes                                                            
                                                        @else
                                                        {!! Form::checkbox('skipPM', 'Skip Project Manager', false, ['placeholder' => 'Skip Project Manager', 'maxlength' => 5]) !!}&nbsp Yes
                                                        @endif
                                                    @else
                                                        {!! Form::checkbox('skipPM', 'Skip Project Manager', false, ['placeholder' => 'Skip Project Manager', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('skipPM') !!}</p>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td style="width: 400px;">                                             
                                                {!! Form::label('skipProducer', 'Leave | Skip Producer') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('skipProducer'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($attempt)
                                                        @if ($attempt->producer == true)
                                                        {!! Form::checkbox('skipProducer', 'Skip Producer', true, ['placeholder' => 'Skip Producer', 'maxlength' => 5]) !!}&nbsp Yes                                                            
                                                        @else
                                                        {!! Form::checkbox('skipProducer', 'Skip Producer', false, ['placeholder' => 'Skip Producer', 'maxlength' => 5]) !!}&nbsp Yes
                                                        @endif
                                                    @else
                                                        {!! Form::checkbox('skipProducer', 'Skip Producer', false, ['placeholder' => 'Skip Producer', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('skipProducer') !!}</p>
                                            </td>
                                        </tr>   
                                        <tr>
                                            <td style="width: 400px;">                                             
                                                {!! Form::label('skipHD', 'Leave | Skip HD') !!}
                                            </td>
                                            <td class="text-right">
                                                @if ($errors->has('skipHD'))
                                                    <div class="form-group has-error">
                                                @else
                                                    <div class="form-group">
                                                @endif
                                                    @if ($attempt)
                                                        @if ($attempt->hd == true)
                                                        {!! Form::checkbox('skipHD', 'Skip HD', true, ['placeholder' => 'Skip HD', 'maxlength' => 5]) !!}&nbsp Yes                                                            
                                                        @else
                                                        {!! Form::checkbox('skipHD', 'Skip HD', false, ['placeholder' => 'Skip HD', 'maxlength' => 5]) !!}&nbsp Yes
                                                        @endif
                                                    @else
                                                        {!! Form::checkbox('skipHD', 'Skip HD', false, ['placeholder' => 'Skip HD', 'maxlength' => 5]) !!}&nbsp Yes
                                                    @endif
                                                    <p class="help-block">{!! $errors->first('skipProducer') !!}</p>
                                            </td>
                                        </tr>                                         
                                </table>
                            </div>

                        </div>
                        {!! Form::submit('Change', ['class' => 'btn btn-sm btn-success']) !!}
                        <a class="btn btn-sm btn-warning" href="{!! URL::route('mgmt-data/previlege') !!}">Back</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
@stop