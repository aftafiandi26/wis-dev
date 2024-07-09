@extends('layout')

@section('title')
    Working on Weekends - Summary (hr)
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
    @include('assets_css_3')
    @include('assets_css_4')
    @include('asset_select2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'workingWeekends01' => 'active'
    ])
@stop
@push('style')
<style>
    table#tables1 a#table1Detail, table#tables3 a#table1Detail {
        background-color: greenyellow;
        color: black;       
    }
    table#tables1 a#table1Detail:hover, table#tables3 a#table1Detail:hover  {
        background-color: rgb(143, 215, 36);
        color: black;        
    }   

    table#tables1 .btn, table#tables3 .btn {
        border-radius: 7px;
    }
    table tbody {
        font-size: 12px;        
    }
    .panel:hover {
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
        border-radius: 10px;
    }
    #tables2 {
        text-align: center;
    }

    div.baris {
        height: 780px; /* Atur ketinggian elemen */
        overflow-y: auto;

    }
    span#subHeadline {
        color: red;
        font-style: italic;
    }

    table#tables3 a#table1Detail:active, table#tables1 a#table1Detail:active {
        background-color: greenyellow;
        color: white;
    }
    @keyframes blink {
        0% { color: #000; }
        50% { color: #fff; }
        100% { color: #000; }
    }

    /* Gaya teks */
    .blinking-text {
        animation: blink 3s infinite; /* Menggunakan animasi berkedip */
        text-align: center;
    }
</style>
@endpush
@section('body')
<div class="row">
    <div class="col-lg-12"><h1 class="page-header">Summary Weekend Crew</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-5">
        <div class="panel panel-primary">
            <div class="panel-heading">Submissions Table <span id="subHeadline">(ongoing)</span></div>
            <div class="panel-body ">
                <table class="table table-responsive table-condensed table-hover table-striped table-bordered" width="100%" id="tables1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Weekend Crew</th>
                            <th>Coordinator</th>
                            <th>Producer</th>
                            <th>Project</th>
                            <th>Count</th> 
                            <th>Date</th>                   
                            <th>Status</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading">Submissions Table <span id="subHeadline">(Complate)</span></div>
            <div class="panel-body ">
                <table class="table table-responsive table-condensed table-hover table-striped table-bordered" width="100%" id="tables3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Weekend Crew</th>
                            <th>Coordinator</th>
                            <th>Producer</th>
                            <th>Project</th>
                            <th>Count</th> 
                            <th>Date</th>                   
                            <th>Status</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>    
    <div class="col-lg-7">
        <div class="panel panel-info">
            <div class="panel-heading">Weekend Crew Table</div>
            <div class="panel-body">
                <h4 id="head1" hidden>Producer : <span id="table2Producer"></span></h4>
                <h4 id="head2" hidden>Coordinator : <span id="table2Coor"></span></h4>
                <h4 class="blinking-text">Allowance</h4>
                <table class="table table-condensed table-hover table-striped table-bordered" width="100%" id="tables2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Employee</th>
                            <th>Position</th>
                            <th>Project</th>
                            <th>Work<br>Stat</th>
                            <th>Start</th>
                            <th>End</th>  
                        </tr>
                    </thead>
                </table>
                <h4 class="blinking-text">Exdo</h4>
                <table class="table table-condensed table-hover table-striped table-bordered" width="100%" id="tables4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Employee</th>
                            <th>Position</th>
                            <th>Project</th>
                            <th>Work<br>Stat</th>
                            <th>Start</th>
                            <th>End</th>  
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modalTable1Danger" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content-danger">
            <!--  -->
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

@section('script')
$('table#tables1').DataTable({
    processing: true, 
    responsive: true, 

    ajax: '{{ route('hrd/weekend-crew/summary/data') }}',
    columns: [
            {"data": "DT_Row_Index", orderable: false, searchable : false},  
            {"data": "crew"},
            {"data": "fullname"},      
            {"data": "producer"},      
            {"data": "project"},        
            {"data": "count"},        
            {"data": "date"},        
            {"data": "approved"},            
            {"data": "actions"},            
        ]
});

$(document).on('click','#tables1 tr td a[id="table1Detail"]',function(e) {  
    e.preventDefault();

    var id = $(this).attr('data-role');

    var u = $(this).attr('data-route');

    var coordinator = $(this).closest('tr').find('td:eq(2)').text();
    var producer = $(this).closest('tr').find('td:eq(3)').text();


    document.getElementById('table2Coor').innerText = '';
    document.getElementById('table2Producer').innerText = '';

    var elem1 = document.getElementById("head1");
    var elem2 = document.getElementById("head2");
    elem1.removeAttribute("hidden");
    elem2.removeAttribute("hidden");

    $('table#tables2').DataTable().destroy();
    $('table#tables4').DataTable().destroy();

    $('table#tables2').DataTable({
        processing: true, 
        responsive: true, 
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                title: 'Weekend Crew Allowance',
            }
        ],
        ajax: id,
        columns: [
                {"data": "DT_Row_Index", orderable: false, searchable : false},   
                {"data": "fullname"},        
                {"data": "position"},        
                {"data": "project"},    
                {"data": "workStat"}, 
                {"data": "start"},    
                {"data": "end"},    
            ]
    });

    $('table#tables4').DataTable({
        processing: true, 
        responsive: true, 
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                title: 'Weekend Crew Exdo',
            }
        ],
        ajax: u,
        columns: [
                {"data": "DT_Row_Index", orderable: false, searchable : false},   
                {"data": "fullname"},        
                {"data": "position"},        
                {"data": "project"},    
                {"data": "workStat"}, 
                {"data": "start"},    
                {"data": "end"},    
            ]
    });

    document.getElementById('table2Coor').innerText = coordinator;
    document.getElementById('table2Producer').innerText = producer;
});

