@extends('layout')

@section('title')
    (Adm) {{$user->first_name}} Officer Access
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@section('body')

 <div class="row">
   <div class="col-lg-12">
         <h1><i class="fas fa-sync"></i> {{ $user->first_name.' '.$user->last_name }} Access</h1><hr>
    </div>
</div>

<div class="row">
    <form action="{{ route('admin/statOfficer/upSetOfficer', $user->id) }}" method="post">
        {{ csrf_field() }}
        <div class="col-lg-12">
          <div class="form-group col-lg-2">
            <label for="nik">NIK:</label>
            <input type="text" class="form-control" id="nik" readonly value="{{ $user->nik }}">
          </div>
          <div class="form-group col-lg-2">
            <label for="employee">Employee:</label>
            <input type="text" class="form-control" id="employee" readonly value="{{ $user->first_name.' '.$user->last_name }}">
          </div>
          <div class="form-group col-lg-2">
            <label for="employee">Position:</label>
            <input type="text" class="form-control" id="employee" readonly value="{{ $user->position }}">
          </div>
           <div class="form-group col-lg-2">
            <label for="employee">Deparment:</label>
            <input type="text" class="form-control" id="employee" readonly value="{{ $dept->dept_category_name }}">
          </div>         
        </div>

        <div class="col-lg-12">           
             <div class="form-group col-lg-2">
                <label for="access">Select Access:</label>
                <div class="checkbox">
                  <label><input type="checkbox" value="1" name="coor" 
                    <?php if ($user->koor === 1): ?>
                        checked
                    <?php endif ?>
                    >Coordinator</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="1" name="spv"
                     <?php if ($user->spv === 1): ?>
                        checked
                    <?php endif ?>
                    >Supervisor</label>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group col-lg-2">                
                <button type="submit" class="btn btn-success btn-sm">save</button>            
                <a href="{{ route('admin/statOfficer/index') }}" class="btn btn-sm btn-default">back</a>
            </div>
        </div>
    </form>
</div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
