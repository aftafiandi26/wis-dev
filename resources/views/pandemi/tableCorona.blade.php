@extends('layout')

@section('title')
    COVID19
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')

@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c200' => 'active',
        'c1600' => 'active'
    ])
@stop
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">COVID 19</h1>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <table class="table table-striped table-hover table-condensed">
          <thead>
            <tr>
               <th class="text-center">No</th>
               <th class="text-center">Provinsi</th>
               <th class="text-center">Jumlah Kasus</th>
               <th class="text-center">Jumlah Sembuh</th>
               <th class="text-center">Jumlah Meninggal</th>
               <th class="text-center">Jumlah Di Rawat</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; foreach ($list_data as $data): ?>
              <tr>
                <td style="text-align: center;">{{ $no++ }}</td>
                <td>{{ $data['key'] }}</td>  
                <td class="text-center">{{ $data['jumlah_kasus'] }}</td> 
                <td class="text-center">{{ $data['jumlah_sembuh'] }}</td>            
                <td class="text-center">{{ $data['jumlah_meninggal'] }}</td>
                <td class="text-center">{{ $data['jumlah_dirawat'] }}</td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
@stop
  