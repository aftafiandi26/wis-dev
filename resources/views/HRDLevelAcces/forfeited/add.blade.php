@extends('layout')

@section('title')
    (hr) Add Forfeited
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

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
        <h1 class="page-header">Add Forfeited Leave</h1> 
    </div>
</div>
<div class="row">
    @if ($errors->any())
    <div class="alert alert-success alert-dismissible fade in">
        <a class="close" data-dismiss="alert" aria-label="close">&times;</a>        
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</div>
<div class="row">
    <div class="col-lg-12">         
        <form action="{{ route('forfeited/store', $user->id) }}" method="POST" class="form-horizontal">
               {{ csrf_field() }}
            <div class="form-group">
                  <label class="control-label col-sm-1">Employee :</label>
                  <div class="col-sm-11">
                    <p class="form-control-static">{{ $user->first_name.' '.$user->last_name }}</p>
                  </div>
            </div>
            <div class="form-group">
                  <label class="control-label col-sm-1">NIK :</label>
                  <div class="col-sm-11">
                    <p class="form-control-static">{{ $user->nik }}</p>
                  </div>
            </div>
            <div class="form-group">
                  <label class="control-label col-sm-1">Year :</label>
                  <div class="col-sm-4">
                    <input type="text" name="year" required="true" autocomplete="true" placeholder="{{ date('Y') }}" class="form-control">
                  </div>
            </div>
            <div class="form-group">
                  <label class="control-label col-sm-1">Amount :</label>
                  <div class="col-sm-4">
                    <input type="text" name="amount" required="true" autocomplete="true" placeholder="0" class="form-control" min="0">
                  </div>
            </div>

            <div class="form-group">        
                  <div class="col-sm-offset-4 col-sm-4">
                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                  </div>
            </div>
           
       </form>   
    </div>
</div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')   
@stop

