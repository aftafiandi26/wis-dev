@extends('layout')

@section('title')
    (it) Barcode Asset Item
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
<link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text|Libre+Barcode+39+Text&display=swap" rel="stylesheet"> 

<h1>Libre Barcode 39 & 128</h1>
<p style="font-family: 'Libre Barcode 39 Text', cursive; font-size: 56px;">ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
<p style="font-family: 'Libre Barcode 39 Text', cursive; font-size: 56px;">0123456789</p>

<p style="font-family: 'Libre Barcode 128 Text', cursive; font-size: 56px;">ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
<p style="font-family: 'Libre Barcode 128 Text', cursive; font-size: 56px;">0123456789</p>

<?php echo date('y'); ?>
@stop
@section('bottom')
      @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop

