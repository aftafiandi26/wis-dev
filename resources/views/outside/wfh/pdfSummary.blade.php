<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF - Network Access Check (WFH)</title>
    <style>
        table {
            width: 100%;
            /* Mengatur lebar tabel */
            border-collapse: collapse;
            /* Menghilangkan jarak antara border sel */
        }

        td {
            padding: 10px;
            border: 1px solid #ccc;
            /* Menambahkan border pada sel */
        }

        .text-bold {
            font-weight: bold;
            /* Mengatur teks menjadi tebal */
        }

        tr.line {
            background-color: #ccc;
        }

        .checkbox-inline {
            display: inline-block;
            /* Menampilkan checkbox secara inline */
            margin-right: 15px;
            /* Jarak antar checkbox */
            vertical-align: middle;
            /* Menjaga agar checkbox dan label sejajar secara vertikal */
        }

        .checkbox-inline input[type="checkbox"] {
            margin-right: 5px;
            /* Jarak antara checkbox dan label */
        }

        .text-center {
            text-align: center;
        }

        div#header {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .img-custom {
            width: auto;
            height: 70px;
            margin-top: -40px;
            margin-bottom: -20px;
        }

        i {
            font: 11px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12" id="header">
                <img src="{{ asset('assets/Infinite_Studios_kinema.png') }}" alt="img-logo-missing" srcset=""
                    class="img-custom text-center">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center">Network Access Check (WFH)</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <i>print on : {{ $date }}</i>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-condensed" id="tables">
                    <thead>
                        <tr class="line">
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td>
                                <span>Document:</span>
                                <br>
                                <span class="text-bold">{{ $data->document }}</span>
                            </td>
                            <td>
                                <span>Request Date:</span>
                                <br>
                                <span class="text-bold">{{ date('Y-m-d', strtotime($data->date)) }}</span>
                            </td>
                            <td>
                                <span>Requester:</span>
                                <br>
                                <span class="text-bold">{{ $data->requester }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <span>Job Title:</span>
                                <br>
                                <span class="text-bold">{{ $data->job }}</span>
                            </td>
                        </tr>
                        <tr class="line">
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td>
                                <span>Device:</span>
                                <br>
                                <span class="text-bold">{{ $data->device_personal }}</span>
                            </td>
                            <td>
                                <span>Hostname:</span>
                                <br>
                                <span class="text-bold">{{ $data->device_hostname }}</span>
                            </td>
                            <td>
                                <span>Internet Provider:</span>
                                <br>
                                <span class="text-bold">{{ $data->device_isp }}</span>
                            </td>
                        </tr>
                        <tr class="line">
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td>
                                <span>Bandwidth:</span>
                                <br>
                                <span class="text-bold">{{ $data->bandwidth }} Mbps</span>
                            </td>
                            <td>
                                <span>Download:</span>
                                <br>
                                <span class="text-bold">{{ $data->download }} Mbps</span>
                            </td>
                            <td>
                                <span>Upload:</span>
                                <br>
                                <span class="text-bold">{{ $data->upload }} Mbps</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Network Status:</span>
                            </td>
                            <td colspan="2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" @if ($data->net_stat === 1) checked @endif><span
                                        class="text-bold">Stable</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" @if ($data->net_stat === 2) checked @endif><span
                                        class="text-bold">Unstable</span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>vpn03.infinitestudios.id</span>
                                <br>
                                <span class="text-bold">{{ $data->vpn03 }} times</span>
                            </td>
                            <td colspan="2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" @if ($data->vpn03_stat === 1) checked @endif><span
                                        class="text-bold">Stable</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" @if ($data->vpn03_stat === 2) checked @endif><span
                                        class="text-bold">Unstable</span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>vpn04.infinitestudios.id</span>
                                <br>
                                <span class="text-bold">{{ $data->vpn04 }} times</span>
                            </td>
                            <td colspan="2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" @if ($data->vpn04_stat === 1) checked @endif><span
                                        class="text-bold">Stable</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" @if ($data->vpn04_stat === 2) checked @endif><span
                                        class="text-bold">Unstable</span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>Network Quality:</span>
                            </td>
                            <td colspan="2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" @if ($data->net_quality === 1) checked @endif><span
                                        class="text-bold">Not Good</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" @if ($data->net_quality === 2) checked @endif><span
                                        class="text-bold">Good</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" @if ($data->net_quality === 3) checked @endif><span
                                        class="text-bold">Excellent</span>
                                </label>
                            </td>
                        </tr>
                        <tr class="line">
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <span>IT Sugesstions:</span>
                                <br>
                                <span class="text-bold">{{ $data->suges_it }}</span>
                            </td>
                        </tr>
                        <tr class="line">
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td>
                                <span>Confirm:</span>
                            </td>
                            <td colspan="2">
                                <label class="checkbox-inline">
                                    <input type="checkbox" @if ($data->confirm === 1) checked @endif><span
                                        class="text-bold">Accept</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" @if ($data->confirm === 2) checked @endif><span
                                        class="text-bold">Reject</span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <span>HR Sugesstions:</span>
                                <br>
                                <span class="text-bold">{{ $data->suges_hrd }}</span>
                            </td>
                        </tr>
                        <tr class="line">
                            <td colspan="3"></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
