@extends('layout')

@section('title')
    (it) Index Request Form
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c300' => 'active',
    ])
@stop

@push('style')
    <style>
        .panel-group,
        .pad-alert {
            margin-top: 3%;
        }

        .text-bold {
            font-weight: bold;
        }

        input {
            width: 200px;
            /* Atur lebar sesuai kebutuhan */
            height: 20px;
            /* Atur tinggi sesuai kebutuhan */
            padding: 5px;
            /* Atur padding jika diperlukan */
            box-sizing: border-box;
            /* Agar padding dan border termasuk dalam ukuran total */
        }

        input[readonly] {
            background-color: #ffffff54;
            /* Ubah warna latar belakang menjadi putih */
            color: #000000;
            /* Ubah warna teks menjadi hitam */
            border: 1px solid rgb(128, 125, 125);
            /* Tambahkan border jika diperlukan */
            cursor: not-allowed;
            /* Ubah kursor untuk menunjukkan bahwa input tidak dapat diedit */
        }

        input[type="number"] {
            width: 80px;
            /* Atur lebar sesuai kebutuhan */
            height: 20px;
            /* Atur tinggi sesuai kebutuhan */
            padding: 5px;
            /* Atur padding jika diperlukan */
            box-sizing: border-box;
        }

        .radio-inline {
            display: inline-block;
            /* Menampilkan radio button secara inline */
            margin-right: 15px;
            /* Jarak antar radio button */
        }

        .custom-radio {
            display: none;
            /* Sembunyikan radio button default */
        }

        .custom-radio+label {
            position: relative;
            padding-left: 25px;
            /* Ruang untuk radio button kustom */
            cursor: pointer;
            /* Ubah kursor saat hover */
        }

        .custom-radio+label:before {
            content: '';
            /* Membuat elemen sebelum label */
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            /* Pusatkan vertikal */
            width: 20px;
            /* Lebar radio button kustom */
            height: 20px;
            /* Tinggi radio button kustom */
            border: 2px solid #007bff;
            /* Warna border */
            border-radius: 50%;
            /* Membuat lingkaran */
            background-color: #fff;
            /* Warna latar belakang */
        }

        .custom-radio:checked+label:before {
            background-color: #007bff;
            /* Warna latar belakang saat dipilih */
            border-color: #007bff;
            /* Warna border saat dipilih */
        }

        .custom-radio:checked+label:after {
            content: '';
            /* Membuat titik di dalam lingkaran */
            position: absolute;
            left: 6px;
            /* Posisi titik */
            top: 10px;
            /* Posisi titik */
            width: 8px;
            /* Diameter titik */
            height: 8px;
            /* Diameter titik */
            border-radius: 50%;
            /* Membuat lingkaran */
            background-color: white;
            /* Warna titik */
        }

        .text-red {
            color: red;
        }

        .text-grey {
            color: lightgrey;
        }

        .center-text {
            text-align: center;
        }
    </style>
