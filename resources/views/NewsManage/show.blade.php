@extends('layouts.app')
@section('content')
<section class="section" data-id="{{ @$user->id }}">
	<div class="section-header">
            <h1>จัดการข่าว/กิจกรรม (News Manager)</h1>
     </div>
     <div class="section-body">
     			<div class="card">
     				<div class="card-header" style="display:block;">
							<div class="row">
								<div class="col-md-12">
									<h4>ดูรายละเอียดข้อมูล ข่าว/กิจกรรม</h4>
								</div>
							</div>
            </div>
              <div class="card-body">
               <div class="row">
                 <div class="col-md-12">
                   <div class="row">
                     <div class="col-md-6">
                         <div class="form-group">
                              <label>หัวข้อ</label><br>
                              {{ $news[0]->news_title }}
                          </div>
                     </div>
										 <div class="col-md-6">
											 <div class="form-group">
														<label>หมวดหมู่วิชา</label><br>
															<?php foreach ($subjectLearning as $key => $value): ?>
                                <?= ($news[0]->subject_id == $value->id) ? $value->subjectName : ''; ?>
															<?php endforeach; ?>
												</div>
										 </div>
                     <div class="col-md-6">
                       <div class="form-group">
                            <label>สถานะ</label><br>
                            <?php if ($news[0]->news_status == 1): ?>
                              แสดง
                            <?php elseif($news[0]->news_status == 2): ?>
                              ไม่แสดง
                            <?php else: ?>
                              -
                            <?php endif; ?>
                        </div>
                     </div>
                     <div class="col-md-12">
                     	<div class="form-group">
                     		<label>รายละเอียด</label><br>
               		       {!! $news[0]->news_detail !!}
                     	</div>
                     </div>
                     <?php if ($news[0]->news_photo != ''): ?>
                       <div class="col-md-6">
                          <div class="form-group">
                         <label>ไฟล์ภาพ</label><br>
                         <img src="{{ asset('image/news/'.$news[0]->news_photo)}}" alt="" style="width: 250px;height: 250px;">
                       </div>
                     </div>
                     <?php endif; ?>
                 </div>
               </div>
              </div>
              <div class="card-footer text-right">
                  <a href="{{ url()->previous() }}" class="btn btn-danger">ย้อนกลับ</a>
              </div>
     			</div>
     </div>
</section>
@endsection
