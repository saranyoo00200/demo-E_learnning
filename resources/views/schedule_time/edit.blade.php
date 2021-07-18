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
									<h4>แก้ไข ตารางเรียน</h4>
								</div>
							</div>
            </div>
              <div class="card-body">
               <div class="row">
                 <div class="col-md-12">
                   <div class="row">
										 <div class="col-md-3">
											 <div class="form-group">
														<label>หมวดหมู่วิชา</label>
														<select class="form-control" name="schedule_subject" id="schedule_subject">
															<option value="">เลือก</option>
															<?php foreach ($subjectLearning as $key => $value): ?>
																<option <?php if ($value->id == $scheduleTime->schedule_subject): ?>
																	<?php echo 'selected'; ?>
																<?php endif; ?> value="{{$value->id}}">{{$value->subjectName.' '.$value->subjectId}}</option>
															<?php endforeach; ?>
														</select>
												</div>
										 </div>
										 <div class="col-md-3">
											 <div class="form-group">
														<label>สถานที่</label>
														 <input type="text" class="form-control"  id="schedule_place"  name="schedule_place" value="{{ $scheduleTime->schedule_place}}">
												</div>
										 </div>
                   </div>
                   <div class="row">
                     <div class="col-md-3">
                       <div class="form-group" >
                         <label for="">วันที่เริ่ม</label>
												 <?php
												if (!empty($scheduleTime->schedule_startdate)) {
													list($y,$m,$d) = explode('-',$scheduleTime->schedule_startdate);
													$schedule_startdate = "{$d}/{$m}/".($y+543);
												}
												?>
                         <input type="text" class="form-control datepicker date" data-provide="datepicker" data-date-language="th-th" id="schedule_startdate"  name="schedule_startdate" value="{{ $schedule_startdate }}">
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group" >
                         <label for="">วันที่สิ้นสุด</label>
												 <?php
											 if (!empty($scheduleTime->schedule_enddate)) {
												 list($y,$m,$d) = explode('-',$scheduleTime->schedule_enddate);
												 $schedule_enddate = "{$d}/{$m}/".($y+543);
											 }
											 ?>
                         <input type="text" class="form-control datepicker date" data-provide="datepicker" data-date-language="th-th" id="schedule_enddate" name="schedule_enddate" value="{{ $schedule_enddate }}">
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group" >
                         <label for="">เวลาที่เริ่ม</label>
                         <input type="text" class="form-control clockpicker"   id="schedule_starttime"  name="schedule_starttime" value="{{ date('H:i',strtotime($scheduleTime->schedule_starttime)) }}">
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group" >
                         <label for="">เวลาที่สิ้นสุด</label>
                         <input type="text" class="form-control clockpicker"   id="schedule_endtime"  name="schedule_endtime" value="{{ date('H:i',strtotime($scheduleTime->schedule_endtime)) }}">
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
			var schedule_subject = $('#schedule_subject').val();
			var schedule_place = $('#schedule_place').val();
			var schedule_startdate = $('#schedule_startdate').val();
			var schedule_enddate = $('#schedule_enddate').val();
			var schedule_starttime = $('#schedule_starttime').val();
			var schedule_endtime = $('#schedule_endtime').val();
			if (schedule_subject == '') {
				swal({
					title: "แจ้งเตือน",
					text: "กรุณาเลือก หมวดหมู่วิชา",
					icon: "warning",
					button: "ตกลง",
				});
				return false;
			}else if (schedule_place == '') {
				swal({
					title: "แจ้งเตือน",
					text: "กรุณากรอก สถานที่",
					icon: "warning",
					button: "ตกลง",
				});
				return false;
			}else if (schedule_startdate == '') {
				swal({
					title: "แจ้งเตือน",
					text: "กรุณากรอก วันที่เริ่ม",
					icon: "warning",
					button: "ตกลง",
				});
				return false;
			}else if (schedule_enddate == '') {
				swal({
					title: "แจ้งเตือน",
					text: "กรุณากรอก วันที่สิ้นสุด",
					icon: "warning",
					button: "ตกลง",
				});
				return false;
			}else if (schedule_starttime == '') {
				swal({
					title: "แจ้งเตือน",
					text: "กรุณากรอก เวลาที่เริ่ม",
					icon: "warning",
					button: "ตกลง",
				});
				return false;
			}else if (schedule_endtime == '') {
				swal({
					title: "แจ้งเตือน",
					text: "กรุณากรอก เวลาที่สิ้นสุด",
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
