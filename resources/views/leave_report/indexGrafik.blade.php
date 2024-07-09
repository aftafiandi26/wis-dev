@extends('layout')

@section('title')
    Traffic Leave
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <div class="row">
        <div class="col-lg-12">
             <h1><i class="fa fa-pie-chart"></i>Traffic Transaction <?php echo date('Y'); ?> - <?php echo date('Y', strtotime('-1 year', strtotime('Y'))); ?></h1><hr>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div align="right">
               <a style="margin-bottom: 15px;" class="btn btn-sm btn-primary" data-original-title="Table Historical" data-toggle="tooltip" data-placement="top" href="{!! URL::route('hr_mgmt-data/historyTransactionReport') !!}"><span>Table</span></a>
            </div>
        <div>
        <div class="row">
        <div class="col-lg-12">
              <h3 class="col-lg-3">Traffic Leave</h3>
            </div>            
          </div>
        <div class="row">
           <div class="col-lg-5"> 
            <div class="pull-right">
           
                </div>
             <div>              
                <br>
                <canvas id="Chart"></canvas>
            </div> 
            </div>
       
            <br>
            <div class="col-lg-5">
            <div class="pull-right">
           
            </div>
           <br>
                <canvas id="myChart1"></canvas>
            </div>
             <div class="col-lg-2">
             <p>Note : 
                <br>
                <li class='fas fa-file' style='font-size:14px;color:#ff0000;'></li><b class="btn-sm"><?php $a = DB::table('leave_transaction')->whereYEAR('leave_date', '=', date('Y'))->where('ap_hd', '=', 1)->where('ver_hr', '=', 1)->count(); echo($a); ?> Leave Transaction <?php echo date('Y'); ?></b> 
                <br>
                <br>
                <li class='fas fa-file' style='font-size:14px;color:#ffe6e6;'></li><b class="btn-sm"><?php $a = DB::table('leave_transaction')->whereYEAR('leave_date', '=', date('Y', strtotime('-1 year', strtotime('Y'))))->where('ap_hd', '=', 1)->where('ver_hr', '=', 1)->count(); echo($a); ?> Leave Transaction <?php echo date('Y', strtotime('-1 year', strtotime('Y'))); ?></b> 
                <br>
                <br>
                <b class="btn-sm"><?php $a = DB::table('leave_transaction')->whereYEAR('leave_date', '<', date('Y'))->where('ap_hd', '=', 1)->where('ver_hr', '=', 1)->count(); echo($a); ?> Total All Leave Transaction 2018 - <?php echo date('Y', strtotime('-1 year', strtotime('Y'))); ?></b>
                </p>
            </div>
             </div> 
       </div>
    </div>

    </div>
   <!--  <div class="row">
        <div class="col-lg-12">
              <h3 class="col-lg-3">Traffic Project</h3>
        </div>            
    </div> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
<script>
var colors = ['#7FFF00','#0066ff','#FF7F50', '#00FFFF','#EE82EE','#B22222', '#007bff','#28a745','#333333'];

/* 3 donut charts */
var donutOptions = {
  cutoutPercentage: 75, 
  legend: {position:'bottom', padding:50, labels: {pointStyle:'circle', usePointStyle:true}}
};

