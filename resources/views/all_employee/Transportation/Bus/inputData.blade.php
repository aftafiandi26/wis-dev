@extends('layout')

@section('title')
   Transportaion
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c33' => 'active'
    ])
@stop
@section('body')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Transportation Booking</h1> 
    </div>
</div>
<div class="row" style="margin-bottom: 20px;">
 <div class="col-lg-12">
   <a href="{{route('inputToStudio')}}" class="btn btn-sm btn-default">To Studio</a> 
   <a href="{{route('inputFromStudio')}}" class="btn btn-sm btn-default">From Studio</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-2 pull-right text-right">
    <small>
      <p>Transportation Call Center:</p>
      <p><i class="fa fa-whatsapp" style="font-size:20px"></i> +62 813-7232-3970</p>
    </small>
  </div>
</div>
<div class="row">
  <div class="col-lg-12"> 
     <table class="table table-striped table-bordered table-hover" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Destination</th>
                        <th>Key</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
  </div>
</div>
 <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
        </div>
    </div>
<div class="container-fluid">
  <div class="row">
 <small>
    <font color="red">**</font><font class="grey">Note:</font>
    <ul><li style="color: grey;">If you have questions?<br>Please send an email to administrator@wis.frameworks-studios.com</li></ul>
    </small>    
</div>
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>
 @stop 

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 
@section('script') 
  $('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0, 6] }
        ],
      "order": [
        [ 0, "des" ]
      ],
         processing: true,
        responsive: true,        
        ajax: '{!! URL::route("viewDataBookingTransportation") !!}'
    });

    $(document).on('click','#tables tr td a[title="Check In"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });

    
@stop