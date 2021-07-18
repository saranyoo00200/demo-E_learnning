@extends('layouts.app')
@section('content')
<section class="section" data-id="">
	<div class="section-header">
            <h1>จัดการตารางเรียน (Schedule Time)</h1>
     </div>
     <div class="section-body">
     	<!-- <div class="row"> -->
     		<!-- <div class="col-12"> -->
				<form class="" action="{{ route('schedule_time.update', $scheduleTime->schedule_id ) }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PATCH')
     			<div class="card">
     				<div class="card-header" style="display:block;">
							<div class="row">
								<div class="col-md-12">
									<h4>รายละเอียด ตารางเรียน</h4>
								</div>
							</div>
            </div>
              <div class="card-body">
               <div class="row">
                 <div class="col-md-12">
                   <div class="row">
										 <div class="col-md-3">
											 <div class="form-group">
														<label class="font-weight-bold">หมวดหมู่วิชา</label>
                            <p>{{ $scheduleTime->subjectName }}</p>
												</div>
										 </div>
										 <div class="col-md-3">
											 <div class="form-group">
														<label class="font-weight-bold">สถานที่</label>
                            <p>{{ $scheduleTime->schedule_place}}</p>
												</div>
										 </div>
                   </div>
                   <div class="row">
                     <div class="col-md-3">
                       <div class="form-group" >
                         <label class="font-weight-bold">วันที่เริ่ม</label>
                        <p>{{ formatDateThai( date($scheduleTime->schedule_startdate)) }}</p>
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group" >
                        <label for="">วันที่สิ้นสุด</label>
                        <p>{{ formatDateThai( date($scheduleTime->schedule_enddate)) }}</p>
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group" >
                         <label for="">เวลาที่เริ่ม</label>
                         <p>{{ date('H:i',strtotime($scheduleTime->schedule_starttime)).' น.' }}</p>
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group" >
                         <label for="">เวลาที่สิ้นสุด</label>
                         <p>{{ date('H:i',strtotime($scheduleTime->schedule_endtime)).' น.' }}</p>
                       </div>
                     </div>
                 </div>
               </div>
              </div>
              <div class="card-footer text-right">
                  <button class="btn btn-success" id="submit">บันทึก</button>
                  <a href="{{ url()->previous() }}" class="btn btn-danger">ย้อนกลับ</a>
              </div>
     			</div>
					</form>
     		<!-- </div> -->
     	<!-- </div> -->
     </div>
</section>
@endsection
@section('scripts')
 <script>
     CKEDITOR.replace( 'news_detail' );
</script>
<script type="text/javascript">
	$(document).ready(function() {
		if ($(".clockpicker").length) {
			$(".clockpicker").clockpicker({
				donetext: "OK",
			});
		}
		$('#submit').click(function(e) {
			var news_title = $('#news_title').val();
			var subject_id = $('#subject_id').val();
			var news_status = $('#news_status').val();
			if (news_title == '') {
				swal({
					title: "แจ้งเตือน",
					text: "กรุณากรอก หัวข้อ",
					icon: "warning",
					button: "ตกลง",
				});
				return false;
			}else if (subject_id == '') {
				swal({
					title: "แจ้งเตือน",
					text: "กรุณาเลือก หมวดหมู่วิชา",
					icon: "warning",
					button: "ตกลง",
				});
				return false;
			}else if (news_status == '') {
				swal({
					title: "แจ้งเตือน",
					text: "กรุณาเลือก สถานะ",
					icon: "warning",
					button: "ตกลง",
				});
				return false;
			}else {
				return true;
			}
		});
	});
</script>
@endsection
