<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="{{ asset('assets/iconic2.png') }}">
    <title>WFH Form Checklist - WIS</title>
    @include('assets_css_1')
</head>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&family=Russo+One&display=swap" rel="stylesheet">

<style type="text/css">
    body {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        background-color: skyblue;
        background-image: -webkit-linear-gradient(90deg, skyblue 20%, steelblue 100%);
        background-attachment: fixed;
        background-size: 100% 100%;
        overflow: hidden;
        /* font-family: 'Oswald', sans-serif; */
        -webkit-font-smoothing: antialiased;
    }

    ::selection {
        background: transparent;
    }

    /* CLOUDS */
    body:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        width: 0;
        height: 0;
        margin: auto;
        border-radius: 100%;
        background: transparent;
        display: block;
    }

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

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <form action="{{ route('remote-access-wfh/store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading center-text text-bold">IFW - NETWORK ACCESS CHECKLIST FOR WFH
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
                                        <table class="table-bordered table table-condensed">
                                            <tbody>
                                                <tr>
                                                    <th>Document Number <br> <input type="text" readonly></th>
                                                    <th>Date Checking <br> <input type="date" readonly
                                                            value="{{ date('Y-m-d') }}">
                                                    </th>
                                                    <th class="text-red">Requester <br> <input type="text"
                                                            name="requester" required placeholder="fullname">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2"></th>
                                                    <th class="text-red">Job Title <br> <input type="text"
                                                            name="job" required placeholder="position"></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2"></th>
                                                    <th class="text-red">Location of Residance<br> <input type="text"
                                                            name="location" required placeholder="your location"></th>
                                                </tr>
                                                <tr class="text-red">
                                                    <th>Device <sup>(Brand/Series)</sup></th>
                                                    <th>
                                                        <input type="text" name="device_personal" required
                                                            placeholder="ex: ASUS, ACER, DLL">
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                <tr class="text-red">
                                                    <th>Hostname Device</th>
                                                    <th>
                                                        <input type="text" name="device_hostname" required
                                                            placeholder="ex: MY-DESKTOP">
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                <tr class="text-red">
                                                    <th>Internet Service Provider <sup>(ISP)</sup></th>
                                                    <th>
                                                        <input type="text" name="device_isp" required
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
                                                    <th>Bandwidth<sup>(Mbps)
                                                            <a href="#"class="btn btn-xs btn-default"
                                                                data-toggle="modal"data-target="#modalBandwidth">check</a>
                                                        </sup>
                                                    </th>

                                                    <th>
                                                        <input type="number" min="0" name="bandwidth" required
                                                            placeholder="0" class="input-number"step="any">
                                                    </th>
                                                    <th>
                                                        <input type="file" name="bandwidth_file" required
                                                            class="form-control">
                                                        <sub>format: jpg, jpeg, png</sub>
                                                    </th>
                                                </tr>
                                                <tr class="text-red">
                                                    <th>Download <sup>(Mbps)</sup></th>
                                                    <th>
                                                        <input type="number" min="0" name="download" required
                                                            placeholder="0" step="any">
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                <tr class="text-red">
                                                    <th>Upload <sup>(Mbps)</sup></th>
                                                    <th>
                                                        <input type="number" min="0" name="upload" required
                                                            placeholder="0" step="any">
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <th>Network Status
                                                    </th>
                                                    <th class="text-grey"><input type="radio" id="bandwidth_stable"
                                                            class="custom-radio" disabled>
                                                        <label for="bandwidth_stable">Stable</label>
                                                        <input type="radio" name="bandwidth_Stat"
                                                            id="bandwidth_unstable" class="custom-radio" disabled>
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
                                                        <a href="#" class="btn btn-xs btn-default"
                                                            data-toggle="modal" data-target="#modalLatency">check</a>
                                                    </sup></th>
                                            </tr>
                                            <tr class="text-red">
                                                <th>vpn03.infinitestudios.id</th>
                                                <th>
                                                    Times=<input type="number" min="0" name="vpn03"
                                                        required placeholder="0">
                                                </th>
                                                <th>
                                                    <input type="file" name="file_vpn03" class="form-control"
                                                        required>
                                                    <sub>format: jpg, jpeg, png</sub>
                                                </th>
                                                <th class="text-grey">
                                                    <input type="radio" name="vpn03_stat" id="vpn03_stable"
                                                        class="custom-radio" disabled>
                                                    <label for="vpn03_stable">Stable</label>
                                                    <input type="radio" name="vpn03_stat" id="vpn03_unstable"
                                                        class="custom-radio" disabled>
                                                    <label for="vpn03_unstable">Unstable</label>
                                                </th>
                                            </tr>
                                            <tr class="text-red">
                                                <th>vpn04.infinitestudios.id</th>
                                                <th>
                                                    Times=<input type="number" min="0" name="vpn04"
                                                        required placeholder="0">
                                                </th>
                                                <th>
                                                    <input type="file" name="file_vpn04" class="form-control"
                                                        required>
                                                    <sub>format: jpg, jpeg, png</sub>
                                                </th>
                                                <th class="text-grey">
                                                    <input type="radio" name="vpn04_stat" id="vpn04_stable"
                                                        class="custom-radio" disabled>
                                                    <label for="vpn04_stable">Stable</label>
                                                    <input type="radio" name="vpn04_stat" id="vpn04_unstable"
                                                        class="custom-radio" disabled>
                                                    <label for="vpn04_unstable">Unstable</label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Network Quality</th>
                                                <th colspan="3" class="text-grey">
                                                    <input type="radio" id="net_quality_bad" class="custom-radio"
                                                        disabled>
                                                    <label for="net_quality_bad">Not Good</label>
                                                    <input type="radio" id="net_quality_good" class="custom-radio"
                                                        disabled>
                                                    <label for="net_quality_good">Good</label>
                                                    <input type="radio" id="net_quality_excellent"
                                                        class="custom-radio" disabled>
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
                                                        <input type="text" name="suges_it" readonly>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Confirm:</th>
                                                    <th class="text-grey">
                                                        <input type="radio" id="confirm_accept"
                                                            class="custom-radio" disabled>
                                                        <label for="confirm_accept">Accept</label>
                                                        <input type="radio" id="confirm_reject"
                                                            class="custom-radio" disabled>
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
                    </div>
                </form>
            </div>
            <div class="col-lg-2 pad-alert">
                @if ($errors->any())
                    @foreach ($errors->all() as $message)
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error!</strong> {{ $message }}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>

    @include('assets_script_1')

    <div id="modalBandwidth" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Check Bandwidth / Download / Upload</h4>
                </div>
                <div class="modal-body">
                    <iframe src="{{ $filePdf1 }}" frameborder="1" style="width: 100%; height: 600px;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div id="modalLatency" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Check Latency</h4>
                </div>
                <div class="modal-body">
                    <iframe src="{{ $filePdf }}" frameborder="1" style="width: 100%; height: 600px;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
