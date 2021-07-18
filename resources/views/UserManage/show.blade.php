@extends('layouts.app')
@section('content')
<section class="section">
	<div class="section-header">
            <h1>จัดการผู้ใช้งาน(User Manager)</h1>
     </div>
     <div class="section-body">
     	<!-- <div class="row"> -->
     		<!-- <div class="col-12"> -->
     			<div class="card">
     				<div class="card-header" style="display:block;">
							<div class="row">
								<div class="col-md-12">
									<h4>รายละเอียดข้อมูลผู้ใช้งาน</h4>
								</div>
							</div>
            </div>
              <div class="card-body">
               <div class="row">
                  <div class="col-md-4">
                   <div class="row">
                     <div class="col-md-12" align="center">
                       <?php if ($user->user_photo != ''): ?>
                          <img id="output" src="{{ asset('assets/backend/img/user_profile/'.$user->user_photo) }}" class="img-profile rounded-circle" alt="" width="250px;"  height="250px;">
                       <?php else: ?>
                          <img id="output" src="{{ asset('assets/backend/img/avatar/avatar-1.png') }}" class="img-profile rounded-circle" alt="" width="250px;"  height="250px;">
                       <?php endif; ?>
                     </div>
                   </div>
                 </div>
                 <div class="col-md-8">
                   <div class="row">
                     <div class="col-md-6">
                         <div class="form-group">
                              <label class="font-weight-bold"><b>Username</b></label>
                              <p>{{ $user->username }}</p>
                          </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label class="font-weight-bold">ชื่อ-นามสกุล</label>
                            <p>{{ $user->name }}</p>
                        </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label class="font-weight-bold">อีเมล</label>
                            <p>{{ $user->email }}</p>
                        </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label class="font-weight-bold">เบอร์โทรศัพท์</label>
                            <p>{{ $user->phone }}</p>
                        </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label class="font-weight-bold">สถานะ</label>
                              <?php if ($user->user_status == 1): ?>
                                <p class="text-success">ใช้งาน</p>
                              <?php else: ?>
                                <p class="text-danger">ไม่ใช้งาน</p>
                              <?php endif ?>
                        </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label class="font-weight-bold">ประเภทผู้ใช้</label>
                            <p>
                               <?php if ($user->user_type == 1): ?>
                                    เจ้าหน้าที่
                                <?php elseif($user->user_type == 2): ?>
                                    ผู้ใช้บริการ
                                <?php elseif($user->user_type == 3): ?>
                                    ครู
                                <?php elseif($user->user_type == 4): ?>
                                    นักเรียน
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </p>
                        </div>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              <div class="card-footer text-right">
                  <a href="{{ url()->previous() }}" class="btn btn-danger">ย้อนกลับ</a>
              </div>
     			</div>
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
