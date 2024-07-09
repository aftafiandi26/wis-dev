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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<!--  -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.semanticui.min.css">
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.semanticui.min.js"></script>

<script>
$(document).ready(function() {   
    $('#example').DataTable( {
       "dom": 'Bfrtip',
        "lengthChange" : false,
        "buttons": [
           {
            extend: 'excel',
            text: 'Excel',
            orientation: 'landscape',
            pageSize: 'A4',
            filename: 'List Transportation',
            sheetName: 'List Transportation'
        },
        {
            extend: 'pdf',
            text: 'PDF',
            orientation: 'landscape',
            pageSize: 'A4',
            filename: 'List Transportation'
        }, 'print'
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '$'+pageTotal +' ( $'+ total +' total)'
            );
        },
        
    });   
} );
</script>
<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">List Transportation</h1> 
    </div>
</div>
<div class="row">
  <div class="col-lg-12"> 
    <a href="{{route('indexTransportationBUS')}}" class="btn btn-sm btn-danger pull-right">back</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 table-responsive">
   <table class="table table-hover table-striped table-bordered table-condensed" id="example" width="100%">
     <thead class="text-center" style="background-color: #b30000;">
       <tr style="color: white;">
       <th rowspan="2" class="text-center">N0</th>
       <th rowspan="2" class="text-center">Date</th>
       <th colspan="7" class="text-center">Dormitory To Studio</th>
       <th colspan="5" class="text-center">From Studio To Dormitory</th>
       <th rowspan="2" class="text-center">Total</th>
       <th rowspan="2" class="text-center">Action</th>
       </tr>
       <tr style="color: white;">
       <th class="text-center">08:00</th>
       <th class="text-center">08:20</th>
       <th class="text-center">08:40</th>
       <th class="text-center">09:00</th>
       <th class="text-center">09:20</th>
       <th class="text-center">09:40</th>
       <th class="text-center">Arrival</th>
       <th class="text-center">17:00</th>
       <th class="text-center">19:00</th>
       <th class="text-center">21:00</th>
       <th class="text-center">23:00</th>
       <th class="text-center">Departure</th>
       </tr>
     </thead>
     <tbody>
      <?php use App\Bus_Transportation; for ($i=$start_date; $i <=$end_date ; $i++) { 
      $data =  Bus_Transportation::whereDate('date_booking', $i)->where('lockey', 1)->where('time_booking', '=', '08:00:00')->count();
      $data1 = Bus_Transportation::whereDate('date_booking', $i)->where('lockey', 1)->where('time_booking', '=', '08:20:00')->count();
      $data2 = Bus_Transportation::whereDate('date_booking', $i)->where('lockey', 1)->where('time_booking', '=', '08:40:00')->count();
      $data3 = Bus_Transportation::whereDate('date_booking', $i)->where('lockey', 1)->where('time_booking', '=', '09:00:00')->count();
      $data4 = Bus_Transportation::whereDate('date_booking', $i)->where('lockey', 1)->where('time_booking', '=', '09:20:00')->count();
      $data5 = Bus_Transportation::whereDate('date_booking', $i)->where('lockey', 1)->where('time_booking', '=', '09:40:00')->count();

      $data6 = Bus_Transportation::whereDate('date_booking', $i)->where('lockey', 1)->where('time_booking', '=', '17:00:00')->count();
      $data7 = Bus_Transportation::whereDate('date_booking', $i)->where('lockey', 1)->where('time_booking', '=', '19:00:00')->count();
      $data8 = Bus_Transportation::whereDate('date_booking', $i)->where('lockey', 1)->where('time_booking', '=', '21:00:00')->count();
      $data9 = Bus_Transportation::whereDate('date_booking', $i)->where('lockey', 1)->where('time_booking', '=', '23:00:00')->count();
      $total = $data+$data1+$data2+$data3+$data4+$data5+$data6+$data7+$data8+$data9;
      $Arrival = $data+$data1+$data2+$data3+$data4+$data5;
      $Departure = $data6+$data7+$data8+$data9;

       echo "<tr>
        <td class='text-center'>".$no++."</td>
        <td class='text-center'>".$i."</td>
        <td class='text-center'>".$data."</td>
        <td class='text-center'>".$data1."</td>
        <td class='text-center'>".$data2."</td>
        <td class='text-center'>".$data3."</td>
        <td class='text-center'>".$data4."</td>
        <td class='text-center'>".$data5."</td>
        <th class='text-center' style='background-color: #ffe6e6;'>".$Arrival."</th>
        <td class='text-center'>".$data6."</td>
        <td class='text-center'>".$data7."</td>
        <td class='text-center'>".$data8."</td>
        <td class='text-center'>".$data9."</td>
        <th class='text-center' style='background-color: #ffe6e6;'>".$Departure."</th>
        <th class='text-center' style='background-color: #ffe6e6;'>".$total."</th>
        <td><a href='#' class='btn btn-xs btn-primary'>view</a></td>
      </tr>";
      } ?>      
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
