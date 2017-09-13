@extends('layouts.app')
@section('title','Pagos')
@section('content') 
    <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
    <script src='lib/jquery.min.js'></script>
    <script src='lib/moment.min.js'></script>
    <script src='fullcalendar/fullcalendar.js'></script>
    
    <div id="calendar">
    </div>
    
@endsection
@section('script') 
<script>
    $(document).ready(function() {
    
        // page is now ready, initialize the calendar...
    
        $('#calendar').fullCalendar({
            // put your options and callbacks here

             eventSources: [
                {
                    url: 'getcitas'
                }
    ]
        })
    
    });
</script>
@endsection('script')