<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Email Layout</title>
    <style>
        /* Styling tabel agar sesuai dengan desain Anda */
        table {
            background: none;
            border: none;
            margin: 0;
            padding: 0;
            font-family: Verdana, Helvetica, sans-serif;
            font-size: 6pt;
        }

        td {
            padding: 0 5px 0 0;
            color: #8E8E8E;
        }

        td[style*="color: #F7751F"] {
            color: #F7751F;
        }

        a {
            color: #1da1db;
            text-decoration: none;
            font-weight: normal;
            font-size: 6pt;
        }
    </style>
</head>

<body>
    <!-- Salin kode tabel Anda di sini -->
    <div class="row">
        <div class="col-lg-12">
            <table cellpadding="0" cellspacing="0" border="0"
                style="background: none; border: none; margin: 0; padding: 0;">
                <tr>
                    <td valign="center" style="padding-right: 5px; border-right: solid 2px #F7751F;">
                        <img id="preview-image-url" src="{{ $iconIFW }}" height="14" width="80" />
                    </td>
                    <td style="padding-left: 12px;">
                        <table cellpadding="0" cellspacing="0" border="0"
                            style="background: none; border: none; margin: 0; padding: 0;">
                            <tr>
                                <td colspan="2"
                                    style="padding-bottom: 5px; color: #F7751F; font-size: 10px; font-family: Verdana, Helvetica, sans-serif;">
                                    {{ $data['name'] }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"
                                    style="color: #8E8E8E; font-size: 6pt; font-family: Verdana, Helvetica, sans-serif;">
                                    <strong>{{ $data['job'] }} | Infinite Studios</strong>
                                </td>
                            </tr>
                            <tr>
                                <td width="20" valign="top"
                                    style="color: #F7751F; font-size: 6pt; font-family: Verdana, Helvetica, sans-serif;">
                                    m:</td>
                                <td valign="top"
                                    style="color: #8E8E8E; font-size: 6pt; font-family: Verdana, Helvetica, sans-serif;">
                                    {{ $data['mobile'] }}
                                </td>
                            </tr>
                            <tr>
                                <td width="20" valign="top"
                                    style="color: #F7751F; font-size: 6pt; font-family: Verdana, Helvetica, sans-serif;">
                                    p:</td>
                                <td valign="top"
                                    style="color: #8E8E8E; font-size: 6pt; font-family: Verdana, Helvetica, sans-serif;">
                                    +62778761452&nbsp;&nbsp;<span style="color: #F7751F;">f:&nbsp;</span>+62778761044
                                </td>
                            </tr>
                            <tr>
                                <td width="20" valign="top"
                                    style="color: #F7751F; font-size: 6pt; font-family: Verdana, Helvetica, sans-serif;">
                                    a:</td>
                                <td valign="top"
                                    style="color: #8E8E8E; font-size: 6pt; font-family: Verdana, Helvetica, sans-serif;">
                                    Jl.
                                    Hang Lekiu KM. 2, Teluk Mata Ikan, Nongsa, Batam 29465</td>
                            </tr>
                            <tr>
                                <td width="20" valign="top"
                                    style="color: #F7751F; font-size: 6pt; font-family: Verdana, Helvetica, sans-serif;">
                                    w:</td>
                                <td valign="top"
                                    style="color: #8E8E8E; font-size: 6pt; font-family: Verdana, Helvetica, sans-serif;">
                                    <a href="http://www.infinitestudios.com.sg"
                                        target="_blank">www.infinitestudios.com.sg</a>&nbsp;&nbsp;<span
                                        style="color: #F7751F;">e:&nbsp;</span>
                                    <a id="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
@include('assets_script_1')

</html>
