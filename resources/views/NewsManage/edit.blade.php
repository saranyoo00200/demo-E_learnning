@extends('layouts.app')
@section('content')
<section class="section" data-id="{{ @$user->id }}">
	<div class="section-header">
            <h1>จัดการข่าว/กิจกรรม (News Manager)</h1>
     </div>
     <div class="section-body">
     	<!-- <div class="row"> -->
     		<!-- <div class="col-12"> -->
				<form class="" action="{{route('newsManage.update',$news[0]->news_id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
     			<div class="card">
     				<div class="card-header" style="display:block;">
							<div class="row">
								<div class="col-md-12">
									<h4>แก้ไขข้อมูล ข่าว/กิจกรรม</h4>
								</div>
							</div>
            </div>
              <div class="card-body">
               <div class="row">
                 <div class="col-md-12">
                   <div class="row">
                     <div class="col-md-6">
                         <div class="form-group">
                              <label>หัวข้อ</label>
                              <input type="text" class="form-control" value="{{ $news[0]->news_title }}" name="news_title" id="news_title" >
                          </div>
                     </div>
										 <div class="col-md-6">
											 <div class="form-group">
														<label>หมวดหมู่วิชา</label>
														<select class="form-control" name="subject_id" id="subject_id">
															<option>เลือก</option>
															<?php foreach ($subjectLearning as $key => $value): ?>
																<option <?= ($news[0]->subject_id == $value->id) ? 'selected' : ''; ?>  value="{{$value->id}}">{{$value->subjectName}}</option>
															<?php endforeach; ?>
														</select>
												</div>
										 </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label>สถานะ</label>
                            <select class="form-control" name="news_status" id="news_status">
                              <option value="">เลือก</option>
															<option  <?= ($news[0]->news_status == 1) ? 'selected' : ''; ?>  value="1">แสดง</option>
															<option  <?= ($news[0]->news_status == 2) ? 'selected' : ''; ?>  value="2">ไม่แสดง</option>
                            </select>
                        </div>
                     </div>
                     <div class="col-md-12">
                     	<div class="form-group">
                     		<label>รายละเอียด</label>
                  	<textarea name="news_detail" id="news_detail" rows="10" cols="80">
               		     {!! $news[0]->news_detail !!}
            		</textarea>
                     	</div>
                     </div>
                     <div class="col-md-6">
                     	   <div class="form-group">
                       <label>ไฟล์ภาพ</label><br>
											 <?php if ($news[0]->news_photo != ''): ?>
												 <img src="{{ asset('image/news/'.$news[0]->news_photo)}}" alt="" class="mb-3" style="width: 250px;height: 250px;"><br>
											 <?php endif; ?>
                       <input type="file" name="news_photo"  onchange="loadFile(event)" class="form-control">
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
<script>
var loadFile = function(event) {
var reader = new FileReader();
reader.onload = function(){
var output = document.getElementById('output');
output.src = reader.result;
 };
 reader.readAsDataURL(event.target.files[0]);
};
</script>
@endsection
@section('scripts')
 <script>
     CKEDITOR.replace( 'news_detail' );
</script>
<script type="text/javascript">
	$(document).ready(function() {
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
