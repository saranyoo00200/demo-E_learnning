$(document).ready(function() {
   $('.datepicker').datepicker({
     format: "dd/mm/yyyy",
     autoclose: true,
     language:'th-th',
   });
   $('#submit').click(function(e) {
     var lesson_id = $('#lesson_id').val();
     var start_date = $('#start_date').val();
     var end_date = $('#end_date').val();
     var synch_time = $('#synch_time').val();
     var synch_amount = $('#synch_amount').val();
     var teacher_id = $('#teacher_id').val();
     var synch_status = $('#synch_status').val();
     if (lesson_id == '') {
       swal({
         title: "แจ้งเตือน",
         text: "กรุณาเลือก ชื่อหลักสูตร",
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
     }else if (synch_time == '') {
       swal({
         title: "แจ้งเตือน",
         text: "กรุณาเลือก เวลาที่เริ่ม - เวลาที่สิ้นสุด",
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
     }else {
       return true;
     }
   });
});
