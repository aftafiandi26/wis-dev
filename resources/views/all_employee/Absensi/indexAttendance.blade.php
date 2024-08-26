@extends('layout')

@section('title')
    {{ $header }}
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('asset_select2')
@stop

@push('style')
    <style>
        div.modal-body form div.row {
            margin-bottom: 10px;
        }

        span.thanks {
            animation: blink 3s infinite;
            color: maroon;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        a#checkOut,
        a#checkIn {
            border-radius: 20px;
            cursor: pointer;
            border: 1px solid black;
        }

        a#checkOut:hover,
        a#checkIn:hover {
            background-color: darkred;
            color: white;
            border: 1px solid yellowgreen;
        }

        .loader {
            display: none;
            /* Sembunyikan loader secara default */
            border: 8px solid lightgray;
            /* Warna garis loading */
            border-top: 8px solid transparent;
            /* Membuat bentuk cincin */
            border-radius: 50%;
            /* Membuat bentuk bulat */
            width: 70px;
            height: 70px;
            animation: spin 1.5s linear infinite;
            /* Animasi putar */
            z-index: 1;
            position: absolute;
            margin-left: 50%;
            cursor: pointer;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endpush

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c30001' => 'active',
    ])
@stop
@section('body')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Attendance</h1>
        </div>
    </div>

    <div class="row" id="apee">
        <div class="col-lg-4">
            <table class="table-striped table table-condensed table-borderless table-hover" id="tables">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>: {{ auth()->user()->getFullName() }}</th>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <th>: {{ auth()->user()->nik }}</th>
                    </tr>
                    <tr>
                        <th>Position</th>
                        <th>: {{ auth()->user()->position }}</th>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <th>: {{ auth()->user()->getDepartment() }}</th>
                    </tr>
                    <tr>
                        <th>Datetime</th>
                        <th>: {{ $date->toFormattedDateString() }} <span id="jam"></span>:<span
                                id="menit"></span>:<span id="detik"></span></th>
                    </tr>
                    <tr>
                        <th>Work From</th>
                        <th>: <select name="work_from" id="work_from" required>
                                <option value="">-choose-</option>
                                @if ($attendance)
                                    <option value="wfs"
                                        @if ($attendance->status_in === 'wfs') selected @else disabled style="color: whitesmoke;" @endif>
                                        WFS</option>
                                    <option value="wfh"
                                        @if ($attendance->status_in === 'wfh') selected @else disabled style="color: whitesmoke;" @endif>
                                        WFH</option>
                                @else
                                    <option value="wfs">WFS</option>
                                    <option value="wfh">WFH</option>
                                @endif
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-right">
                            @if ($attendance)
                                @if ($attendance->out == false)
                                    <a class="btn btn-sm btn-default" id="checkOut" data-toggle="modal"
                                        data-target="#showModal" data-role="{{ route('attendance/checkOut') }}">Check
                                        Out</a>
                                @else
                                    <span class="thanks">Thank you for filling out your attendance!!</span>
                                @endif
                            @else
                                <a class="btn btn-sm btn-default" id="checkIn" data-toggle="modal"
                                    data-target="#showModal" data-role="{{ route('attendance/checkin') }}">Check In</a>
                            @endif
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-condensed table-hover table-striped table-bordered" id="tablesWork" width='100%'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Day</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Time <sup>(minute)</sup></th>
                        <th>Work From..</th>
                        <th>Feel</th>
                        <th>Health</th>
                        <th>projects</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modal-content">
                <!--  -->
            </div>
        </div>
    </div>

@stop
@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_7')
    {{-- @include('js/cookie.js') --}}
@stop

@push('js')
    <script type="text/javascript">
        window.setTimeout("waktu()", 1000);

        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("jam").innerHTML = waktu.getHours();
            document.getElementById("menit").innerHTML = waktu.getMinutes();
            document.getElementById("detik").innerHTML = waktu.getSeconds();
        }

        function setCookie(name, value, daysToExpire) {
            var expires = "";
            if (daysToExpire) {
                var date = new Date();
                date.setTime(date.getTime() + (daysToExpire * 8 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + value + expires + "; path=/";
        }

        $('select#work_from').on('change', function() {
            let val = $(this).val(); // Menggunakan val() untuk mendapatkan nilai terpilih

            setCookie("checkIn", val, 1);
        });

        function deleteCookie(name) {
            setCookie(name, "", -1); // Mengatur masa berlaku cookie menjadi masa lalu, sehingga browser akan menghapusnya
        }
        deleteCookie("checkIn");
    </script>
@endpush

@section('script')

@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#tables tr th a[id="checkIn"]', function(e) {
                var id = $(this).attr('data-role');
                $.ajax({
                    url: id,
                    success: function(e) {
                        $("#modal-content").html(e);
                        $('#checkIn').modal('show');

                        $('.checkIn-select2-element').select2();
                    }
                });

                var work = $('select#work_from').val();

                if (work === "") {
                    window.alert("Please select a work option.");
                }
            });

            function hideModal() {
                $('#checkIn').modal('hide');
            }
            $(document).on('click', '#tables tr th a[id="checkOut"]', function(e) {
                var id = $(this).attr('data-role');

                $.ajax({
                    url: id,
                    success: function(e) {
                        $("#modal-content").html(e);
                    }
                });
            });

            $('table#tablesWork').DataTable({
                "columnDefs": [{
                    className: "never",
                    "searchable": false,
                    "orderable": false,
                    "visible": false,
                    "targets": []
                }],
                processing: true,
                responsive: true,
                ajax: '{{ route('attendance/datatables') }}',
                columns: [{
                        data: 'DT_Row_Index',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'day'
                    },
                    {
                        data: 'start'
                    },
                    {
                        data: 'end'
                    },
                    {
                        data: 'durations'
                    },
                    {
                        data: 'status_in'
                    },
                    {
                        data: 'nameQ1'
                    },
                    {
                        data: 'nameQ2'
                    }, {
                        data: 'projects'
                    }

                ],

            });
        });
    </script>
@endpush