$(document).on('click','#tables1 tr td a[id="table1Danger"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content-danger").html(e);
        }
    });
});


$('table#tables3').DataTable({
    processing: true, 
    responsive: true,     
    ajax: '{{ route('hrd/weekend-crew/summary/data/complate') }}',
    columns: [
            {"data": "DT_Row_Index", orderable: false, searchable : false},  
            {"data": "crew"},
            { 
                data: 'fullname', 
                name: 'fullname', 
                render: function(data) {
                    return '<span id="coordinator">' + data + '</span>';
                } 
            },      
            { 
                data: 'producer', 
                name: 'producer', 
                render: function(data) {
                    return '<span id="producer">' + data + '</span>';
                } 
            },      
            {"data": "project"},        
            {"data": "count"},        
            {"data": "date"},        
            {"data": "approved"},            
            {"data": "actions"},            
        ]
});


$(document).on('click','#tables3 tr td a[id="table1Detail"]',function(e) {  
    e.preventDefault();

    var id = $(this).attr('data-role');

    var u = $(this).attr('data-route');

    var coordinator = $(this).closest('tr').find('td:eq(2)').text();
    var producer = $(this).closest('tr').find('td:eq(3)').text();


    document.getElementById('table2Coor').innerText = '';
    document.getElementById('table2Producer').innerText = '';

    var elem1 = document.getElementById("head1");
    var elem2 = document.getElementById("head2");
    elem1.removeAttribute("hidden");
    elem2.removeAttribute("hidden");

    $('table#tables2').DataTable().destroy();
    $('table#tables4').DataTable().destroy();

    $('table#tables2').DataTable({
        processing: true, 
        responsive: true, 
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                title: 'Weekend Crew Allowance',
            }
        ],
        ajax: id,
        columns: [
                {"data": "DT_Row_Index", orderable: false, searchable : false},   
                {"data": "fullname"},        
                {"data": "position"},        
                {"data": "project"},    
                {"data": "workStat"}, 
                {"data": "start"},    
                {"data": "end"},    
            ]
    });

    $('table#tables4').DataTable({
        processing: true, 
        responsive: true, 
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                title: 'Weekend Crew Exdo',
            }
        ],
        ajax: u,
        columns: [
                {"data": "DT_Row_Index", orderable: false, searchable : false},   
                {"data": "fullname"},        
                {"data": "position"},        
                {"data": "project"},    
                {"data": "workStat"}, 
                {"data": "start"},    
                {"data": "end"},    
            ]
    });

    document.getElementById('table2Coor').innerText = coordinator;
    document.getElementById('table2Producer').innerText = producer;
});

$(document).on('click','#tables3 tr td a[id="table1Danger"]',function(e) {
    var id = $(this).attr('data-role');

    $.ajax({
        url: id, 
        success: function(e) {
            $("#modal-content-danger").html(e);
        }
    });
});

@stop