@endpush

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Form Request WFH</h1>
        </div>
    </div>

    @include('asset_feedbackErrors')

    <form action="{{ route('it/form/remote-access-wfh/document/form/update', $data->id) }}" method="post">
        {{ csrf_field() }}
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table-bordered table table-condensed">
                        <tbody>
                            <tr>
                                <th>Document Number <br> <input type="text" required value="{{ $data->document }}"
                                        name="document"></th>
                                <th>Date Checking <br> <input type="date" readonly
                                        value="{{ date('Y-m-d', strtotime($data->date)) }}">
                                </th>
                                <th class="text-red">Requester <br> <input type="text" value="{{ $data->requester }}"
                                        placeholder="fullname">
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"></th>
                                <th class="text-red">Job Title <br> <input type="text" value="{{ $data->job }}"
                                        placeholder="position"></th>
                            </tr>
                            <tr>
                                <th colspan="2"></th>
                                <th class="text-red">Location of Residance<br> <input type="text"
                                        value="{{ $data->location }}" placeholder="your location"></th>
                            </tr>
                            <tr class="text-red">
                                <th>Device <sup>(Brand/Series)</sup></th>
                                <th>
                                    <input type="text" value="{{ $data->device_personal }}"
                                        placeholder="ex: ASUS, ACER, DLL">
                                </th>
                                <th></th>
                            </tr>
                            <tr class="text-red">
                                <th>Hostname Device</th>
                                <th>
                                    <input type="text" value="{{ $data->device_hostname }}" placeholder="ex: MY-DESKTOP">
                                </th>
                                <th></th>
                            </tr>
                            <tr class="text-red">
                                <th>Internet Service Provider <sup>(ISP)</sup></th>
                                <th>
                                    <input type="text" value="{{ $data->device_isp }}"
                                        placeholder="ex: INDIHOME, BIZNET, IM3, TELKOMSEL, DLL">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table-bordered table table-condensed">
                        <tbody>
                            <tr class="text-red">
                                <th>Bandwidth <sup>(Mbps)
                                        <a href="https://www.speedtest.net/id" class="btn btn-xs btn-default"
                                            target="_blank" rel="noopener noreferrer">check</a>
                                    </sup> </th>

                                <th>
                                    <input type="number" min="0" value="{{ $data->bandwidth }}" readonly
                                        placeholder="0" class="input-number">
                                </th>
                                <th>
                                    <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalButton"
                                        data-url="{{ route('it/form/remote-access-wfh/form/modal/bandwidth', $data->id) }}"
                                        id="ss_bandwidth">ss_bandwidth</button>
                                </th>
                            </tr>
                            <tr class="text-red">
                                <th>Download <sup>(Mbps)</sup></th>
                                <th>
                                    <input type="number" min="0" value="{{ $data->download }}" placeholder="0">
                                </th>
                                <th></th>
                            </tr>
                            <tr class="text-red">
                                <th>Upload <sup>(Mbps)</sup></th>
                                <th>
                                    <input type="number" min="0" value="{{ $data->upload }}" placeholder="0">
                                </th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Network Status
                                </th>
                                <th>
                                    <input type="radio"name="net_stat" id="bandwidth_stable" class="custom-radio"
                                        value="1" @selected(true)>
                                    <label for="bandwidth_stable">Stable</label>
                                    <input type="radio" name="net_stat" id="bandwidth_unstable" class="custom-radio"
                                        value="2">
                                    <label for="bandwidth_unstable">Unstable</label>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-condensed">
                        <tr>
                            <th colspan="4">Check Latency <sup>(Ping Test)
                                    <a href="{{ $filePdf }}" target="_blank" class="btn btn-xs btn-default">check</a>
                                </sup></th>
                        </tr>
                        <tr>
                            <th class="text-red">vpn03.infinitestudios.id</th>
                            <th class="text-red">
                                Times=<input type="number" min="0" value="{{ $data->vpn03 }}" placeholder="0">
                            </th>
                            <th>
                                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalButton"
                                    data-url="{{ route('it/form/remote-access-wfh/form/modal/vpn03', $data->id) }}"
                                    id="ss_vpn03">ss_vpn03</button>
                            </th>
                            <th>
                                <input type="radio" name="vpn03_stat" id="vpn03_stable" class="custom-radio"
                                    value="1">
                                <label for="vpn03_stable">Stable</label>
                                <input type="radio" name="vpn03_stat" id="vpn03_unstable" class="custom-radio"
                                    value="2">
                                <label for="vpn03_unstable">Unstable</label>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-red">vpn04.infinitestudios.id</th>
                            <th class="text-red">
                                Times=<input type="number" min="0" value="{{ $data->vpn04 }}" placeholder="0">
                            </th>
                            <th>
                                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modalButton"
                                    data-url="{{ route('it/form/remote-access-wfh/form/modal/vpn04', $data->id) }}"
                                    id="ss_vpn04">ss_vpn04</button>
                            </th>
                            <th>
                                <input type="radio" name="vpn04_stat" id="vpn04_stable" class="custom-radio"
                                    value="1">
                                <label for="vpn04_stable">Stable</label>
                                <input type="radio" name="vpn04_stat" id="vpn04_unstable" class="custom-radio"
                                    value="2">
                                <label for="vpn04_unstable">Unstable</label>
                            </th>
                        </tr>
                        <tr>
                            <th>Network Quality</th>
                            <th colspan="3">
                                <input type="radio" id="net_quality_bad" class="custom-radio" name="network_quality"
                                    value="1">
                                <label for="net_quality_bad">Not Good</label>
                                <input type="radio" id="net_quality_good" class="custom-radio" name="network_quality"
                                    value="2">
                                <label for="net_quality_good">Good</label>
                                <input type="radio" id="net_quality_excellent" class="custom-radio"
                                    name="network_quality" value="3">
                                <label for="net_quality_excellent">Excellent</label>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-condensed table-bordered">
                        <tbody>
                            <tr>
                                <th>Sugesstions From IT</th>
                                <th colspan="2">
                                    <textarea name="suges_it" id="suges_it" cols="30" rows="3" readonly></textarea>
                                </th>
                            </tr>
                            <tr>
                                <th>Confirm:</th>
                                <th class="text-grey">
                                    <input type="radio" id="confirm_accept" class="custom-radio" disabled>
                                    <label for="confirm_accept">Accept</label>
                                    <input type="radio" id="confirm_reject" class="custom-radio" disabled>
                                    <label for="confirm_reject">Reject</label>
                                </th>
                            </tr>
                            <tr>
                                <th>Suggestions from HRD</th>
                                <th>
                                    <input type="text" readonly>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                </div>
            </div>
        </div>
        </div>
    </form>
    <div id="modalButton" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>
@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_3')
    @include('assets_script_7')
@stop

@push('js')
    <script>
        $(document).ready(function() {
            $("button#ss_vpn04").on('click', function() {
                var id = $(this).attr('data-url');

                $.ajax({
                    url: id,
                    success: function(e) {
                        $("#modal-content").html(e);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Menangani kesalahan
                        console.error("Request failed: " + textStatus + ", " + errorThrown);
                        alert("Terjadi kesalahan saat memuat data. Silakan coba lagi nanti.");
                    }
                });
            });

            $("button#ss_vpn03").on('click', function() {
                var id = $(this).attr('data-url');

                $.ajax({
                    url: id,
                    success: function(e) {
                        $("#modal-content").html(e);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Menangani kesalahan
                        console.error("Request failed: " + textStatus + ", " + errorThrown);
                        alert("Terjadi kesalahan saat memuat data. Silakan coba lagi nanti.");
                    }
                });
            });

            $("button#ss_bandwidth").on('click', function() {
                var id = $(this).attr('data-url');
                console.log(id);
                $.ajax({
                    url: id,
                    success: function(e) {
                        $("#modal-content").html(e);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Menangani kesalahan
                        console.error("Request failed: " + textStatus + ", " + errorThrown);
                        alert("Terjadi kesalahan saat memuat data. Silakan coba lagi nanti.");
                    }
                });
            });
        });
    </script>
@endpush
