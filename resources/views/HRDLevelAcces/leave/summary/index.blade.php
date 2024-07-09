@extends('layout')

@section('title')
    (hr) Index Summary of Leave
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c173' => 'active'
    ])
@stop

@push('style')
  <style>
    .jarak-search {
        margin-top: 10px;
        margin-left: 20px;
    }
  </style>
@endpush

@section('body')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Summary of Leave (report)</h1>
        </div>
    </div>

    <div class="row">
       <div class="col-lg-12">
        <a class="btn btn-sm btn-default" id="search"><i id="loading-button"></i> Search :</a>
        <a class="btn btn-sm btn-default" id="progress" href="{{ route('leave/reschedule/index') }}">Progress & Reschedule</a>
       </div>
    </div>

    <div id="search" class="jarak-search" hidden>
        <div class="row">
            <div class="col-lg-12">
                <form class="form-inline" method="get" action="{{ route('hrd/summary/leave/index/view/detail') }}">
                    {{ csrf_field() }}
                    <label for="fromDate">Date</label>
                    <input type="date" name="fromDate" class="form-control" id="fromDate" required>
                    <label for="toDate">-</label>
                    <input type="date" name="toDate" class="form-control" id="toDate" required>
                    <label for="category">Category</label>
                    <select class="form-control" name="category" id="category" required>
                        <option value="all">-category-</option>
                        <?php foreach ($leaveCategory as $key => $category): ?>
                            <option value="{{ $category->id }}">{{ $category->leave_category_name }}</option>
                        <?php endforeach ?>
                    </select>
                    <label for="hometown">Hometown</label>
                    <select class="form-control" id="hometown" name="hometown" onchange="selectHometown()">
                            <option value="all">-province-</option>
                        <?php foreach ($provinsi as $key => $kota): ?>
                            <option value="{{ $kota['id'] }}">{{ $kota['nama'] }}</option>
                        <?php endforeach ?>
                    </select>
                    <select class="form-control" id="town" name="town" style="min-width: 200px;">
                        <option value="all">-town-</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-default" title="find"><span class="fa fa-search"></span></button>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('detail/employee/summary/hr') }}" class="form-inline" method="get">
                    {{ csrf_field() }}
                    <label for="employee">Employee</label>
                    <select name="employee" id="employee" class="form-control" required>
                        <option value="">-select employee-</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name.' '.$user->last_name }}</option>
                        @endforeach
                    </select>
                    <label for="year">Year</label>
                    <select name="year" id="year" class="form-control" required autocomplete="false">
                        <option value="">-year-</option>
                        @for ($i = 2018; $i <= date('Y'); $i++) <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                    </select>
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control" required autocomplete="false">
                        <option value="">-select leave-</option>
                        <?php foreach ($leaveCategory as $key => $category) : ?>
                            <option value="{{ $category->id }}">{{ $category->leave_category_name }}</option>
                        <?php endforeach ?>
                    </select>
                    <button type="submit" class="btn btn-sm btn-default" title="find"><span class="fa fa-search"></span></button>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('hr/summary/leave/chart/index') }}" method="get" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="make">Create Chart</label>
                        <input type="date" name="makeStart" id="make" class="form-control" required>
                        -
                        <input type="date" name="maekEnd" id="make" class="form-control"required>
                        <select name="leave_id" id="make" class="form-control">
                          <option value="6">Production</option>
                          <option value="0">Officer</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-default"><span class="fa fa-search"></span></button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        <div class="col-lg-12">
            <div>
            <table class="table table-striped table-bordered table-hover table-condensed" width="100%" id="tablesSummaryLeaves">
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
                        <th>Request Day</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
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

    <div class="modal fade" id="showModalDelete" tabindex="-1" role="dialog" aria-labelledby="showModalLabelDelete" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" id="modal-content-delete">
                <!--  -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div id="chart"></div>
        </div>
        <div class="col-lg-6">
            <div id="chart1"></div>
        </div>
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_3')
    @include('assets_script_2')
    @include('assets_script_7')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stop

