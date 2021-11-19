@extends('layouts.app')
@section('content')
<section class="section" data-id="">
	<div class="section-header">
            <h1>จัดการตารางเรียน (Schedule Time)</h1>
     </div>
     <div class="section-body">
     	<!-- <div class="row"> -->
     		<!-- <div class="col-12"> -->
				<form class="" id='form_result' action="{{route('schedule_time.store')}}" method="post" enctype="multipart/form-data">
				 @csrf
     			<div class="card">
     				<div class="card-header" style="display:block;">
							<div class="row">
								<div class="col-md-12">
									<h4>เพิ่มข้อมูล ตารางเรียน</h4>
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
																<option value="{{$value->id}}">{{$value->subjectName.' '.$value->subjectId}}</option>
															<?php endforeach; ?>
														</select>
												</div>
										 </div>
										 <div class="col-md-3">
											 <div class="form-group">
														<label>สถานที่</label>
														 <input type="text" class="form-control"  id="schedule_place"  name="schedule_place" value="">
												</div>
										 </div>
                   </div>
                   <div class="row">
                     <div class="col-md-3">
                       <div class="form-group" >
                         <label for="">วันที่เริ่ม</label>
                         <input type="text" class="form-control datepicker date" data-provide="datepicker" data-date-language="th-th" id="schedule_startdate"  name="schedule_startdate" value="">
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group" >
                         <label for="">วันที่สิ้นสุด</label>
                         <input type="text" class="form-control datepicker date" data-provide="datepicker" data-date-language="th-th" id="schedule_enddate" name="schedule_enddate" value="">
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group" >
                         <label for="">เวลาที่เริ่ม</label>
                         <input type="text" class="form-control clockpicker"   id="schedule_starttime"  name="schedule_starttime" value="">
                       </div>
                     </div>
                     <div class="col-md-3">
                       <div class="form-group" >
                         <label for="">เวลาที่สิ้นสุด</label>
                         <input type="text" class="form-control clockpicker"   id="schedule_endtime"  name="schedule_endtime" value="">
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
													<input type="checkbox" name="repeat_day[1]" value="1" class="selectgroup-input select_day">
													<span class="selectgroup-button">จันทร์</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[2]" value="2" class="selectgroup-input select_day">
													<span class="selectgroup-button">อังคาร</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[3]" value="3" class="selectgroup-input select_day">
														<span class="selectgroup-button">พุธ</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[4]" value="4" class="selectgroup-input select_day">
													<span class="selectgroup-button">พฤหัสบดี</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[5]" value="5" class="selectgroup-input select_day">
													<span class="selectgroup-button">ศุกร์</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[6]" value="6" class="selectgroup-input select_day">
													<span class="selectgroup-button">เสาร์</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="repeat_day[7]" value="7" class="selectgroup-input select_day">
													<span class="selectgroup-button">อาทิตย์</span>
												</label>
											</div>
										</div>
								</div>
							</div>
              <div class="card-footer text-right">
                  <span class="btn btn-success" id="submit">บันทึก</span>
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
			var convert_startdate = schedule_startdate.split("/");
			var convert_starttime = schedule_starttime.split(":");
			var convert_enddate = schedule_enddate.split("/");
			var convert_endtime = schedule_endtime.split(":");
			var dateOne = new Date(convert_startdate[2]-543,convert_startdate[1],convert_startdate[0],convert_starttime[0],convert_starttime[1],00);
			var dateTwo = new Date(convert_enddate[2]-543,convert_enddate[1],convert_enddate[0],convert_endtime[0],convert_endtime[1],00);
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
			}else if (dateOne > dateTwo) {
				swal({
					title: "แจ้งเตือน",
					text: "ข้อมูลวันเวลาที่เริ่มผิด กรุณากรอกใหม่",
					icon: "warning",
					button: "ตกลง",
				});
				return false;
			}else  if(dateTwo < dateOne){
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
				var schedule_startdate = $('#schedule_startdate').val();
				var schedule_enddate = $('#schedule_enddate').val();
				var schedule_starttime = $('#schedule_starttime').val();
				var schedule_endtime = $('#schedule_endtime').val();
				var select_day = [];
				 i = 0;
				$('.select_day:checked').each(function () {
					select_day[i++] = $(this).val();
				});
				$.ajax({
					type:'POST',
					url:base_url+'/check_timetable',
					headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data:{schedule_startdate:schedule_startdate,schedule_enddate:schedule_enddate,schedule_starttime:schedule_starttime,schedule_endtime:schedule_endtime,select_day:select_day},
					success: function (data) {
						if (data > 0) {
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
				})
			}
		});
	});
</script>
@endsection
