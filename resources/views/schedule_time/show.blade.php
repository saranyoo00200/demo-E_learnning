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
                         <p>
													 <?php
													 $end = "$scheduleTime->schedule_enddate $scheduleTime->schedule_endtime";
													 echo date('H:i',strtotime('+1 minutes',strtotime($end)));
												  	?>น.
													 </p>
                       </div>
                     </div>
                 </div>
               </div>
              </div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
											<label class="form-label">ทำซ้ำวัน</label>
											<div class="selectgroup selectgroup-pills">
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[1]" <?= (!empty($repeat_day[1])) ? 'checked' : ''?> value="1" class="selectgroup-input" disabled>
													<span class="selectgroup-button">จันทร์</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[2]" <?= (!empty($repeat_day[2])) ? 'checked' : ''?> value="2" class="selectgroup-input" disabled>
													<span class="selectgroup-button">อังคาร</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[3]" <?= (!empty($repeat_day[3])) ? 'checked' : ''?> value="3" class="selectgroup-input" disabled>
														<span class="selectgroup-button">พุธ</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[4]" <?= (!empty($repeat_day[4])) ? 'checked' : ''?> value="4" class="selectgroup-input" disabled>
													<span class="selectgroup-button">พฤหัสบดี</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[5]" <?= (!empty($repeat_day[5])) ? 'checked' : ''?> value="5" class="selectgroup-input" disabled>
													<span class="selectgroup-button">ศุกร์</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[6]" <?= (!empty($repeat_day[6])) ? 'checked' : ''?> value="6" class="selectgroup-input" disabled>
													<span class="selectgroup-button">เสาร์</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[7]" <?= (!empty($repeat_day[7])) ? 'checked' : ''?> value="7" class="selectgroup-input" disabled>
													<span class="selectgroup-button">อาทิตย์</span>
												</label>
											</div>
										</div>
								</div>
							</div>
              <div class="card-footer text-right">
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
