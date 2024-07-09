@extends('layout')

@section('title')
    (it) Index Request Form
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
        <h1 class="page-header">End of Contract</h1> 
    </div>
</div> 
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered table-hover" width="100%" id="tables" style="margin-left: auto; margin-right: auto;" border="12">
            <thead>
              <tr>
                <td rowspan="2" style="text-align: center;">No</td>
                <td rowspan="2" style="text-align: center;">NIK</td>
                <td rowspan="2" style="text-align: center;">End Date</td>
                <td rowspan="2" style="text-align: center;">Join Date</td>
                <td rowspan="2" style="text-align: center;">Name Employee</td>
                <td rowspan="2" style="text-align: center;">Position</td>
                <td rowspan="2" style="text-align: center;">Department</td>
                <td colspan="2" style="text-align: center;">Remain Balance</td>
               <!--  <td rowspan="2" style="text-align: center;">View</td> -->
             </tr>
             <tr>
                <td style="text-align: center;">Annual</td>
                <td style="text-align: center;">Exdo</td>
             </tr>
            </thead>
        </table>
    </div>
</div>
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
           { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
           [2, "asc" ]
        ],
         processing: true,
        responsive: true,      
         "dom": 'Blfrtip', 
          "buttons": [{
                extend:    'excelHtml5',
                text:      '<i class="fa fa-download" style="font-size: 20px;"></i>',
                titleAttr: 'End Of Contract Employee'
            }],
        ajax: '{!! URL::route("getEndEmployee") !!}'
    });    
   
@stop
