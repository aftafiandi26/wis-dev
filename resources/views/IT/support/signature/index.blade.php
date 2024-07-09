<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Email Signature Generator">
    <meta name="author" content="Anggarda Tiratana">

    <title>Email Signature Generator</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    

    <!-- Custom styles for this template -->
    <style type="text/css">
    /* Sticky footer styles
            -------------------------------------------------- */

    html,
    body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
    }

    /* Wrapper for page content to push down footer */
    #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by its height */
        margin: 0 auto -60px;
        /* Pad bottom by footer height */
        padding: 0 0 60px;
    }

    /* Set the fixed height of the footer here */
    #footer {
        height: 60px;
        background-color: #f5f5f5;
    }


    /* Custom page CSS
            -------------------------------------------------- */
    /* Not required for template or sticky footer method. */

    #wrap>.container {
        padding: 60px 15px 0;
    }

    .container .credit {
        margin: 20px 0;
    }

    #footer>.container {
        padding-left: 15px;
        padding-right: 15px;
    }

    code {
        font-size: 80%;
    }
    </style>

</head>

<body>

    <!-- Wrap all page content here -->
    <div id="wrap">

        <!-- Fixed navbar -->
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('dev/signature/index') }}">Email Signature Generator</a>
                </div>
            </div>
        </div>

        <!-- Begin page content -->
        <div class="container">
            <div class="page-header">
                <h4>Please input your detail below :</h4>
            </div>
            <form role="form" method="post" target="preview" id="form" action="{{ route('dev/signature/layout2') }}">
                {{ csrf_field() }}
                <div class="form-group mb-3">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control" id="Name" name="name" placeholder="Enter your name">
                </div>
                <div class="form-group mb-3">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="Email" name="email"
                        placeholder="firstname.lastname@infinite-studios.id">
                </div>
                <div class="form-group mb-3">
                    <label for="Job">Job Title</label>
                    <input type="text" class="form-control" id="Job" name="job"
                        placeholder="Senior 3D Animator">
                </div>
                <div class="form-group mb-3">
                    <label for="Mobile">Mobile No.</label>
                    <input type="phone" class="form-control" id="Mobile" name="mobile"
                        placeholder="+62 812 0000 0000">
                </div>         

                <button id="preview" type="submit" class="btn btn-outline-secondary">Preview</button>
                <button id="download" class="btn btn-outline-primary">Download</button>
                {{-- <a href="{{ }}" class="btn btn-outline-primary">Download</a> --}}
                <input type="hidden" name="download" id="will-download" value="">
            </form>
        </div>

        <div class="container">           
            <div class="card">
                <div class="card-body">
                    <iframe src="about:blank" name="preview" width="100%" height="250px"></iframe>
                </div>
              </div>
        </div>

    </div>

    <div id="footer">
        <div class="container">
            <p class="text-muted credit">Developed by <a href="https://github.com/anggarda">Frameworks Lab Tech (c)
                    2018</a>.</p>
        </div>
    </div>


    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#download").bind("click", function() {
            $('#will-download').val('true');
            $('#form').removeAttr('target').submit();
        });

        $("#preview").bind("click", function() {
            $('#will-download').val('');
            $('#form').attr('target', 'preview');
        });       
    });
    </script>
</body>

</html>