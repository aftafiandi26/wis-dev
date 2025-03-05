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

    .panel {
        margin-top: 5%;
    }

    p {
        text-align: center;
        font-weight: bold;
        font-size: 18px;
        color: red;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>
                            Thank you for filling out the form,
                            <br>
                            Please contact HR Kinema again after filling this out.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

    </div>

    @include('assets_script_1')

</html>
