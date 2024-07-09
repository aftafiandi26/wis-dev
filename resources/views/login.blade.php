<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" href="{{asset('assets/iconic2.png')}}">
        <title>Login - WIS</title>
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

    .shadow-login-box {
        box-shadow: 6px 4px rgb(88, 86, 86);
        border-radius: 10px;
    }
    .panel-body {
        margin-top: 10px;
    }

    .layout-login {
        margin-top: 20px;
    }

    .panel-title {
        font-family: 'Russo One', sans-serif;
    }
    .panel-title h3 {
        background-color: red;
        background-image: linear-gradient(to bottom right, rgba(239, 93, 93, 0.846) , rgba(241, 184, 76, 0.723));
        background-size: 100%;
        background-clip: text;        
        -webkit-background-clip: text;
        -moz-background-clip: text;
        -webkit-text-fill-color: transparent;
        -moz-text-fill-color: transparent;
    } 
 

    .waves {
        position:fixed;
        width: 120%;
        height:45vh;
        margin-bottom:-7px; /*Fix for safari gap*/
        bottom: 0;
        min-height:220px;
        max-height:350px;
    }

    .parallax > use {
        animation: move-forever 20s cubic-bezier(.55,.5,.45,.5)     infinite;
    }
    .parallax > use:nth-child(1) {
        animation-delay: -2s;
        animation-duration: 7s;
    }
    .parallax > use:nth-child(2) {
        animation-delay: -3s;
        animation-duration: 10s;
    }
    .parallax > use:nth-child(3) {
        animation-delay: -4s;
        animation-duration: 13s;
    }
    .parallax > use:nth-child(4) {
        animation-delay: -5s;
        animation-duration: 20s;
    }
    @keyframes move-forever {
        0% {
            transform: translate3d(-90px,0,0);
        }
        100% {
            transform: translate3d(85px,0,0);
        }
    }
    /*Shrinking for mobile*/
    @media (max-width: 768px) {
        .waves {
            height:15vh;
            min-height:15vh;
        }
    }

    @media (max-width: 760px) {
        div#glombang {
            display: none;
        }
    }

    .img-center {
        display: flex;
        margin-left: auto;
        margin-right: auto;
        height: 80px;
    }

    .button:active {        
        box-shadow: 0 5px #666;
        transform: translateY(4px); 
    }

</style>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4" style="margin-top: 10%;">
                    <div class="row">
                        <div class="col-md-12" id="">
                            <img width="120px" class="img-center" src="https://wis.infinitestudios.id/assets/Graphic2.png" alt="logo">
                        </div>
                    </div>

                    <div class="row layout-login">
                        <div class="col-md-12">
                            @if (Session::get('getError'))
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {!! Session::get('getError') !!}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>10
                                    {!! implode('', $errors->all('<li>:message</li>')) !!}
                                </div>
                            @endif

                            @if (Session::has('message'))
                                <div class="alert alert-info alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {!! Session::get('message') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                   
                    <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default shadow-login-box">
                                    <div class="panel-title text-center">
                                        <h3>Wide Information System</h3>
                                    </div>
                                    <div class="panel-body">
                                        {!! Form::open(['route' => 'login', 'role' => 'form', 'autocomplete' => 'off']) !!}
                                            <fieldset>
                                                @if ($errors->has('username'))
                                                    <div class="form-group input-group has-error">
                                                @else
                                                    <div class="form-group input-group">
                                                @endif
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>                                                 
                                                    <input type="text" name="username" id="username" class="form-control" placeholder="username" required>
                                                </div>

                                                @if ($errors->has('password'))
                                                    <div class="form-group input-group has-error">
                                                @else
                                                    <div class="form-group input-group">
                                                @endif
                                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                    {!! Form::input('password', 'password', old('password'), ['class' => 'form-control' , 'placeholder' => 'Password', 'maxlength' => 30, 'required' => true]) !!}
                                                </div>
                                                {!! Form::submit('Sign In', ['class' => 'btn btn-lg btn-success btn-block button']) !!}
                                            </fieldset>
                                        {!! Form::close() !!}

                                    </div>
                                </div>
                        </div>
                    </div>
                    <img width="350px" height="100px"  src="{{ asset('assets/Infinite_Studios_kinema.png') }}" alt="logo-kinema" class="img-center">
                    <br>
                    <a href="https://www.infinitestudios.com.sg/" target="_blank" rel="noopener noreferrer">
                        <img width="310px" height="100px"  src="{{ asset('assets/Infinite_Studios_Logo-03.png') }}" alt="logo-infinite" class="img-center">
                    </a>
                </div>

            </div>

        </div>

        {{-- <div class="row" id="glombang">
            <div>
                <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="parallax">
                        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(102, 193, 229, 0.7" />
                        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(135,206,235, 0.5)" />
                        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(37, 167, 218, 0.3)" />
                        <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(81, 184, 225)" />
                    </g>
                </svg>
            </div>
        </div> --}}

        @include('assets_script_1')
    </body>
</html>

