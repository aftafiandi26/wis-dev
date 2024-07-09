@extends('layout')

@section('title')
    Legend - WS Availability      
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

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.uikit.min.css">
<style type="text/css">
    .scroll{
  width: auto; 
  padding: 10px;
  overflow-y: scroll;
  height: 800px;
}
    .scroll1{
  width: auto; 
  
  overflow-y: scroll;
  height: 500px;
}
</style>

<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Legend Availability</h1> 
        </div>
    </div> 
 <div class="row">
        <div class="col-md-7">            
        <div class="panel-group scroll">
            <div class="panel panel-default">
              <div class="panel-heading"><b>Workstation Z400</b></div>
              <div class="panel-body">
             <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>Memory</th>
                        <th>Total</th>
                        <th>Idle</th>
                        <th>Fail</th>
                        <th>View</th>   
                                        
                    </tr>
                     <tr>
                        <td>64 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '64 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '64 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '64 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                         <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z400_64gb" title="Check Detail Workstation Z400 Memory 64 GB"><span class="glyphicon glyphicon-zoom-in"></button></button></td>
                    </tr>
                    <tr>
                        <td>48 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '48 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '48 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '48 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z400_48gb" title="Check Detail Workstation Z400 Memory 48 GB"><span class="glyphicon glyphicon-zoom-in"></button></button></td>
                    </tr>
                     <tr>
                        <td>32 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '32 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '32 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '32 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z400_32gb" title="Check Detail Workstation Z400 Memory 32 GB"><span class="glyphicon glyphicon-zoom-in"></button></button></td>
                    </tr>
                    <tr>
                        <td>24 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '24 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '24 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '24 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z400_24gb" title="Check Detail Workstation Z400 Memory 24 GB"><span class="glyphicon glyphicon-zoom-in"></button></button></td>
                    </tr>
                    <tr>
                        <td>16 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '16 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '16 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '16 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z400_16gb" title="Check Detail Workstation Z400 Memory 16 GB"><span class="glyphicon glyphicon-zoom-in"></button></button></td>
                    </tr>
                    <tr>
                        <td>12 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '12 GB')
                            ->get();
                        echo count($total);
                        ?>                            
                        </td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '12 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                       <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '12 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);                       
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z400_12gb" title="Check Detail Workstation Z400 Memory 12 GB"><span class="glyphicon glyphicon-zoom-in"></button></button></td>
                      </tr>
                    <tr>
                       <td>8 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '8 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '8 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '8 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z400_8gb" title="Check Detail Workstation Z400 Memory 8 GB"><span class="glyphicon glyphicon-zoom-in"></button></button></td>
                    </tr>
                    <tr>
                         <td>6 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '6 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '6 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '6 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z400_6gb" title="Check Detail Workstation Z400 Memory 6 GB"><span class="glyphicon glyphicon-zoom-in"></button></button></td>
                    </tr>
                    <tr>
                        <td>4 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '4 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '4 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '4 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z400_4gb" title="Check Detail Workstation Z400 Memory 4 GB"><span class="glyphicon glyphicon-zoom-in"></button></button></td>
                    </tr>
                    <tr>
                        <td>0 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '0 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '0 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z400')
                            ->where('memory', '=', '0 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z400_0gb" title="Check Detail Workstation Z400 Memory 0 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                </thead>
            </table>
              </div>            
            </div>

            <div class="panel panel-default">
              <div class="panel-heading"><b>Workstation Z200 i7</b></div>
              <div class="panel-body">
             <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>Memory</th>
                        <th>Total</th>
                        <th>Idle</th>
                        <th>Fail</th>
                        <th>View</th>                          
                    </tr>
                     <tr>
                        <td>64 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '64 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '64 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '64 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                         <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i7_64gb" title="Check Detail Workstation Z200 i7 Memory 64 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>48 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '48 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '48 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '48 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i7_48gb" title="Check Detail Workstation Z200 i7 Memory 48 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                     <tr>
                        <td>32 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '32 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '32 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '32 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i7_32gb" title="Check Detail Workstation Z200 i7 Memory 32 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>24 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '24 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '24 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '24 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i7_24gb" title="Check Detail Workstation Z200 i7 Memory 24 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>16 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '16 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '16 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '16 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i7_16gb" title="Check Detail Workstation Z200 i7 Memory 16 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>12 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '12 GB')
                            ->get();
                        echo count($total);
                        ?>                            
                        </td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '12 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                       <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '12 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i7_12gb" title="Check Detail Workstation Z200 i7 Memory 12 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                       <td>8 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '8 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '8 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '8 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i7_8gb" title="Check Detail Workstation Z200 i7 Memory 8 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                         <td>6 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '6 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '6 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '6 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i7_6gb" title="Check Detail Workstation Z200 i7 Memory 6 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>4 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '4 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '4 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                          <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '4 GB')                           
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i7_4gb" title="Check Detail Workstation Z200 i7 Memory 4 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>0 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '0 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '0 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i7')
                            ->where('memory', '=', '0 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                         <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i7_0gb" title="Check Detail Workstation Z200 i7 Memory 0 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>                      
                    </tr>
                </thead>
            </table>
              </div>            
            </div>

             <div class="panel panel-default">
              <div class="panel-heading"><b>Workstation Z200 i5</b></div>
              <div class="panel-body">
             <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>Memory</th>
                        <th>Total</th>
                        <th>Idle</th>
                        <th>Fail</th> 
                        <th>View</th>                         
                    </tr>
                     <tr>
                        <td>64 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '64 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '64 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '64 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i5_64gb" title="Check Detail Workstation Z200 i5 Memory 64 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>48 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '48 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '48 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '48 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i5_48gb" title="Check Detail Workstation Z200 i5 Memory 48 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                     <tr>
                        <td>32 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '32 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '32 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '32 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                         <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i5_32gb" title="Check Detail Workstation Z200 i5 Memory 32 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>24 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '24 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '24 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '24 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i5_24gb" title="Check Detail Workstation Z200 i5 Memory 24 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>16 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '16 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '16 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '16 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i5_16gb" title="Check Detail Workstation Z200 i5 Memory 16 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>12 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '12 GB')
                            ->get();
                        echo count($total);
                        ?>                            
                        </td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '12 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                       <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '12 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i5_12gb" title="Check Detail Workstation Z200 i5 Memory 12 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                       <td>8 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '8 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '8 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '8 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i5_8gb" title="Check Detail Workstation Z200 i5 Memory 8 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                         <td>6 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '6 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '6 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '6 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i5_6gb" title="Check Detail Workstation Z200 i5 Memory 6 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>4 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '4 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '4 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                          <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '4 GB')                           
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i5_4gb" title="Check Detail Workstation Z200 i5 Memory 4 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>  
                    </tr>
                    <tr>
                        <td>0 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->wherein('memory', ['0 GB', 'N/A', 'NULL'])
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '0 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP Z200 i5')
                            ->where('memory', '=', '0 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                         <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z200i5_0gb" title="Check Detail Workstation Z200 i5 Memory 0 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>                       
                    </tr>
                </thead>
            </table>
              </div>            
            </div>


            <div class="panel panel-default">
              <div class="panel-heading"><b>Workstation z210</b></div>
              <div class="panel-body">
             <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>Memory</th>
                        <th>Total</th>
                        <th>Idle</th>
                        <th>Fail</th>  
                        <th>View</th>                        
                    </tr>
                     <tr>
                        <td>64 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '64 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '64 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '64 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z210_64gb" title="Check Detail Workstation Z210 Memory 64 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>   
                    </tr>
                    <tr>
                        <td>48 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '48 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '48 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '48 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z210_48gb" title="Check Detail Workstation Z210 Memory 48 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>   
                    </tr>
                     <tr>
                        <td>32 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '32 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '32 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '32 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z210_32gb" title="Check Detail Workstation Z210 Memory 32 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>   
                    </tr>
                    <tr>
                        <td>24 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '24 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '24 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '24 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z210_24gb" title="Check Detail Workstation Z210 Memory 24 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>    
                    </tr>
                    <tr>
                        <td>16 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '16 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '16 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '16 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z210_16gb" title="Check Detail Workstation Z210 Memory 16 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>   
                    </tr>
                    <tr>
                        <td>12 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '12 GB')
                            ->get();
                        echo count($total);
                        ?>                            
                        </td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '12 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                       <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '12 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                     <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z210_12gb" title="Check Detail Workstation Z210 Memory 12 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>     
                    </tr>
                    <tr>
                       <td>8 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '8 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '8 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '8 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z210_8gb" title="Check Detail Workstation Z210 Memory 8 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>    
                    </tr>
                    <tr>
                         <td>6 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '6 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '6 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '6 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z210_6gb" title="Check Detail Workstation Z210 Memory 6 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>    
                    </tr>
                    <tr>
                        <td>4 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '4 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '4 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                          <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '4 GB')                           
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z210_4gb" title="Check Detail Workstation Z210 Memory 4 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>    
                    </tr>
                    <tr>
                        <td>0 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '0 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '0 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z210')
                            ->where('memory', '=', '0 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>   
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z210_0gb" title="Check Detail Workstation Z210 Memory 0 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>                      
                    </tr>
                </thead>
            </table>
              </div>            
            </div>

            <div class="panel panel-default">
              <div class="panel-heading"><b>Workstation z600</b></div>
              <div class="panel-body">
             <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>Memory</th>
                        <th>Total</th>
                        <th>Idle</th>
                        <th>Fail</th>  
                        <th>View</th>                        
                    </tr>
                     <tr>
                        <td>64 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '64 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '64 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '64 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                         <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z600_64gb" title="Check Detail Workstation z600 Memory 64 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>48 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '48 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '48 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '48 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z600_48gb" title="Check Detail Workstation z600 Memory 48 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                     <tr>
                        <td>32 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '32 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '32 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '32 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z600_32gb" title="Check Detail Workstation z600 Memory 32 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>24 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '24 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '24 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '24 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z600_24gb" title="Check Detail Workstation z600 Memory 24 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>  
                    </tr>
                    <tr>
                        <td>16 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '16 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '16 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '16 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z600_16gb" title="Check Detail Workstation z600 Memory 16 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>12 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '12 GB')
                            ->get();
                        echo count($total);
                        ?>                            
                        </td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '12 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                       <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '12 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z600_12gb" title="Check Detail Workstation z600 Memory 12 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>  
                    </tr>
                    <tr>
                       <td>8 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '8 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '8 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '8 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z600_8gb" title="Check Detail Workstation z600 Memory 8 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>  
                    </tr>
                    <tr>
                         <td>6 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '6 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '6 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '6 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z600_6gb" title="Check Detail Workstation z600 Memory 6 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>  
                    </tr>
                    <tr>
                        <td>4 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '4 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '4 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                          <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '4 GB')                           
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z600_4gb" title="Check Detail Workstation z600 Memory 4 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>  
                    </tr>
                    <tr>
                        <td>0 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '0 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '0 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z600')
                            ->where('memory', '=', '0 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z600_0gb" title="Check Detail Workstation z600 Memory 0 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>                       
                    </tr>
                </thead>
            </table>
              </div>            
            </div>


             <div class="panel panel-default">
              <div class="panel-heading"><b>Workstation z240</b></div>
              <div class="panel-body">
             <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>Memory</th>
                        <th>Total</th>
                        <th>Idle</th>
                        <th>Fail</th>  
                        <th>View</th>                        
                    </tr>
                     <tr>
                        <td>64 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '64 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '64 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '64 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z240_64gb" title="Check Detail Workstation z240 Memory 64 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>48 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '48 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '48 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '48 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z240_48gb" title="Check Detail Workstation z240 Memory 48 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                     <tr>
                        <td>32 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '32 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '32 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '32 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z240_32gb" title="Check Detail Workstation z240 Memory 32 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>24 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '24 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '24 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '24 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z240_24gb" title="Check Detail Workstation z240 Memory 24 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>16 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '16 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '16 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '16 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z240_16gb" title="Check Detail Workstation z240 Memory 16 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>12 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '12 GB')
                            ->get();
                        echo count($total);
                        ?>                            
                        </td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '12 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                       <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '12 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z240_12gb" title="Check Detail Workstation z240 Memory 12 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                       <td>8 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '8 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '8 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '8 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z240_8gb" title="Check Detail Workstation z240 Memory 8 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                         <td>6 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '6 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '6 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '6 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z240_6gb" title="Check Detail Workstation z240 Memory 6 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>4 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '4 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '4 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                          <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '4 GB')                           
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z240_6gb" title="Check Detail Workstation z240 Memory 6 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>0 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '0 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '0 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z240')
                            ->where('memory', '=', '0 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td> 
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z240_0gb" title="Check Detail Workstation z240 Memory 0 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>                     
                    </tr>
                </thead>
            </table>
              </div>            
            </div>

             <div class="panel panel-default">
              <div class="panel-heading"><b>Workstation Z640</b></div>
              <div class="panel-body">
             <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>Memory</th>
                        <th>Total</th>
                        <th>Idle</th>
                        <th>Fail</th>   
                        <th>View</th>                       
                    </tr>
                     <tr>
                        <td>64 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '64 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '64 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '64 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z640_64gb" title="Check Detail Workstation z640 Memory 64 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>48 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '48 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '48 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '48 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z640_48gb" title="Check Detail Workstation z640 Memory 48 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                     <tr>
                        <td>32 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '32 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '32 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '32 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z640_32gb" title="Check Detail Workstation z640 Memory 32 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>24 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '24 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '24 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '24 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z640_24gb" title="Check Detail Workstation z640 Memory 24 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>16 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '16 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '16 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '16 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z640_16gb" title="Check Detail Workstation z640 Memory 16 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>12 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '12 GB')
                            ->get();
                        echo count($total);
                        ?>                            
                        </td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '12 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                       <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '12 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z640_12gb" title="Check Detail Workstation z640 Memory 12 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>  
                    </tr>
                    <tr>
                       <td>8 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '8 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '8 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '8 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z640_8gb" title="Check Detail Workstation z640 Memory 8 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>  
                    </tr>
                    <tr>
                         <td>6 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '6 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '6 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '6 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z640_6gb" title="Check Detail Workstation z640 Memory 6 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>  
                    </tr>
                    <tr>
                        <td>4 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '4 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '4 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                          <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '4 GB')                           
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z640_4gb" title="Check Detail Workstation z640 Memory 4 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>  
                    </tr>
                    <tr>
                        <td>0 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '0 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '0 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'HP z640')
                            ->where('memory', '=', '0 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td> 
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#z640_0gb" title="Check Detail Workstation z640 Memory 0 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>                      
                    </tr>
                </thead>
            </table>
              </div>            
            </div>

            <div class="panel panel-default">
              <div class="panel-heading"><b>Workstation Dell T3620</b></div>
              <div class="panel-body">
             <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>Memory</th>
                        <th>Total</th>
                        <th>Idle</th>
                        <th>Fail</th> 
                        <th>View</th>                         
                    </tr>
                     <tr>
                        <td>64 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '64 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '64 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '64 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T3620_64gb" title="Check Detail Workstation Dell T3620 Memory 64 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>48 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '48 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '48 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '48 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T3620_48gb" title="Check Detail Workstation Dell T3620 Memory 48 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                     <tr>
                        <td>32 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '32 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '32 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '32 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T3620_32gb" title="Check Detail Workstation Dell T3620 Memory 32 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>24 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '24 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '24 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '24 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T3620_24gb" title="Check Detail Workstation Dell T3620 Memory 24 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>16 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '16 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '16 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '16 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T3620_16gb" title="Check Detail Workstation Dell T3620 Memory 16 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>12 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '12 GB')
                            ->get();
                        echo count($total);
                        ?>                            
                        </td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '12 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                       <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '12 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T3620_12gb" title="Check Detail Workstation Dell T3620 Memory 12 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                       <td>8 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '8 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '8 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '8 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T3620_8gb" title="Check Detail Workstation Dell T3620 Memory 8 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                         <td>6 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '6 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '6 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '6 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T3620_6gb" title="Check Detail Workstation Dell T3620 Memory 6 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>4 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '4 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '4 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                          <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '4 GB')                           
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T3620_4gb" title="Check Detail Workstation Dell T3620 Memory 4 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>0 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '0 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '0 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T3620')
                            ->where('memory', '=', '0 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>  
                         <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T3620_0gb" title="Check Detail Workstation Dell T3620 Memory 0 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>                    
                    </tr>
                </thead>
            </table>
              </div>            
            </div>

            <div class="panel panel-default">
              <div class="panel-heading"><b>Workstation Dell T7910</b></div>
              <div class="panel-body">
             <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>Memory</th>
                        <th>Total</th>
                        <th>Idle</th>
                        <th>Fail</th>   
                        <th>View</th>                       
                    </tr>
                     <tr>
                        <td>64 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '64 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '64 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '64 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T7910_64gb" title="Check Detail Workstation Dell T7910 Memory 64 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                    <tr>
                        <td>48 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '48 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '48 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '48 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T7910_48gb" title="Check Detail Workstation Dell T7910 Memory 48 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                     <tr>
                        <td>32 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '32 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '32 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '32 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T7910_32gb" title="Check Detail Workstation Dell T7910 Memory 32 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>24 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '24 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '24 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '24 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T7910_24gb" title="Check Detail Workstation Dell T7910 Memory 24 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>16 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '16 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '16 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '16 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T7910_16gb" title="Check Detail Workstation Dell T7910 Memory 16 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>12 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '12 GB')
                            ->get();
                        echo count($total);
                        ?>                            
                        </td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '12 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                       <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '12 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T7910_12gb" title="Check Detail Workstation Dell T7910 Memory 12 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                       <td>8 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '8 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '8 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '8 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T7910_8gb" title="Check Detail Workstation Dell T7910 Memory 8 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                         <td>6 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '6 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '6 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '6 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T7910_6gb" title="Check Detail Workstation Dell T7910 Memory 6 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>4 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '4 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '4 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                          <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '4 GB')                           
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T7910_4gb" title="Check Detail Workstation Dell T7910 Memory 4 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>0 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '0 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '0 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Dell T7910')
                            ->where('memory', '=', '0 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td> 
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#T7910_0gb" title="Check Detail Workstation Dell T7910 Memory 0 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>                     
                    </tr>
                </thead>
            </table>
              </div>            
            </div>

            <div class="panel panel-default">
              <div class="panel-heading"><b>Workstation Generic PC T-Series</b></div>
              <div class="panel-body">
             <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>Memory</th>
                        <th>Total</th>
                        <th>Idle</th>
                        <th>Fail</th> 
                        <th>View</th>                         
                    </tr>
                     <tr>
                        <td>64 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '64 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '64 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '64 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#generic_64gb" title="Check Detail Workstation Generic PC T-Series Memory 64 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>48 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '48 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '48 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '48 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#generic_48gb" title="Check Detail Workstation Generic PC T-Series Memory 48 GB"><span class="glyphicon glyphicon-zoom-in"></button></td> 
                    </tr>
                     <tr>
                        <td>32 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '32 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '32 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '32 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#generic_32gb" title="Check Detail Workstation Generic PC T-Series Memory 32 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>24 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '24 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '24 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '24 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#generic_24gb" title="Check Detail Workstation Generic PC T-Series Memory 24 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>16 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '16 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '16 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '16 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                      <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#generic_16gb" title="Check Detail Workstation Generic PC T-Series Memory 16 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>12 GB</td>
                        <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '12 GB')
                            ->get();
                        echo count($total);
                        ?>                            
                        </td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '12 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                       <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '12 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#generic_12gb" title="Check Detail Workstation Generic PC T-Series Memory 12 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                       <td>8 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '8 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '8 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '8 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#generic_8gb" title="Check Detail Workstation Generic PC T-Series Memory 8 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                         <td>6 GB</td>
                      <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '6 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '6 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                         <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '6 GB')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#generic_6gb" title="Check Detail Workstation Generic PC T-Series Memory 6 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>4 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '4 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '4 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                          <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '4 GB')                           
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                       <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#generic_4gb" title="Check Detail Workstation Generic PC T-Series Memory 4 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>
                    </tr>
                    <tr>
                        <td>0 GB</td>
                       <td><?php
                        $total = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '0 GB')
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><?php
                        $idle = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->where('memory', '=', '0 GB')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><?php
                        $fail = DB::table('ws_Availability')
                            ->where('type', '=', 'Generic PC')
                            ->wherein('memory', ['N/A','2 GB', '0 GB'])
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>
                        <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#generic_0gb" title="Check Detail Workstation Generic PC T-Series Memory 0 GB"><span class="glyphicon glyphicon-zoom-in"></button></td>                      
                    </tr>
                </thead>
            </table>
              </div>            
            </div>

            <div class="panel panel-default">
              <div class="panel-heading"><b>All Workstation </b></div>
              <div class="panel-body">
             <table class="uk-table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>                     
                        <th style="text-align: center;">Total</th>
                        <th style="text-align: center;">Idle</th>
                        <th style="text-align: center;">Fail</th>  
                    </tr>
                    <tr style="text-align: center;">                       
                        <td><b><?php
                        $total = DB::table('ws_Availability')                     
                            ->get();
                        echo count($total);
                        ?></td>
                        <td><b><?php
                        $idle = DB::table('ws_Availability')
                            ->whereIn('user', ['WS Render', 'Idle'])
                            ->get();
                        echo count($idle);
                        ?></td>
                        <td><b><?php
                        $fail = DB::table('ws_Availability')
                            ->where('user', '=', 'FAIL')
                            ->get();
                        echo count($fail);
                        ?></td>          
                    </tr>
                </thead>
            </table>
            </div>
            </div>
            </div>
            <!--  -->
         </div>
        </div>
    </div> 
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
@stop
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop


