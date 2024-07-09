@extends('layout')

@section('title')
    Leave
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
            <h1 class="page-header">Applying Leave</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-condensed" id="tables">
                        <thead>
                            <tr style="white-space:nowrap">
                                <th>Leave Category</th>
                                <th>Balance</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr style="white-space:nowrap">
                                <td>Annual</td>
                                <td>{{ $select->remainannual }}</td>
                                <td>
                                    @if($select->remainannual > 0 )
                                 
                                    <a href="{!! URL::route('leave/create') !!}" class="btn btn-primary btn-xs" role="button">Apply</a>
                                   
                                    @endif
                                </td>
                                <td></td>
                            </tr>
							  
                            <tr style="white-space:nowrap">
                                <td>Exdo</td>
                                <td>{{ $selectexdo->remainexdo }}</td>
                                <td>
                                    @if($selectexdo->remainexdo > 0)
                                      
                                       <a href="{!! URL::route('leave/createExdo') !!}" class="btn btn-primary btn-xs" role="button">Apply</a>
                                       
                                    @endif
                                </td>
                               
                            </tr>
							  <tr style="white-space:nowrap">
                                <td>Etc</td>
                                <td>-</td>
                                <td>@if(auth::user()->id === 226)
                                    <a href="{!! URL::route('leave/createEtc') !!}" class="btn btn-primary btn-xs" role="button">Apply</a></td>
                                    @endif
                                <td></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                
            </div>
            <p style="font-size: 11px;"><i>Note : Please check the rest of your leave, if there are differences please contact the receptionist </i></p>
        </div>
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
@stop

