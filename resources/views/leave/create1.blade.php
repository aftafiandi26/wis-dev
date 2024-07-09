@extends('layout')

@section('title')
    Applying Leave
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active',
        'c16' => 'active'
    ])
@stop
@section('body')
   <div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.html">
			Pusat Ilmu Secara Detil</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-left">
				<li class="clr1 active"><a href="index.html">Home</a></li>
				<li class="clr2"><a href="">Programming</a></li>
				<li class="clr3"><a href="">English</a></li>
			</ul>
		</div>
	</div>
</div>
</br></br></br></br>

<div class="container">
	<div class="row">
		<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">Mehgitung Selisih Hari</div>
			<div class="panel-body">
				<div class="form-group">
					<label>Tanggal Mulai</label>
					<div class="input-group date" id="tgl1">
						<input type="text" class="form-control" />	
							<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
					</div>
				</div>
				<div class="form-group">
					<label>Tanggal Berakhir</label>
					<div class="input-group date" id="tgl2">
						<input type="text" class="form-control"/>	
							<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
					</div>
				</div>
				<div class="form-group">
					<label>Selisih Hari</label>
						<input type="text" class="form-control" id="selisih"/>	
				</div>
			</div>
			</div>
		</div>
		
	</div>
</div>
<script>
$(function() { 
  $('#tgl1').datetimepicker({
   locale:'id',
   format:'DD/MMMM/YYYY'
   });
   
  $('#tgl2').datetimepicker({
   useCurrent: false,
   locale:'id',
   format:'DD/MMMM/YYYY'
   });
   
   $('#tgl1').on("dp.change", function(e) {
    $('#tgl2').data("DateTimePicker").minDate(e.date);
  });
  
   $('#tgl2').on("dp.change", function(e) {
    $('#tgl1').data("DateTimePicker").maxDate(e.date);
      CalcDiff()
   });
  
});

function CalcDiff(){
var a=$('#tgl1').data("DateTimePicker").date();
var b=$('#tgl2').data("DateTimePicker").date();
    var timeDiff=0
     if (b) {
            timeDiff = (b - a) / 1000;
        }
	
	$('#selisih').val(Math.floor(timeDiff/(86400))+' Hari')   
}
</script>
    @include('assets_script_6')
@stop

@section('bottom')
    @include('assets_script_1')
@stop
