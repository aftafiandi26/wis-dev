<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class AssetsController extends Controller {

    public function imgLogo(Request $request)
    {
        return Response::file(base_path().'/assets/logo.png', ['Content-Type' => 'image/png']);
    }

    public function iconicLogo(Request $request)
    {
        return Response::file(base_path().'/assets/iconic_logo.png', ['Content-Type' => 'image/png']);
    }
    public function iconicOpening(Request $request)
    {
        return Response::file(base_path().'/assets/logo_opening.png', ['Content-Type' => 'image/png']);
    }


    public function imgKinema(Request $request)
    {
        return Response::file(base_path().'/assets/kinema.png', ['Content-Type' => 'image/png']);
    }

    public function imgGlobe(Request $request)
    {
        return Response::file(base_path().'/assets/globe.gif', ['Content-Type' => 'image/gif']);
    }

    public function imgWis(Request $request)
    {
        return Response::file(base_path().'/assets/wis.gif', ['Content-Type' => 'image/gif']);
    }

    public function cssBootstrap(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/bootstrap/css/bootstrap.min.css', ['Content-Type' => 'text/css']);
    }

    public function cssMetis(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/metisMenu/metisMenu.min.css', ['Content-Type' => 'text/css']);
    }

    public function cssSBAdmin2(Request $request)
    {
        return Response::file(base_path().'/assets/dist/css/sb-admin-2.css', ['Content-Type' => 'text/css']);
    }

    public function cssFontAwesome(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/font-awesome/css/font-awesome.min.css', ['Content-Type' => 'text/css']);
    }

    public function cssPluginDatatables(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/datatables-plugins/dataTables.bootstrap.css', ['Content-Type' => 'text/css']);
    }

    public function cssResponsiveDatatables(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/datatables-responsive/dataTables.responsive.css', ['Content-Type' => 'text/css']);
    }

    public function jsJQuery(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/jquery/jquery.min.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsBootstrap(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/bootstrap/js/bootstrap.min.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsMetis(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/metisMenu/metisMenu.min.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsSBAdmin2(Request $request)
    {
        return Response::file(base_path().'/assets/dist/js/sb-admin-2.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsDatatables(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/datatables/js/jquery.dataTables.min.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsPluginDatatables(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/datatables-plugins/dataTables.bootstrap.min.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsResponsiveDatatables(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/datatables-responsive/dataTables.responsive.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsHighCharts(Request $request)
    {
        return Response::file(base_path().'/assets/js/highcharts.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsExporting(Request $request)
    {
        return Response::file(base_path().'/assets/js/exporting.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsTinyMCE(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/tinymce/tinymce.min.js', ['Content-Type' => 'application/javascript']);
    }

    public function fontFontAwesomeWebfontWoff2(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/font-awesome/fonts/fontawesome-webfont.woff2', ['Content-Type' => 'font/woff2']);
    }

    public function fontFontAwesomeWebfontWoff(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/font-awesome/fonts/fontawesome-webfont.woff', ['Content-Type' => 'font/woff']);
    }

    public function fontFontAwesomeWebfontTTF(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/font-awesome/fonts/fontawesome-webfont.ttf', ['Content-Type' => 'font/ttf']);
    }


// dynamic report
    public function jsButtonDatatables(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/Buttons/js/dataTables.buttons.min.js', ['Content-Type' => 'application/javascript']);
    }  

    public function jsButtonFlash(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/Buttons/js/buttons.flash.min.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsButtonHtml5(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/Buttons/js/buttons.html5.min.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsButtonPrint(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/Buttons/js/buttons.print.min.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsJSZip(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/JSZip/jszip.min.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsPdfmake(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/pdfmake/pdfmake.min.js', ['Content-Type' => 'application/javascript']);
    }

    public function jsPdfmake_vfs_fonts(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/pdfmake/vfs_fonts.js', ['Content-Type' => 'application/javascript']);
    }

    public function cssButtonDatatables(Request $request)
    {
        return Response::file(base_path().'/assets/vendor/Buttons/css/buttons.dataTables.min.css', ['Content-Type' => 'application/javascript']);
    }
	 public function jjs(Request $request)
    {
        return Response::file(base_path().'/assets/js/1.js', ['Content-Type' => 'application/javascript']);
    }
	public function jcss(Request $request)
    {
        return Response::file(base_path().'/assets/css/1.css', ['Content-Type' => 'application/javascript']);
    }
    public function imgStructure(Request $request)
    {
        return Response::file(base_path().'/assets/strucutre.png', ['Content-Type' => 'image/png']);
    }
    
}