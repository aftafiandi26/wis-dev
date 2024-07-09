@extends('layout')

@section('title')
    Chart
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
             <h1><i class="fa fa-pie-chart"></i> GRafik</h1><hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div align="right">
               <a style="margin-bottom: 15px;" class="btn btn-sm btn-info pull-right" data-original-title="Back Table Histori" data-toggle="tooltip" data-placement="top" href="{!! URL::route('management-data/historical') !!}"><span>Back</span></a>
               
            </div>
            <div class="col-lg-6">
                <canvas id="myChart"></canvas>
            </div>
              
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
<script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {<?php //cari cara buat sinkronasi DB ?>
                    labels: ["Facility", "IT", "Finance", "HR", "Production", "Operation", "General", "Management", "Production Services (LS)"],
                    datasets: [{
                            label: 'Grafik Cuti',
                            data: [
                                <?php 
                                   $Facility = DB::table('leave_transaction')
                                  ->Select('request_dept_category_name')
                                    ->where('request_dept_category_name', '=', 'Facility')
                                    ->get();
                                    echo count($Facility);
                                 ?>,
                                <?php 
                                
                                    $IT = DB::table('leave_transaction')
                                    ->Select('request_dept_category_name')
                                    ->where('request_dept_category_name', '=', 'Information Technology')
                                    ->get();
                                   // ->whereRaw('leave_transaction.request_dept_category_name', '=', 'Information Technology')
                                  //->whereRaw('leave_transaction.request_by', '=', 'Information Technology');
                                    $I =  array(2,3,4,5,5);
                                   echo count($IT);
                                 // dd($IT);
                                  
                                 ?>
                                    
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
 <!--<script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustrus", "September", " Oktober", "November", "Desember"],
                    datasets: [{
                            label: 'Grafik Cuti',
                            data: [12, 19, 3, 5, 2, 3,12, 46, 3, 5, 2, 3],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>-->
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
@stop

@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
            { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
            [ 0, "des" ]
        ],
        
        responsive: true,        
        ajax: '{!! URL::route("management-data/gethistorical") !!}'
    });

    $(document).on('click','#tables tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });
@stop