@section('script')

    $('#tablesSummaryLeaves').DataTable({
                processing: true,
                responsive: true,
                ajax: '{{ route('hrd/summary/leave/index/data') }}',
                columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable : false},
                    { data: 'leave_category_id'},
                    { data: 'nik'},
                    { data: 'fullName'},
                    { data: 'dept_category_name'},
                    { data: 'position'},
                    { data: 'r_after_leaving'},
                    { data: 'leave_date'},
                    { data: 'end_leave_date'},
                    { data: 'back_work'},
                    { data: 'total_day'},
                    { data: 'ap_hrd'},
                    { data: 'actions'}
                ],
                dom: 'Bfrtip',
                buttons: [
                     'excel'
                ],
                deferRender: true,
    });


     $(document).on('click','#tablesSummaryLeaves tr td a[title="Detail"]',function() {

        var id = $(this).attr('data-role');
        console.log(id);

        $.ajax({
            url: id,
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });

     $(document).on('click','#tablesSummaryLeaves tr td a[id="Delete"]',function() {

        var id = $(this).attr('data-role');

        $.ajax({
            url: id,
            success: function(e) {
                $("#modal-content-delete").html(e);
            }
        });
    });

    $(document).ready(function() {
        $('select#employee').select2();
        $('select#town').select2();
        $('select#hometown').select2();
    });

    $(document).on('click', 'a#search', function(e) {
        const ate = $("div#search").attr("hidden");

        if (ate === "hidden") {
            $("div#search").attr("hidden", false);
            $("i#loading-button").addClass("fa fa-spinner fa-spin");
        } else {
            $("div#search").attr("hidden", true);
            $("i#loading-button").removeClass("fa fa-spinner fa-spin");
        }
    });

    $(document).on('click', 'a#progress', function(e) {
        $("div#search").attr("hidden", true);
        $("i#loading-button").removeClass("fa fa-spinner fa-spin");
    });

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    function selectHometown()
    {
        $('#town').html('');
        var myElements = $("#hometown").val();
        // var situs = 'https://ibnux.github.io/data-indonesia/kabupaten/'+ myElements +'.json';
        var situs = 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi='+ myElements +'';
            $.ajax({
                  url: situs,
                  dataType: 'json',
                  success: function (result){
                      var result = result.kota_kabupaten;
                      $('#town').append(`
                            <option value="all">-town-</option>
                        `);
                      $.each(result, function (nama, data){
                        $('#town').append(`
                            <option value="`+ data.id +`">`+ data.nama +`</option>
                        `);
                      });
                  }
                });
    }

    var options = {
          series: [{
          name: 'Annual',
          data: [
                {{ $january->where('leave_category_name', 'Annual')->count() }},
                {{ $februari->where('leave_category_name', 'Annual')->count() }},
                {{ $march->where('leave_category_name', 'Annual')->count() }},
                {{ $april->where('leave_category_name', 'Annual')->count() }},
                {{ $mei->where('leave_category_name', 'Annual')->count() }},
                {{ $june->where('leave_category_name', 'Annual')->count() }},
                {{ $july->where('leave_category_name', 'Annual')->count() }},
                {{ $august->where('leave_category_name', 'Annual')->count() }},
                {{ $september->where('leave_category_name', 'Annual')->count() }},
                {{ $october->where('leave_category_name', 'Annual')->count() }},
                {{ $november->where('leave_category_name', 'Annual')->count() }},
                {{ $december->where('leave_category_name', 'Annual')->count() }}
          ]
        }, {
          name: 'Exdo',
          data: [
                {{ $january->where('leave_category_name', 'Exdo')->count() }},
                {{ $februari->where('leave_category_name', 'Exdo')->count() }},
                {{ $march->where('leave_category_name', 'Exdo')->count() }},
                {{ $april->where('leave_category_name', 'Exdo')->count() }},
                {{ $mei->where('leave_category_name', 'Exdo')->count() }},
                {{ $june->where('leave_category_name', 'Exdo')->count() }},
                {{ $july->where('leave_category_name', 'Exdo')->count() }},
                {{ $august->where('leave_category_name', 'Exdo')->count() }},
                {{ $september->where('leave_category_name', 'Exdo')->count() }},
                {{ $october->where('leave_category_name', 'Exdo')->count() }},
                {{ $november->where('leave_category_name', 'Exdo')->count() }},
                {{ $december->where('leave_category_name', 'Exdo')->count() }},
          ]
        },{
          name: 'Etc',
          data: [
                {{ $january->where('leave_category_name', '!==', 'Annual')->where('leave_category_name', '!==', 'Exdo')->count() }},
                {{ $februari->where('leave_category_name', '!==', 'Annual')->where('leave_category_name', '!==', 'Exdo')->count() }},
                {{ $march->where('leave_category_name', '!==', 'Annual')->where('leave_category_name', '!==', 'Exdo')->count() }},
                {{ $june->where('leave_category_name', '!==', 'Annual')->where('leave_category_name', '!==', 'Exdo')->count() }},
                {{ $july->where('leave_category_name', '!==', 'Annual')->where('leave_category_name', '!==', 'Exdo')->count() }},
                {{ $august->where('leave_category_name', '!==', 'Annual')->where('leave_category_name', '!==', 'Exdo')->count() }},
                {{ $september->where('leave_category_name', '!==', 'Annual')->where('leave_category_name', '!==', 'Exdo')->count() }},
                {{ $october->where('leave_category_name', '!==', 'Annual')->where('leave_category_name', '!==', 'Exdo')->count() }},
                {{ $november->where('leave_category_name', '!==', 'Annual')->where('leave_category_name', '!==', 'Exdo')->count() }},
                {{ $december->where('leave_category_name', '!==', 'Annual')->where('leave_category_name', '!==', 'Exdo')->count() }},
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
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    var options1 = {
        series: [
            {{ $chartCountMonth['aceh'] }},
            {{ $chartCountMonth['sumut'] }},
            {{ $chartCountMonth['sumbar'] }},
            {{ $chartCountMonth['riau'] }},
            {{ $chartCountMonth['jambi'] }},
            {{ $chartCountMonth['sumsel'] }},
            {{ $chartCountMonth['bengkulu'] }},
            {{ $chartCountMonth['lampung'] }},
            {{ $chartCountMonth['bangka'] }},
            {{ $chartCountMonth['kepri'] }},
            {{ $chartCountMonth['dki'] }},
            {{ $chartCountMonth['jabar'] }},
            {{ $chartCountMonth['jateng'] }},
            {{ $chartCountMonth['yogya'] }},
            {{ $chartCountMonth['jatim'] }},
            {{ $chartCountMonth['banten'] }},
            {{ $chartCountMonth['bali'] }},
            {{ $chartCountMonth['ntb'] }},
            {{ $chartCountMonth['ntt'] }},
            {{ $chartCountMonth['kalbar'] }},
            {{ $chartCountMonth['kalteng'] }},
            {{ $chartCountMonth['kalsel'] }},
            {{ $chartCountMonth['kaltim'] }},
            {{ $chartCountMonth['kalut'] }},
            {{ $chartCountMonth['sulut'] }},
            {{ $chartCountMonth['sulteng'] }},
            {{ $chartCountMonth['sulsel'] }},
            {{ $chartCountMonth['sultengga'] }},
            {{ $chartCountMonth['goro'] }},
            {{ $chartCountMonth['sulbar'] }},
            {{ $chartCountMonth['maluku'] }},
            {{ $chartCountMonth['malut'] }},
            {{ $chartCountMonth['papuabar'] }},
            {{ $chartCountMonth['papua'] }},
        ],
        chart: {
            width: 500,
            type: 'pie',
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
                animateGradually: {
                    enabled: true,
                    delay: 7000
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 5000
                }
            }
        },
        labels: [
            '{{ $chartNameMonth["aceh"] }}',
            '{{ $chartNameMonth["sumut"] }}',
            '{{ $chartNameMonth["sumbar"] }}',
            '{{ $chartNameMonth["riau"] }}',
            '{{ $chartNameMonth["jambi"] }}',
            '{{ $chartNameMonth["sumsel"] }}',
            '{{ $chartNameMonth["bengkulu"] }}',
            '{{ $chartNameMonth["lampung"] }}',
            '{{ $chartNameMonth["bangka"] }}',
            '{{ $chartNameMonth["kepri"] }}',
            '{{ $chartNameMonth["dki"] }}',
            '{{ $chartNameMonth["jabar"] }}',
            '{{ $chartNameMonth["jateng"] }}',
            '{{ $chartNameMonth["yogya"] }}',
            '{{ $chartNameMonth["jatim"] }}',
            '{{ $chartNameMonth["banten"] }}',
            '{{ $chartNameMonth["bali"] }}',
            '{{ $chartNameMonth["ntb"] }}',
            '{{ $chartNameMonth["ntt"] }}',
            '{{ $chartNameMonth["kalbar"] }}',
            '{{ $chartNameMonth["kalteng"] }}',
            '{{ $chartNameMonth["kalsel"] }}',
            '{{ $chartNameMonth["kaltim"] }}',
            '{{ $chartNameMonth["kalut"] }}',
            '{{ $chartNameMonth["sulut"] }}',
            '{{ $chartNameMonth["sulteng"] }}',
            '{{ $chartNameMonth["sulsel"] }}',
            '{{ $chartNameMonth["sultengga"] }}',
            '{{ $chartNameMonth["goro"] }}',
            '{{ $chartNameMonth["sulbar"] }}',
            '{{ $chartNameMonth["maluku"] }}',
            '{{ $chartNameMonth["malut"] }}',
            '{{ $chartNameMonth["papuabar"] }}',
            '{{ $chartNameMonth["papua"] }}'
        ],
        responsive: [{
            breakpoint: 480,
            options: {
            chart: {
            width: 200
            },
            legend: {
            position: 'bottom'
            }
        }
        }]
    };

    var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
    chart1.render();

</script>
@endpush
