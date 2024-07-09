@extends('layout')

@section('title')
    Forfeited
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c30002' => 'active'
    ])
@stop
@section('body')
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Forfeited Leave</h1> 
    </div>
</div>
<div class="row">
  
  <div class="col-lg-6">
    <h4>Index Forfeited</h4>
    <table class="table table-sm">
      <thead>
          <tr>
              <th>No</th>
              <th>Period</th>
              <th>Amount</th>
          </tr>
      </thead>
      <tbody>
        <?php foreach ($forfeiteds as $forfeited): ?>
           <tr>
             <td> {{ $no++ }} </td>
             <td> {{ $forfeited->year }} </td>
             <td> {{ $forfeited->countAnnual }} </td>
           </tr>
        <?php endforeach ?>
      </tbody>      
    </table>
  </div>

   <div class="col-lg-6">
    <h4>Index Taken</h4>
    <table class="table table-sm">
      <thead>
          <tr>
              <th>Forfeited</th>
              <th>Taken</th>
              <th>Balance</th>
          </tr>
      </thead>
      <tbody>
          <tr>
            <td>{{ $amount }}</td>
            <td>{{ $sumfor1 }}</td>
            <td>{{ $balance }}</td>
          </tr>
      </tbody>      
    </table>
  </div>

</div>
@stop
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 
