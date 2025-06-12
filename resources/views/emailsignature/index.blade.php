@extends('layout')

@section('title')
    IFW Mail Siginature Generator
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active',
    ])
@stop
@push('style')
    <style>
        body {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            /* background-color: skyblue;
                                                                                                                                                                                                    background-image: -webkit-linear-gradient(90deg, skyblue 20%, steelblue 100%); */
            background-attachment: fixed;
            background-size: 100% 100%;
            overflow: hidden;
            /* font-family: 'Oswald', sans-serif; */
            -webkit-font-smoothing: antialiased;
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

        div#panel {
            margin-top: 2%;
        }

        iframe[name="preview"] {
            display: block;
            /* Supaya margin auto bekerja */
            margin: 0 auto;
            /* Margin kiri dan kanan auto */
            width: 80%;
            /* Sesuai yang Anda inginkan */
            height: 250px;
            /* Sesuai kebutuhan */
        }
    </style>
@endpush
@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info" id="panel">
                <div class="panel-heading">
                    <h4>IFW - Email Signature Generator</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Please input your detail below :</h4>
                            <form role="form" method="get" target="preview" id="form"
                                action="{{ route('esignature/layout') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" class="form-control" id="Name" name="name"
                                        value="{{ old('name') }}" placeholder="Enter your name" required>
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control" id="Email" name="email" required
                                        value="{{ old('email') }}"
                                        placeholder="firstname.lastname@infinitestudios.id or @infinitestudios.co.id">
                                </div>
                                <div class="form-group">
                                    <label for="Job">Job Title</label>
                                    <input type="text" class="form-control" id="Job" name="job" required
                                        value="{{ old('job') }}" placeholder="Senior 3D Animator">
                                </div>
                                <div class="form-group">
                                    <label for="Mobile">Mobile No.</label>
                                    <input type="phone" class="form-control" id="Mobile" name="mobile" required
                                        value="{{ old('mobile') }}" placeholder="+62 812 0000 0000">
                                </div>

                                <a id="preview" type="submit" class="btn btn-default">Preview</a>
                                <a id="download" class="btn btn-default">Download</a>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <iframe src="{{ route('esignature/layout') }}" name="preview" width="80%" height="250"
                                id="frame"></iframe>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>

@stop

@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            function setCookie(name, value, hours) {
                let expires = "";
                if (hours) {
                    const d = new Date();
                    d.setTime(d.getTime() + (hours * 60 * 60 * 1000)); //ubah dari hari ke jam
                    expires = "expires=" + d.toUTCString() + "; ";
                }
                document.cookie = name + "=" + encodeURIComponent(value) + "; " + expires + "path=/";
            }

            // Fungsi get cookie
            function getCookie(name) {
                let cookieArr = document.cookie.split(";");
                for (let i = 0; i < cookieArr.length; i++) {
                    let cookiePair = cookieArr[i].trim();
                    if (cookiePair.startsWith(name + "=")) {
                        return decodeURIComponent(cookiePair.substring(name.length + 1));
                    }
                }
                return null;
            }

            window.onload = function() {
                const nameCookie = getCookie('form_name');
                const emailCookie = getCookie('form_email');
                const jobCookie = getCookie('form_job');
                const mobileCookie = getCookie('form_mobile');

                if (nameCookie) {
                    document.getElementById('Name').value = nameCookie;
                }
                if (emailCookie) {
                    document.getElementById('Email').value = emailCookie;
                }
                if (jobCookie) {
                    document.getElementById('Job').value = jobCookie;
                }
                if (mobileCookie) {
                    document.getElementById('Mobile').value = mobileCookie;
                }
            };

            document.getElementById("preview").addEventListener("click", function(event) {
                event.preventDefault();

                const name = document.getElementById("Name").value;
                const email = document.getElementById("Email").value;
                const job = document.getElementById("Job").value;
                const mobile = document.getElementById("Mobile").value;

                setCookie("form_name", name, 1);
                setCookie("form_email", email, 1);
                setCookie("form_job", job, 1);
                setCookie("form_mobile", mobile, 1);


                document.getElementById('form').submit();
            });

            document.getElementById('download').addEventListener('click', function(e) {
                e.preventDefault();

                // Dapatkan iframe dengan nama/id tertentu
                var iframe = document.getElementById('frame');

                // Pastikan konten dari iframe sudah siap dan berasal dari domain yang sama (cross-origin restriction)
                var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

                // Ambil isi HTML dari iframe
                var htmlContent = iframeDoc.documentElement.outerHTML;

                // Jika ingin menampilkan di console
                console.log(htmlContent);

                // Contoh sederhana: buat file HTML dan unduh sebagai file .html
                var blob = new Blob([htmlContent], {
                    type: 'text/html'
                });
                var url = URL.createObjectURL(blob);

                var a = document.createElement('a');
                a.href = url;
                a.download = 'preview-signature.html'; // nama file
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            });

        });
    </script>
@endpush