// donut 1
var chDonutData1 = {
    labels: ["Facility", "IT", "Finance", "HR", "Production", "Operation", "General", "Management", "Production Services (LS)"],
    datasets: [
      {
        backgroundColor: colors.slice(0,9),
        borderWidth: 1,
         label: 'Chart Leave Trnsaction <?php echo date('Y', strtotime('-1 year', strtotime('Y'))); ?>',

        data: [
        <?php 
                                   $Facility = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                   ->whereYEAR('leave_date', '=', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Facility')
                                    ->get();
                                    echo count($Facility);
                                 ?>,
                                <?php 
                                
                                    $IT = DB::table('leave_transaction')
                                    ->Select('request_dept_category_name')
                                   ->whereYEAR('leave_date', '=', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Information Technology')
                                    ->get();                            
                                   echo count($IT);   
                                 ?>,
                                  <?php 
                                   $Finance = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                 ->whereYEAR('leave_date', '=', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Finance & Accounting')
                                    ->get();
                                    echo count($Finance);
                                 ?>,
                                  <?php 
                                   $HR = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                  ->whereYEAR('leave_date', '=', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Human Resources')
                                    ->get();
                                    echo count($HR);
                                 ?>,
                                 <?php 
                                   $Production = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                  ->whereYEAR('leave_date', '=', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Production')
                                    ->get();
                                    echo count($Production);
                                 ?>,
                                  <?php 
                                   $Operation = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                  ->whereYEAR('leave_date', '=', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Operation')
                                    ->get();
                                    echo count($Operation);
                                 ?>,
                                 <?php 
                                   $General = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                    ->whereYEAR('leave_date', '=', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'General')
                                    ->get();
                                    echo count($General);
                                 ?>,
                                 <?php 
                                   $Management = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                      ->whereYEAR('leave_date', '=', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Management')
                                    ->get();
                                    echo count($Management);
                                 ?>,
                                 <?php 
                                   $LS = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                    ->whereYEAR('leave_date', '=', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Production Services (LS)')
                                    ->get();
                                    echo count($LS);
                                 ?>
                                 ]
      }
    ]
};

var chDonut1 = document.getElementById("myChart");
if (chDonut1) {
  new Chart(chDonut1, {
      type: 'horizontalBar',
      data: chDonutData1,
      options: donutOptions
  });
}
</script>
<script>
var colors = ['#ff0000', '#ffe6e6'];

var chBar = document.getElementById("myChart1");
var chartData = {
 labels: ["Facility", "IT", "Finance", "HR", "Production", "Operation", "General", "Management", "Production Services (LS)"],
  datasets: [{
     label: 'Grafik Cuti <?php  echo date('Y'); ?>',
    data: [<?php 
                                   $Facility = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                   ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Facility')
                                    ->get();
                                    echo count($Facility);
                                 ?>,
                                <?php 
                                
                                    $IT = DB::table('leave_transaction')
                                    ->Select('request_dept_category_name')
                                  ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Information Technology')
                                    ->get();                            
                                   echo count($IT);   
                                 ?>,
                                  <?php 
                                   $Finance = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                   ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Finance & Accounting')
                                    ->get();
                                    echo count($Finance);
                                 ?>,
                                  <?php 
                                   $HR = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                   ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Human Resources')
                                    ->get();
                                    echo count($HR);
                                 ?>,
                                 <?php 
                                   $Production = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                  ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Production')
                                    ->get();
                                    echo count($Production);
                                 ?>,
                                  <?php 
                                   $Operation = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                  ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Operation')
                                    ->get();
                                    echo count($Operation);
                                 ?>,
                                 <?php 
                                   $General = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                   ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'General')
                                    ->get();
                                    echo count($General);
                                 ?>,
                                 <?php 
                                   $Management = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                    ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Management')
                                    ->get();
                                    echo count($Management);
                                 ?>,
                                 <?php 
                                   $LS = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                    ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Production Services (LS)')
                                    ->get();
                                    echo count($LS);
                                 ?>],
    backgroundColor: colors[0]
  },
  {
    label: 'Grafik Cuti <?php echo date('Y', strtotime('-1 year', strtotime('Y'))); ?>',
    data: [<?php 
                                   $Facility = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                   ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Facility')
                                    ->get();
                                    echo count($Facility);
                                 ?>,
                                <?php 
                                
                                    $IT = DB::table('leave_transaction')
                                    ->Select('request_dept_category_name')
                                   ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Information Technology')
                                    ->get();                            
                                   echo count($IT);   
                                 ?>,
                                  <?php 
                                   $Finance = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                    ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Finance & Accounting')
                                    ->get();
                                    echo count($Finance);
                                 ?>,
                                  <?php 
                                   $HR = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                   ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Human Resources')
                                    ->get();
                                    echo count($HR);
                                 ?>,
                                 <?php 
                                   $Production = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                  ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Production')
                                    ->get();
                                    echo count($Production);
                                 ?>,
                                  <?php 
                                   $Operation = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                 ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Operation')
                                    ->get();
                                    echo count($Operation);
                                 ?>,
                                 <?php 
                                   $General = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                    ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'General')
                                    ->get();
                                    echo count($General);
                                 ?>,
                                 <?php 
                                   $Management = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                   ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Management')
                                    ->get();
                                    echo count($Management);
                                 ?>,
                                 <?php 
                                   $LS = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                    ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->where('request_dept_category_name', '=', 'Production Services (LS)')
                                    ->get();
                                    echo count($LS);
                                 ?>],
    backgroundColor: colors[1]
  }]
};

if (chBar) {
  new Chart(chBar, {
  type: 'horizontalBar',
  data: chartData,
  options: {
    scales: {
      xAxes: [{
        barPercentage: 0.5,
        categoryPercentage: 0.5
      }],
      yAxes: [{
        ticks: {
          beginAtZero: false
        }
      }]
    },
    legend: {
      display: false
    }
  }
  });
}
</script>
<script>
var colors = ['#ff0000', '#ffe6e6'];

var chBar = document.getElementById("Chart");
var chartData = {
 labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Juni", "Juli", "Aug", "Sep", " Okt", "Nov", "Dec"],
  datasets: [{
     label: 'Grafik Cuti <?php  echo date('Y'); ?>',
    data: [ <?php 
                                 $Januari = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 1)
                                    ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Januari);

                             ?>,

                             <?php 
                                 $Februari = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 2)
                                    ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Februari);

                             ?>,
                             <?php 
                                 $Maret = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 3)
                                    ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Maret);
                             ?>,
                             <?php 
                                 $April = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 4)
                                    ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($April);
                             ?>,
                             <?php 
                                 $Mei = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 5)
                                    ->whereYEAR('leave_date', '=', date('Y'))                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Mei);
                             ?>,
                             <?php 
                                 $Juni = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 6)
                                   ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Juni);
                             ?>,
                             <?php 
                                 $Juli = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 7)
                                    ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Juli);
                             ?>,
                             <?php 
                                 $Agustrus = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 8)
                                    ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Agustrus);
                             ?>,
                             <?php 
                                 $September = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 9)
                                   ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($September);
                             ?>,
                             <?php 
                                 $Oktober = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 10)
                                   ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Oktober);
                             ?>,
                             <?php 
                                 $November = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 11)
                                   ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($November);
                             ?>,
                             <?php 
                                 $Desember = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 12)
                                  ->whereYEAR('leave_date', '=', date('Y'))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Desember);
                             ?>],
    backgroundColor: colors[0]
  },
  {
    label: 'Grafik Cuti <?php echo date('Y', strtotime('-1 year', strtotime('Y'))); ?>',
    data: [ <?php 
                                 $Januari = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 1)
                                    ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Januari);
                             ?>,
                             <?php 
                                 $Februari = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 2)
                                     ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Februari);
                             ?>,
                             <?php 
                                 $Maret = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 3)
                                    ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Maret);
                             ?>,
                             <?php 
                                 $April = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 4)
                                    ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($April);
                             ?>,
                             <?php 
                                 $Mei = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 5)
                                     ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Mei);
                             ?>,
                             <?php 
                                 $Juni = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 6)
                                     ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Juni);
                             ?>,
                             <?php 
                                 $Juli = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 7)
                                     ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Juli);
                             ?>,
                             <?php 
                                 $Agustrus = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 8)
                                    ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Agustrus);
                             ?>,
                             <?php 
                                 $September = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 9)
                                   ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($September);
                             ?>,
                             <?php 
                                 $Oktober = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 10)
                                     ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Oktober);
                             ?>,
                             <?php 
                                 $November = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 11)
                                     ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($November);
                             ?>,
                             <?php 
                                 $Desember = DB::table('leave_transaction')
                                     ->Select('leave_date')
                                    ->whereMONTH('leave_date', '=', 12)
                                     ->whereYEAR('leave_date', date('Y', strtotime('-1 year', strtotime('Y'))))
                                    ->where('ap_hd', '=', 1)
                                    ->where('ver_hr', '=', 1)
                                    ->get();
                                    echo count($Desember);
                             ?>],
    backgroundColor: colors[1]
  }]
};

if (chBar) {
  new Chart(chBar, {
  type: 'bar',
  data: chartData,
  options: {
    scales: {
      xAxes: [{
        barPercentage: 0.7,
        categoryPercentage: 0.7
      }],
      yAxes: [{
        ticks: {
          beginAtZero: false
        }
      }]
    },
    legend: {
      display: false
    }
  }
  });
}
</script>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
@stop

@section('script')
    $('[data-toggle="tooltip"]').tooltip();

   
   
@stop