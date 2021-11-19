$(document).ready(function() {
   $('.datepicker').datepicker({
     format: "dd/mm/yyyy",
     autoclose: true,
     language:'th-th',
   });
   if ($(".clockpicker").length) {
     $(".clockpicker").clockpicker({
       donetext: "OK",
     });
   }
   $('#submit').click(function(e) {
     var subject_id = $('#subject_id').val();
     var start_date = $('#start_date').val();
     var end_date = $('#end_date').val();
     var synch_starttime = $('#synch_starttime').val();
     var synch_endtime = $('#synch_endtime').val();

     var convert_startdate = start_date.split("/");
     var convert_starttime = end_date.split(":");
     var convert_enddate = synch_starttime.split("/");
     var convert_endtime = synch_endtime.split(":");
     var dateOne = new Date(convert_startdate[2]-543,convert_startdate[1],convert_startdate[0],convert_starttime[0],convert_starttime[1],00);
     var dateTwo = new Date(convert_enddate[2]-543,convert_enddate[1],convert_enddate[0],convert_endtime[0],convert_endtime[1],00);
     var synch_amount = $('#synch_amount').val();
     var teacher_id = $('#teacher_id').val();
     var synch_status = $('#synch_status').val();
     var sync_id = $('#sync_id').val();
     if (subject_id == '') {
       swal({
         title: "แจ้งเตือน",
         text: "กรุณาเลือก ชื่อวิชา",
         icon: "warning",
         button: "ตกลง",
       });
       return false;
     }else if (start_date == '') {
       swal({
         title: "แจ้งเตือน",
         text: "กรุณาเลือก วันที่เริ่ม",
         icon: "warning",
         button: "ตกลง",
       });
       return false;
     }else if (end_date == '') {
       swal({
         title: "แจ้งเตือน",
         text: "กรุณาเลือก วันที่สิ้นสุด",
         icon: "warning",
         button: "ตกลง",
       });
       return false;
     }else if (synch_starttime == '') {
       swal({
         title: "แจ้งเตือน",
         text: "กรุณาเลือก เวลาที่เริ่ม",
         icon: "warning",
         button: "ตกลง",
       });
       return false;
     }else if (synch_endtime == '') {
       swal({
         title: "แจ้งเตือน",
         text: "กรุณาเลือกเวลาที่สิ้นสุด",
         icon: "warning",
         button: "ตกลง",
       });
       return false;
     }else if (synch_amount == '') {
       swal({
         title: "แจ้งเตือน",
         text: "กรุณากรอก จำนวนที่เปิดรับ",
         icon: "warning",
         button: "ตกลง",
       });
       return false;
     }else if (teacher_id == '') {
       swal({
         title: "แจ้งเตือน",
         text: "กรุณาเลือก ผู้สอน",
         icon: "warning",
         button: "ตกลง",
       });
       return false;
     }else if (dateOne > dateTwo) {
       swal({
         title: "แจ้งเตือน",
         text: "ข้อมูลวันเวลาที่เริ่มผิด กรุณากรอกใหม่",
         icon: "warning",
         button: "ตกลง",
       });
       return false;
     }else if (dateTwo < dateOne){
       swal({
         title: "แจ้งเตือน",
         text: "ข้อมูลวันเวลาที่สิ้นสุดผิด กรุณากรอกใหม่",
         icon: "warning",
         button: "ตกลง",
       });
       return false;
     }else if ($('.select_day:checked').length == 0) {
       swal({
         title: "แจ้งเตือน",
         text: "กรุณาเลือกวันที่ทำซ้ำ",
         icon: "warning",
         button: "ตกลง",
       });
       return false;
     }else {
       var start_date = $('#start_date').val();
       var end_date = $('#end_date').val();
       var synch_starttime = $('#synch_starttime').val();
       var synch_endtime = $('#synch_endtime').val();
       var synch_amount = $('#synch_amount').val();
       var teacher_id = $('#teacher_id').val();
       var sync_id = $('#sync_id').val();
       var subject_id = $('#subject_id').val();
       var select_day = [];
        i = 0;
       $('.select_day:checked').each(function () {
         select_day[i++] = $(this).val();
       });
       if (sync_id == '') {
         $.ajax({
           type:'POST',
           url:base_url+'/check_synchtime',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{start_date:start_date,end_date:end_date,synch_starttime:synch_starttime,synch_endtime:synch_endtime,select_day:select_day,teacher_id:teacher_id,subject_id:subject_id},
           success: function (data) {
             console.log(data);
             if (data == 'repeat') {
               swal({
                 title: "แจ้งเตือน",
                 text: "วิชาที่ท่านเลือก ผู้สอนได้ทำการเรียนการสอนแล้ว กรุณากรอกใหม่",
                 icon: "warning",
                 button: "ตกลง",
               });
             return false;
           }else if (data > 0) {
             swal({
               title: "แจ้งเตือน",
               text: "ช่วงเวลาที่ท่านเลือกได้มี มีการเรียนการสอนแล้ว กรุณากรอกใหม่",
               icon: "warning",
               button: "ตกลง",
             });
              return false;
           }else {
               $('#form_result').submit();
               return true;
           }
          },
         });
       }else {
         $.ajax({
           type:'POST',
           url:base_url+'/checkedit_synchtime',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{start_date:start_date,end_date:end_date,synch_starttime:synch_starttime,synch_endtime:synch_endtime,select_day:select_day,teacher_id:teacher_id,sync_id:sync_id,teacher_id:teacher_id,subject_id:subject_id},
           success: function (data) {
             if (data == 'repeat') {
               swal({
                 title: "แจ้งเตือน",
                 text: "วิชาที่ท่านเลือก ผู้สอนได้ทำการเรียนการสอนแล้ว กรุณากรอกใหม่",
                 icon: "warning",
                 button: "ตกลง",
               });
             return false;
           }else if (data > 0) {
               swal({
                 title: "แจ้งเตือน",
                 text: "ช่วงเวลาที่ท่านเลือกได้มี มีการเรียนการสอนแล้ว กรุณากรอกใหม่",
                 icon: "warning",
                 button: "ตกลง",
               });
             return false;
             }else {
                $('#form_result').submit();
               return true;
             }
           },
         });
       }
     }
   });
});
