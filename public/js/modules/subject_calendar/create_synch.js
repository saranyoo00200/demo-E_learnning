$(document).ready(function() {
    $('#teacher_id').change(function(e) {
      var teacher_id = $('#teacher_id').val();
      var calendarEl = $('#calendar')[0];
      var calendar = new FullCalendar.Calendar(calendarEl, {
        height: '100%',
        initialView: 'dayGridMonth',
        events: {
          url: base_url+'/showcalendar_time/'+teacher_id,
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
      $.ajax({
        url: base_url+'/select_subject/',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {teacher_id:teacher_id},
        success: function (data) {
          console.log(data);
           $('#subject_id').html(data.html);
          // if (data != '') {
          // return false;
          // }else {
          // return false;
          // }
        },
      });


      // $.ajax({
      //   url: base_url+'/showcalendar_time/',
      //   type: 'POST',
      //   headers: {
      //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   },
      //   data: {teacher_id:teacher_id},
      //   success:function(data) {
      //     refresh_calendar(data,teacher_id);
      //   }
      // });
    });
});
load_calendar();
function load_calendar() {
  document.addEventListener('DOMContentLoaded', function() {
   var calendarEl = $('#calendar')[0];
   var teacher_id = $('#teacher_id').val();
   var calendar = new FullCalendar.Calendar(calendarEl, {
     height: '100%',
     initialView: 'dayGridMonth',
     events: {
           url: base_url+'/showcalendar_time/'+teacher_id,
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
}
function refresh_calendar(data) {
  console.log(data);
  var calendarEl = $('#calendar')[0];
  var calendar = new FullCalendar.Calendar(calendarEl, {
    height: '100%',
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
}
