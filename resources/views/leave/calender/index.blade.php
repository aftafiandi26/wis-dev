@extends('layout')

@section('title')
    Calender of Leave
@stop

@section('top')
    @include('assets_css_1')
    @include('assets_css_2')
@stop

@section('navbar')
    @include('navbar_top')
    @include('navbar_left', [
        'c2' => 'active'
    ])
@stop
@section('style')
<style>
   .fc .fc-col-header-cell-cushion {
        display: inline-block;
        padding: 2px 4px;
    }
    .fc .fc-col-header-cell-cushion { /* needs to be same precedence */
        padding-top: 5px; /* an override! */
        padding-bottom: 5px; /* an override! */
    }
</style>
@endsection
@section('body')
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.5/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.5/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.5/index.global.min.js'></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            timeZone: 'local',
            headerToolbar: {
                start: 'dayGridMonth,timeGridWeek,timeGridDay',
                center: 'title',
                end: 'prev,next'
                },
            initialView: 'dayGridMonth', 
            contentHeight: 600,
            aspectRatio: 2,
            events: '{{ route("leave/calender/data") }}', 
            dayMaxEvents: true,            
        });
        calendar.render();
    });
</script>

<div class="row">
   <div class="col-lg-12">
        <h1 class="page-header">Calendar of Leave</h1> 
    </div>
</div> 
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <a href="{{ route('leave/summary/employes/index') }}" class="btn btn-default btn-sm" style="margin-bottom: 10px;">Table</a>
        <div id="calendar"></div>
    </div>
    <div class="col-lg-1"></div>
</div>
@stop 


@section('bottom')
    @include('assets_script_1')
    @include('assets_script_2')
    @include('assets_script_7')
@stop 
@section('js')

@stop
