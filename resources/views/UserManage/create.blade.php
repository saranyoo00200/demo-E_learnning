@extends('layouts.app')
@section('content')
<section class="section" data-id="{{ @$user->id }}">
	<div class="section-header">
            <h1>จัดการผู้ใช้งาน(User Manager)</h1>
     </div>
     <div class="section-body">
     	<!-- <div class="row"> -->
     		<!-- <div class="col-12"> -->
				<form class="" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
				 @csrf
     			<div class="card">
     				<div class="card-header" style="display:block;">
							<div class="row">
								<div class="col-md-12">
									<h4>เพิ่มข้อมูลผู้ใช้งาน</h4>
								</div>
							</div>
            </div>
              <div class="card-body">
               <div class="row">
                 <div class="col-md-8">
                   <div class="row">
                     <div class="col-md-6">
                         <div class="form-group">
                              <label>Username</label>
                              <input type="text" class="form-control" name="username" id="username" >

                          </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" id="password" >
                          </div>
                     </div>
                       <div class="col-md-6">
                       <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name=""  id="confirm_password" >
                          </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label>ชื่อ-นามสกุล</label>
                            <input type="text" class="form-control" name="name" id="name" >
                        </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label>อีเมล</label>
                            <input type="text" class="form-control" name="email" id="email" >
                        </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label>เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="phone" id="phone" >
                        </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label>สถานะ</label>
                            <select class="form-control" name="user_status" id="user_status">
                              <option value="">เลือก</option>
                              <option value="1">ใช้งาน</option>
                              <option value="2">ไม่ใช้งาน</option>
                            </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label>ประเภทผู้ใช้</label>
                            <select class="form-control" name="user_type" id="user_type">
                              <option>เลือก</option>
                              <option value="1">เจ้าหน้าที่</option>
                              <option value="2">ผู้ใช้บริการ</option>
                              <option value="3">คุณครู</option>
                            </select>
                        </div>
                     </div>
                   </div>
                 </div>
                 <div class="col-md-4">
                   <div class="row">
                     <div class="col-md-12" align="center">
                       <img id="output" src="{{ asset('assets/backend/img/avatar/avatar-1.png') }}" class="img-profile rounded-circle" alt="" width="250px;"  height="250px;">
                     </div>
                     <div class="col-md-12" style="margin-top: 34px;">
                       <div class="form-group">
                       <label>ไฟล์ภาพ</label>
                       <input type="file" name="user_photo"  onchange="loadFile(event)" class="form-control">
                     </div>
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
  <script src="{{asset('assets/backend/js/modules/UserManage/User.js')}}"></script>
@endsection
