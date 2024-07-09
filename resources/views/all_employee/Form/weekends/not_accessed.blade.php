@extends('layout')

@section('title')
    Weekend Crew
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@push('style')
<style>
    .text-bold {
        font-weight: bold;
    }
    #notice {
        text-align: center;
        font-weight: bold;
        color: red;
    }

    #notice h1:hover {
        text-align: center;
        font-weight: bold;
        color: maroon;
    }
    #notice h3:hover {
        text-align: center;
        font-weight: bold;
        color: maroon;
    }
</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12"><h1 class="page-header">Weekend Crew</h1>
    </div>
</div>
<div class="row">
    <div class="col-lgl-12">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">Form Registration</div>
            <div class="panel-body">

                <div class="row" id="notice">
                    <div class="col-lg-12">
                        <h1>Closed</h1>
                        <h3>Open Monday 08:00 WIB - Thursday 16:00 WIB</h3>
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
    @include('assets_script_3')
    @include('assets_script_7')
@stop

@section('script')

@stop
