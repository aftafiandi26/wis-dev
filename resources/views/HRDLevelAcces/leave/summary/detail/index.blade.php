@extends('layout')

@section('title')
    (hr) Index Summary of Leave - Detail
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c173' => 'active'
    ])
@stop
@section('body')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Summary of Leave (report)</h1>
        </div>
    </div>

    <div class="row" style="margin-bottom: 10px;">
        <div class="col-lg-6">
            <a href="{{ route('hrd/summary/leave/index') }}" class="btn btn-sm btn-default">back</a>
            <a href="{{ route('hrd/summary/leave/index/view/detail/category/excel', [$dateFrom, $dateToo, $category, $hometown, $townn]) }}" class="btn btn-sm btn-default">Excel</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">            
            <table class="table table-striped table-bordered table-hover" width="100%" id="tablesSummaryLeave">
                <thead>
                    <tr style="white-space:nowrap">
                        <th>No</th>
                        <th>Leave Category</th>
                        <th>NIK</th>                        
                        <th>Employee</th>                      
                        <th>Department</th>
                        <th>Position</th>
                        <th>Hometown</th>
                        <th>Start Date</th>
                        <th>End Data</th>
                        <th>Back to Work</th>
                        <th>Status</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leave as $key => $data): ?>
                        <tr>
                            <td>{{ $leave->firstItem() + $key }}</td>
                            <td>{{ $data->leave_category_name }}</td>
                            <td>{{ $data->nik }}</td>
                            <td>{{ $data->first_name.' '.$data->last_name }}</td>
                            <td>{{ $data->dept_category_name }}</td>
                            <td>{{ $data->position }}</td>
                            <td>{{ $data->r_after_leaving }}</td>
                            <td>{{ date('d-M-Y', strtotime($data->leave_date)) }}</td>
                            <td>{{ date('d-M-Y', strtotime($data->end_leave_date)) }}</td>
                            <td>{{ date('d-M-Y', strtotime($data->back_work)) }}</td>
                            <td>
                                <?php if ($data->ap_hrd === 1): ?>
                                    Confirmed                                
                                <?php endif ?>
                            </td>
                            <td>
                                <a class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalDetailMC{{$data->id}}"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalDetailMC{{$data->id}}" role="dialog">
                            <div class="modal-dialog">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">eForm Leave <b>{{ $data->first_name.' '.$data->last_name }}</b></h4>
                                </div>
                                <div class="modal-body">
                                  <div class='well'>
                                    <strong>Request by :</strong> {{$data->first_name.' '.$data->last_name}}<br>
                                    <strong>Period :</strong> {{$data->period}} <br>
                                    <strong>Join Date :</strong> {{ date('d-M-Y', strtotime($data->join_date)) }} <br>
                                    <strong>NIK :</strong> {{$data->nik}} <br>
                                    <strong>Position :</strong> {{$data->position}} <br>
                                    <strong>Department :</strong> {{$data->dept_category_name}} <br>
                                    <strong>Contact Address :</strong> {{$data->address}} <br>
                                    <strong>Leave Category :</strong> {{$data->leave_category_name}} <br>
                                    <strong>Start Leave :</strong> {{ date('d-M-Y', strtotime($data->leave_date)) }} <br>
                                    <strong>End Leave :</strong> {{ date('d-M-Y', strtotime($data->end_leave_date )) }} <br>
                                    <strong>Back to Work :</strong> {{ date('d-M-Y', strtotime($data->back_work)) }} <br>
                                    <strong>Total Annual :</strong> {{$data->pending}} <br>
                                    <strong>Request Day :</strong> {{$data->total_day}} <br>
                                    <strong>Total Balance :</strong> {{$data->remain}} <br>  
                                    <strong>Hometown :</strong> {{$data->r_departure}} -> {{$data->r_after_leaving}} <br> 
                                    <strong>Status : Confirmed <br>                 
                                </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                              
                            </div>
                        </div>

                    <?php endforeach ?>
                </tbody>
            </table>
            <span>Showing {{ $leave->firstItem() }} to {{ $leave->lastItem() }} of {{ $leave->total() }} data</span>
            <span class="pull-right" style="margin-top: -20px;"> {{ $leave->appends($_GET)->render() }}</span>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
        </div>
    </div>    
  <!--   <div class="row">
        <div class="col-lg-12">
            <div id="chart"></div>
        </div>
    </div> -->

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
   @include('assets_script_7')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@stop
@section('script')

var options = {
          series: [{
          name: 'Leave',
          data: [
           11,11,11
          ]
        }],
          chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          type: 'category',
          categories: ['Annual', 'Exdo', 'Etc']
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

@stop