@extends('layout')

@section('title')
    (hr) Change Name Project
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
            <h1 class="page-header">Edit Name Project</h1>
        </div>
    </div>
<!-- 'route' => ['hr_mgmt-data/previlege/update-previlege', $users->id], -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">
                        <b>Form Edit Name Project</b>
                    </h5>
                </div>
      <div class="panel-body">
           {!! Form::open(['route' => ['postEditprojectHRD', $project->id], 'role' => 'form', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-2">
                                @if ($errors->has('name'))
                                    <div class="form-group has-error">
                                @else
                                    <div class="form-group">
                                @endif
                                    {!! Form::label('name', 'Project Name') !!}
                                     {!! Form::text('name', $project->project_name, ['class' => 'form-control', 'placeholder' => 'Project Name', 'maxlength' => 100]) !!}
                                    <p class="help-block">{!! $errors->first('name') !!}</p>
                            </div>
                        </div>
                    </div>

                       <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal">Save</button>
                       
                        <a class="btn btn-sm btn-warning" href="{!! URL::route('projectHRD') !!}">Back</a>
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
</div>

                    {!! Form::close() !!}
 
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
      @include('assets_script_2')
@stop
