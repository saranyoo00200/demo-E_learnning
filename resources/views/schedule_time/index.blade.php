@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>ตารางสอน</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>ตารางสอน</h4>
                        </div>
                        {{-- <div class="col-md-6" align="right">
                          <a href="{{ url('subject_calendar/manage_synchronous','1') }}" class="btn btn-info">จัดการตารางเรียน</a>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12">
                            <div id='calendar'></div>
                        </div>
                    </div>
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
                    url: base_url + '/showcalendar_alltime',
                    success: function(data) {
                        console.log(data);
                    },
                    color: '#3788d8', // an option!
                    textColor: 'white',
                },
                eventClick: function(info) {
                    var eventObj = info.event;
                    var d_start = new Date(eventObj.start);
                    var thmonth = new Array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.',
                        'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');
                    var datestring_start = ('0' + d_start.getDate()).slice(-2) + "/" + thmonth[d_start
                        .getMonth()] + "/" + (d_start.getFullYear() + 543);
                    var d_end = new Date(eventObj.end);
                    var datestring_end = ('0' + d_end.getDate()).slice(-2) + "/" + thmonth[d_start
                        .getMonth()] + "/" + (d_end.getFullYear() + 543);
                    var time_start = ('0' + d_start.getHours()).slice(-2) + ":" + ('0' + d_start
                        .getMinutes()).slice(-2);
                    var time_end = ('0' + d_end.getHours()).slice(-2) + ":" + ('0' + d_end.getMinutes())
                        .slice(-2);
                    var msg = 'วิชา: ' + eventObj.title + '\r\n';
                    var teachers = eventObj.teacher;
                    msg += 'วันที่ เริ่ม - สิ้นสุด: ' + datestring_start + ' - ' + datestring_end +
                        '\r\n';
                    msg += 'เวลาที่ เริ่ม - สิ้นสุด: ' + time_start + ' - ' + time_end + ' น.' + '\r\n';
                    msg += 'ครู: ' + eventObj.extendedProps.teacher;
                    alert(msg);
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                locale: 'th'
            });
            calendar.render();
        });
    </script>
@endsection
