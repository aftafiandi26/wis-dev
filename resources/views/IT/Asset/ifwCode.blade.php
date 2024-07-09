@extends('layout')

@section('title')
    (pdf) {{$title->category_cname}}
@stop
<!--  <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!} "> -->
@section('body')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<div class="container-fluid">
  <div class="row" style="margin-top: -50px;">
    <h3 style="text-align: center;"> List Barcode {{$title->category_cname}}</h3>
    <hr>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <table class="table table-bordered" border="1" style="text-align: center;">
        <thead>
          <tr>
            <th>No</th>
            <th>Barcode</th>
            <th>IFW COde</th>          
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $key => $value): ?>
            <tr>
              <td>{{$no++}}</td>
              <td>{{$value->barcode}}</td>
              <td>{{$value->ifw_code}}</td>              
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop