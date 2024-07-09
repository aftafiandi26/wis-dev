@extends('layout')

@section('title')
    (it) Change Data Employee
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
            <h1 class="page-header">Edit Data Employee</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>New Form Employee</h4></div>
                <div class="panel-body">
                    <form action="{{ route('audit/post', $id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-2">                              
                                    @if ($errors->has('nik'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('nik', 'NIK') !!}
                                        {!! Form::text('nik', $data->nik, ['class' => 'form-control']) !!}
                                        <p class="help-block">{!! $errors->first('nik') !!}</p>
                                    </div>
                                </div> 
                              
                                <div class="col-lg-2">                              
                                    @if ($errors->has('employee'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('employee', 'Employee') !!}
                                        {!! Form::text('employee', $data->first_name.' '.$data->last_name, ['class' => 'form-control']) !!}
                                        <p class="help-block">{!! $errors->first('employee') !!}</p>
                                    </div>
                                </div> 
                              
                                <div class="col-lg-2">                              
                                    @if ($errors->has('department'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('department', 'Department') !!}
                                        {!! Form::text('department', $data->dept_category_name, ['class' => 'form-control']) !!}
                                        <p class="help-block">{!! $errors->first('department') !!}</p>
                                    </div>
                                </div>  
                              
                                <div class="col-lg-2">                              
                                    @if ($errors->has('position'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('position', 'Position') !!}
                                        {!! Form::text('position', $data->position, ['class' => 'form-control']) !!}
                                        <p class="help-block">{!! $errors->first('position') !!}</p>
                                    </div>
                                </div> 
        
                                <div class="col-lg-2">                              
                                    @if ($errors->has('join_date'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('join_date', 'Join Date') !!}
                                        {!! Form::text('join_date', $data->join_date, ['class' => 'form-control']) !!}
                                        <p class="help-block">{!! $errors->first('join_date') !!}</p>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-2">                              
                                    @if ($errors->has('username'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('username', 'Username') !!}
                                        {!! Form::text('username', $data->username, ['class' => 'form-control']) !!}
                                        <p class="help-block">{!! $errors->first('username') !!}</p>
                                    </div>
                                </div> 
                                <div class="col-lg-2">                              
                                    @if ($errors->has('email'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('email', 'Email') !!}
                                        {!! Form::email('email', $data->email, ['class' => 'form-control']) !!}
                                        <p class="help-block">{!! $errors->first('email') !!}</p>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                               <div class="col-lg-4">
                                {!! Form::submit('Save', ['class' => 'btn btn-sm btn-success']) !!}
                                <a class="btn btn-sm btn-warning" href="{{route('index-audit')}}">Back</a>
                                {!! Form::close() !!}
                               </div>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
        </div>
    </div>

    @foreach ($oldData as $old)
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Old Form Employee</h4></div>
                <div class="panel-body">
                    <form action="{{ route('audit/post/old', $old->id)  }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-2">                              
                                    @if ($errors->has('id'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('id', 'Id') !!}
                                        {!! Form::text('id', $old->id, ['class' => 'form-control', 'readonly' => 'true']) !!}
                                        <p class="help-block">{!! $errors->first('id') !!}</p>
                                    </div>
                                </div>
                                <div class="col-lg-2">                              
                                    @if ($errors->has('nik'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('nik', 'NIK') !!}
                                        {!! Form::text('nik', $old->nik, ['class' => 'form-control', 'readonly' => 'true']) !!}
                                        <p class="help-block">{!! $errors->first('nik') !!}</p>
                                    </div>
                                </div> 
                              
                                <div class="col-lg-2">                              
                                    @if ($errors->has('employee'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('employee', 'Employee') !!}
                                        {!! Form::text('employee', $old->first_name.' '.$old->last_name, ['class' => 'form-control', 'readonly' => 'true']) !!}
                                        <p class="help-block">{!! $errors->first('employee') !!}</p>
                                    </div>
                                </div>
                              
                                <div class="col-lg-2">                              
                                    @if ($errors->has('position'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('position', 'Position') !!}
                                        {!! Form::text('position', $old->position, ['class' => 'form-control', 'readonly' => 'true']) !!}
                                        <p class="help-block">{!! $errors->first('position') !!}</p>
                                    </div>
                                </div> 
        
                                <div class="col-lg-2">                              
                                    @if ($errors->has('join_date'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('join_date', 'Join Date') !!}
                                        {!! Form::text('join_date', $old->join_date, ['class' => 'form-control', 'readonly' => 'true']) !!}
                                        <p class="help-block">{!! $errors->first('join_date') !!}</p>
                                    </div>
                                </div> 

                                <div class="col-lg-2">                              
                                    @if ($errors->has('end_date'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('end_date', 'End Date') !!}
                                        {!! Form::text('end_date', $old->end_date, ['class' => 'form-control', 'readonly' => 'true']) !!}
                                        <p class="help-block">{!! $errors->first('end_date') !!}</p>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-2">                              
                                    @if ($errors->has('username'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('username', 'Username') !!}
                                        {!! Form::text('username', $old->username, ['class' => 'form-control']) !!}
                                        <p class="help-block">{!! $errors->first('username') !!}</p>
                                    </div>
                                </div> 
                                <div class="col-lg-2">                              
                                    @if ($errors->has('email'))
                                        <div class="form-group has-error">
                                    @else
                                        <div class="form-group">
                                    @endif
                                        {!! Form::label('email', 'Email') !!}
                                        {!! Form::email('email', $old->email, ['class' => 'form-control']) !!}
                                        <p class="help-block">{!! $errors->first('email') !!}</p>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                               <div class="col-lg-4">
                                {!! Form::submit('Save', ['class' => 'btn btn-sm btn-success']) !!}
                                <a class="btn btn-sm btn-warning" href="{{route('index-audit')}}">Back</a>
                                {!! Form::close() !!}
                               </div>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
        </div>
    </div>
    @endforeach
   
	
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
@stop

