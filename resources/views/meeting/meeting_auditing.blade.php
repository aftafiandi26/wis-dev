@extends('layout')

@section('title')
    Meeting Room
@stop

@section('top')
    @include('assets_css_1')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left')
@stop

<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css' rel='stylesheet' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar-scheduler/1.9.4/scheduler.min.css' rel='stylesheet' />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.18/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.18/datatables.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar-scheduler/1.9.4/scheduler.min.js'></script>

<script src="{!! URL::route('assets/js/bootstrap') !!}"></script>
<script src="{!! URL::route('assets/js/metis') !!}"></script>
<script src="{!! URL::route('assets/js/sb-admin-2') !!}"></script>



@section('body')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">List of Meetings</h1>
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
		 <table class="table uk-table-hover uk-table-striped" width="100%" id="tables">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project</th>
                        <th>Request By</th>
                        <th>Start Time</th> 
                        <th>End Time</th>  
                        <th>Date Created</th>                 
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>

              <!--   <?php $no = 1; foreach ($meet as $meeting): ?>
                 <tbody>
                	    <td>{{$no++}}</td>
                        <td>{{$meeting->Project}}</td>
                        <td>{{$meeting->request_by}}</td>
                        <td>{{$meeting->start_time}}</td> 
                        <td>{{$meeting->end_time}}</td>
                        <td>{{$meeting->date}}</td>
                        <td>{{$meeting->status}}</td> 
                        <td>Action</td>     
                </tbody>	
                <?php endforeach ?>           -->     
            </table>	
	</div>	
</div>
 <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

           
            </div>
        </div>
    </div>
@stop
@section('bottom')
      @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop
@section('script')
    $('[data-toggle="tooltip"]').tooltip();

    $('#tables').DataTable({
        "columnDefs": [
           { className: "never", "searchable": false, "orderable": false, "visible": false, "targets": [0] }
        ],
        "order": [
           [0, "asc" ]
        ],
         processing: true,
        responsive: true,      
         "dom": 'Blfrtip', 
          "buttons": [{
                extend:    'excelHtml5',
                text:      '<i class="fa fa-download" style="font-size: 20px;"></i>',
                titleAttr: 'Download List Meeting'
            }],
        ajax: '{!! URL::route("getINdexMeetingAudit") !!}'
    }); 

  $(document).on('click','#tables tr td a[title="Detail"]',function(e) {
        var id = $(this).attr('data-role');

        $.ajax({
            url: id, 
            success: function(e) {
                $("#modal-content").html(e);
            }
        });
    });   
   
@stop
