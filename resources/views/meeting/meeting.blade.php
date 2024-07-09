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
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar-scheduler/1.9.4/scheduler.min.js'></script>

<script src="{!! URL::route('assets/js/bootstrap') !!}"></script>
<script src="{!! URL::route('assets/js/metis') !!}"></script>
<script src="{!! URL::route('assets/js/sb-admin-2') !!}"></script>

<script>

  $(function() { // document ready

    $('#calendar').fullCalendar({
    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
      now: '<?php echo date('Y-m-d') ?>',
     /* hiddenDays: [0, 6],*/
      editable: true, // enable draggable events
      aspectRatio: 2.4,
      scrollTime: '07:00', // undo default 6am scrollTime
      header: {
        left: 'today prev,next',
        center: 'title',
        right: 'timelineDay,timelineThreeDays,agendaWeek,month,listWeek'
      },
      defaultView: 'timelineDay',
      views: {
        timelineThreeDays: {
          type: 'timeline',
          duration: { days: 2 }
        }
      },
       resourceLabelText: 'Room',
     
       resources: [  

        { id: '1', title: 'Meeting Room 1' , eventColor: 'red'},
        { id: '2', title: 'Meeting Room 2', eventColor: 'blue' },
        { id: '3', title: 'Preview Room', eventColor: 'green' },
      ],
       events: [
<?php $meeting = DB::table('meeting')->where('room', '=', 1)->where('status', '!=', 0)->get();

      foreach ($meeting as $meet) {  
      $id       = $meet->id;
      $room     = $meet->room;
      $users    = $meet->users_id;
      $start    = $meet->start_time;
      $end      = $meet->end_time;
      $Project  = $meet->Project;     
    
      ?>   
       {
       id : '<?php echo $id; ?>',
       resourceId : '1',  
        title  : '<?php echo $Project; ?>',
        start  : '<?php echo $start; ?>',
        end    : '<?php echo $end; ?>'},
 <?php  } ?>         
 <?php $meetingg = DB::table('meeting')->where('room', '=', 2)->where('status', '!=', 0)->get();

      foreach ($meetingg as $meett) {  
      $id       = $meett->id;
      $room     = $meett->room;
      $users    = $meett->users_id;
      $start    = $meett->start_time;
      $end      = $meett->end_time;
      $Project  = $meett->Project;     
    
      ?>   
       {
       id : '<?php echo $id; ?>',
       resourceId : '2',  
        title  : '<?php echo $Project; ?>',
        start  : '<?php echo $start; ?>',
        end    : '<?php echo $end; ?>'},
 <?php  } ?>  
  <?php $meetingg = DB::table('meeting')->where('room', '=', 3)->where('status', '!=', 0)->get();

      foreach ($meetingg as $meett) {  
      $id       = $meett->id;
      $room     = $meett->room;
      $users    = $meett->users_id;
      $start    = $meett->start_time;
      $end      = $meett->end_time;
      $Project  = $meett->Project;     
    
      ?>   
       {
       id : '<?php echo $id; ?>',
       resourceId : '2',  
        title  : '<?php echo $Project; ?>',
        start  : '<?php echo $start; ?>',
        end    : '<?php echo $end; ?>'},
 <?php  } ?>         
         ]
    });
  
  });

</script>

<style>
 body {
    margin: 0;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 16px;
  }

  p {
    text-align: center;
  }

  #calendar {
    max-width: 1080px;
    margin: 15px auto;
  }

  .fc-resource-area td {
    cursor: pointer;
  }
</style>

@section('body')
<div class="row">
    <div class="col-md-12">
      <h1>Meeting Schedule</h1>      
    </div>    
  </div>
<br>
<br>
  <div class="row">
    <form class="col-md-12" method="post" action="{{route('meeting-post')}} "> 
       {{ csrf_field() }}
      <div class="col-md-3">
        <label>Meet Room</label>
        <br>
     <select class="form-control" name="room">
        <option value="1">Meeting Room 1</option>
        <option value="2">Meeting Room 2</option>
        <option value="3">Preview Room</option>
      </select>
      </div>
      <div class="col-md-2">
      <label>Start Time</label>     
        <br>
        <input type="time" name="start_time" class="form-control" required="true">  
      </div>       
      <div class="col-md-2">
        <label>End Time</label>        
        <br>
        <input type="time" name="end_time" class="form-control" required="true">  

      </div>  
       <div class="col-md-2">
        <label>Date Required</label>         
        <br>
        <input type="date" name="date" class="form-control" required="true">  
      </div>  
       <div class="col-md-2">
        <label>Project</label>        
        <br>   
        <select class="form-control" name="job" required="true">
          <?php foreach ($project as $value): ?>
           <option>{{$value->project_name}}</option> 
          <?php endforeach ?>          
        </select>
      </div>  
       <div class="col-md-2">        
        <br>
       <button class="btn-info btn-sm">Apply</button>  
      </div>  

    </form>   
  </div>
<br>
<br>
<div class="row">
  <div class="col-md-12">
     <div class="col-md-12" id='calendar'></div>
  </div>
</div>
@stop


    