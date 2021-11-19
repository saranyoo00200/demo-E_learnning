@extends('layouts.app')
@section('content')
<section class="section">
  <div class="section-header">
      <h1>จัดการตารางเรียน</h1>
  </div>
  <div class="section-body">
    <div class="card">
      <div class="card-header" style="display:block;">
        <div class="row">
          <div class="col-md-12">
            <h4>จัดการตารางเรียน (Schedule Time)</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div id='calendar'></div>
          </div>
        </div>
      </div>
      <div class="card-footer text-right">
          <a href="{{ url()->previous() }}" class="btn btn-danger">ย้อนกลับ</a>
      </div>
    </div>
  </div>
</section>
@endsection
@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
   var calendarEl = $('#calendar')[0];
   var calendar = new FullCalendar.Calendar(calendarEl, {
     initialView: 'dayGridMonth',
     events: {
           url: base_url+'/showdata_time',
           success: function(data) {
             console.log(data);
           },
           color: '#3788d8',   // an option!
           textColor: 'white',
       },
       headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay'
  },
       locale: 'th'
   });
   calendar.render();
  });
</script>
@endsection
