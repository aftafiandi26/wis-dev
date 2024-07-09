@extends('layout')

@section('title')
    Organization
@stop

@section('top')
    @include('assets_css_1')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left')
@stop

@section('body')
<style> 

.anic {
  -webkit-animation: fade-in 1s linear infinite alternate;
  -moz-animation: fade-in 1s linear infinite alternate;
  animation: fade-in 1s linear infinite alternate;
}
@-moz-keyframes fade-in {
  0% {
    opacity: 0;
  }
  65% {
    opacity: 1;
  }
}
@-webkit-keyframes fade-in {
  0% {
    opacity: 0;
  }
  65% {
    opacity: 1;
  }
}
@keyframes fade-in {
  0% {
    opacity: 0;
  }
  65% {
    opacity: 1;
  }
}
/*#container {
  min-width: 900px;
  max-width: 1370px;
  margin: 1em auto;
  border: 1px solid silver;
}

#container h4 {
  text-transform: none;
  font-size: 14px;
  font-weight: normal;
}
#container p {
  font-size: 13px;
  line-height: 16px;
} */

/*html, body {
    margin: 0px;
    padding: 0px;
    width: 100%;
    height: 100%;
    font-family: Arial Narrow;
    overflow: hidden;
}*/

#tree {
   margin: 0px;
    padding: 0px;
    width: 100%;
    height: 100%;
    font-family: Arial Narrow;
    overflow: hidden;
}
</style>
<link href="https://fonts.googleapis.com/css?family=Gochi+Hand" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">           
            <!-- <img style="width: 800px;" src="{!! URL::route('assets/img/strucutre') !!}" class="img-responsive center-block" alt="Responsive image">  -->         
    <!--   <p id="tree"></p>   -->   
    </div>
 </div>
<div style="width: 960px; height: 720px; margin: 10px; position: relative;"><iframe allowfullscreen frameborder="1" style="width:960px; height:720px" src="https://www.lucidchart.com/documents/embeddedchart/141c002d-740c-4193-9702-7c6a0c12c48a" id="iDsU3.DQXWE7"></iframe></div>
  
<script src="https://balkangraph.com/js/latest/OrgChart.js"></script>

<script type="text/javascript">  
window.onload = function () {
    var chart = new OrgChart(document.getElementById("tree"), {
        template: "isla",
     
        layout: OrgChart.mixed,
         enableDragDrop: true,
        toolbar: true,
        menu: {
           /* pdfPreview: { 
                text: "PDF Preview", 
                icon: OrgChart.icon.pdf(24,24, '#7A7A7A'),
                onClick: preview
            },*/
            pdf: { text: "Export PDF" },
            png: { text: "Export PNG" },
            svg: { text: "Export SVG" },
            csv: { text: "Export CSV" }
        },
      /*  nodeMenu: {
            details: { text: "Details" },
            add: { text: "Add New" },
            edit: { text: "Edit" },
            remove: { text: "Remove" },
        },*/
        nodeBinding: {
            field_0: "name",
            field_1: "title",
            img_0: "img"
        },
        nodes: [
             { id: "0", name: "PT Kinema Systrans Multimedia", title: "infinite Studio", email: "--", img: "<?php echo($no_avatar); ?>" },
            { id: "1", pid: "0", name: "Michael Kristian Wiluan", title: "CEO", email: "--", img: "<?php echo($no_avatar); ?>" },
            { id: "2", pid: "1", name: "--", title: "General Manager", email: "--", img: "<?php echo($no_avatar); ?>" },
            { id: "3", pid: "1", name: "JR", title: "VP of Production & Facilities", email: "--", img: "<?php echo($no_avatar); ?>" },   
            { id: "4", pid: "3", name: "YH", title: "Logistic and Location Manager", email: "--", img: "<?php echo($no_avatar); ?>" },
            { id: "5", pid: "3", name: "PSG", title: "Mgr of Film & Prod. Facilities", email: "--", img: "<?php echo($no_avatar); ?>" }, 
            { id: "6", pid: "2", name: "GL", title: "Head of Production", email: "--", img: "<?php echo($no_avatar); ?>" },  
            { id: "7", pid: "2", name: "Rianto", title: "Finance & Accounting Manager", email: "--", img: "<?php echo($no_avatar); ?>" }, 
            { id: "8", pid: "2", name: "WH", title: "HR and GA Manager", email: "--", img: "<?php echo($no_avatar); ?>" },
            { id: "9", pid: "2", name: "DH", title: "Facility Manager", email: "--", img: "<?php echo($no_avatar); ?>" },
            { id: "10", pid: "2", name: "AW", title: "IT Manager", email: "--", img: "<?php echo($no_avatar); ?>" },  
            { id: "11", pid: "2", name: "BY", title: "Marcom/PR", email: "--", img: "<?php echo($no_avatar); ?>" },
            { id: "12", pid: "6", name: "DD", title: "Studio Supervisor", email: "--", img: "<?php echo($no_avatar); ?>" },
            { id: "13", pid: "6", name: "SK", title: "Producer", email: "--", img: "<?php echo($no_avatar); ?>" },
            { id: "14", pid: "13", name: "SB", title: "Lighting Supervisor", email: "--", img: "<?php echo($no_avatar); ?>" },
            { id: "15", pid: "6", name: "DYM", title: "Animation Supervisor", email: "--", img: "<?php echo($no_avatar); ?>" },
            { id: "16", pid: "6", name: "WPA", title: "TD Supervisor", email: "--", img: "<?php echo($no_avatar); ?>" },  
            { id: "17", pid: "6", name: "RY", title: "CG Supervisor", email: "--", img: "<?php echo($no_avatar); ?>" },  
        ]
    });
    document.getElementById("selectTemplate").addEventListener("change", function () {
        chart.config.template = this.value;
        chart.draw();
    });
    /* function preview(){
        OrgChart.pdfPrevUI.show(chart, {
            format: 'A4'
        });
    }*/
}


</script>
@stop

@section('bottom')
    @include('assets_script_1')
@stop