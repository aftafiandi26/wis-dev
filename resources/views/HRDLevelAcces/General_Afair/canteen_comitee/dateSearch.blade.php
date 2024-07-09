@extends('layout')

@section('title')
    (hr) Search Date Canteen Report
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
         'c16' => 'active'
    ])
@stop
@section('body')
<div class="container-fluid"> 
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Canteen Assessment Report</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
           <form method="get" action="{{ route('indexVotingCanteen') }}">
             {{ csrf_field() }}
              <div class="form-group row">
                <label for="getDate" class="col-sm-2 col-form-label">Get Date</label>
                <div class="col-sm-5">
                  <input type="date" class="form-control" id="getDateStarted" name="started">
                </div>
                <div class="col-sm-5">
                  <input type="date" class="form-control" id="getDateEnded" name="ended">
                </div>
              </div>
              <div class="form-group row"> 
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-sm btn-primary pull-right"  id="getDateForm">Get Data</button>
                </div>
              </div>
           </form>                 
        </div>
    </div>
</div>
@endsection