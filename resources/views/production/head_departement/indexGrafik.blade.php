@extends('layout')

@section('title')
    Leave
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
<style type="text/css">
  #container {
    max-width: 98%;
    height: 500px;
    margin: 1em auto;
}

caption {
  padding-bottom: 5px;
  font-family: 'Verdana';
  font-size: 14pt;
  font-weight: bold;
  color:#555555;
}

table {
  font-family: 'Verdana';
  font-size: 12pt;
  color:#555555;              
  border-collapse: collapse;
  border: 3px solid #CCCCCC;
  margin: 2px auto; 
}

tr {
    border-bottom: 2px solid #EEEEEE;
}

th {
  border-left: 2px solid #EEEEEE;
  border-right: 2px solid #EEEEEE;
  padding: 12px 15px;
  border-collapse: collapse;
}

th[scope="col"] {
  background-color: #ffffee;
}

th[scope="row"] {
  background-color: #f0fcff;
  text-align:left;
}

td {
    border-left: 2px solid #EEEEEE;
    border-right: 2px solid #EEEEEE;
    padding: 12px 15px;
    border-collapse: collapse;
}
</style>
@section('body')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<div id="container" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
<br>
<div id="container1" style="width:100%; height:500px;"></div>

<script>  
Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Summary of Leave <?php echo date('Y'); ?>'
    }, 
    subtitle: {
        text: 'Completed'
    },   
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Leave Transaction <?php echo date('Y'); ?>'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'TW2',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
    {
        name: 'BFF',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $des;
          ?>
        ]

    },
    {
        name: 'HRS',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]
    }, 
     {
        name: 'ABR',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,  
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,    
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,    
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
           <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
           <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>,
        ]

    },
     {
        name: 'BOX',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>,
        ]

    },
     {
        name: 'JBM',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>,
        ]

    },
     {
        name: 'PAK',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'OLI',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'Oct',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'TLL',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'TTF',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'DEP',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'MBM',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 1)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    }]
});
</script>
<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Summary of Leave <?php echo date('Y'); ?>'
    }, 
    subtitle: {
        text: 'Processing...'
    },   
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Leave Transaction <?php echo date('Y'); ?>'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'TW2',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 4)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
    {
        name: 'BFF',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 5)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $des;
          ?>
        ]

    },
    {
        name: 'HRS',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 16)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]
    }, 
     {
        name: 'ABR',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,  
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,    
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,    
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
           <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
           <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 17)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>,
        ]

    },
     {
        name: 'BOX',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 6)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>,
        ]

    },
     {
        name: 'JBM',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 18)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>,
        ]

    },
     {
        name: 'PAK',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 19)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'OLI',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 3)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'Oct',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 12)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'TLL',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 20)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'TTF',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 15)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'DEP',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 21)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    },
     {
        name: 'MBM',
        data: [<?php  
          $jan = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 1)
          ->count();          
          echo $jan;
          ?>,
          <?php  
          $feb = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 2)
          ->count();          
          echo $feb;
          ?>,
          <?php  
          $marc = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 3)
          ->count();          
          echo $marc;
          ?>,
          <?php  
          $april = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 4)
          ->count();          
          echo $april;
          ?>,
          <?php  
          $mei = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 5)
          ->count();          
          echo $mei;
          ?>,
          <?php  
          $jun = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 6)
          ->count();          
          echo $jun;
          ?>,
          <?php  
          $jul = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 7)
          ->count();          
          echo $jul;
          ?>,
          <?php  
          $augst = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 8)
          ->count();          
          echo $augst;
          ?>,
          <?php  
          $sept = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 9)
          ->count();          
          echo $sept;
          ?>,
          <?php  
          $okt = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 10)
          ->count();          
          echo $okt;
          ?>,
          <?php  
          $nov = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 11)
          ->count();          
          echo $nov;
          ?>,
          <?php  
          $des = DB::table('leave_transaction')
          ->join('users', 'leave_transaction.user_id', '=', 'users.id')->where('users.project_category_id_1', '=', 22)
          ->where('leave_transaction.ap_hrd', '=', 0)
          ->whereYEAR('leave_transaction.leave_date', '=', date('Y'))
          ->whereMONTH('leave_transaction.leave_date', '=', 12)
          ->count();          
          echo $des;
          ?>
        ]

    }]
});
</script>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
@stop

@section('script')
    $('[data-toggle="tooltip"]').tooltip();   
   
@stop