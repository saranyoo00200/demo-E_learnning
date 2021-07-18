@extends('layouts.app')
@section('content')
<section class="section" data-id="{{ @$user->id }}">
	<div class="section-header">
            <h1>จัดการผู้ใช้งาน(User Manager)</h1>
     </div>
     <div class="section-body">
     	<!-- <div class="row"> -->
     		<!-- <div class="col-12"> -->
				<form class="" action="{{ url('/update_access/'. $user_id) }}" method="post" enctype="multipart/form-data">
				 @csrf
     			<div class="card">
     				<div class="card-header" style="display:block;">
							<div class="row">
								<div class="col-md-12">
									<h4>การเข้าถึงสิทธิ์</h4>
								</div>
							</div>
            </div>
              <div class="card-body">
               <div class="row">
								 <div class="col-md-12">
									 <table class="table">
										 <tr>
											 <th class="text-center">#</th>
											 <th>ปี พ.ศ.</th>
											 <th>รหัสวิชา</th>
											 <th>ชื่อวิชา</th>
											 <th>หมวดหมู่</th>
										 </tr>
										 <?php $i=1; foreach ($subjectLearning as $key => $value): ?>
											 <tr>
												 <td class="text-center" width="5%">
													 {{ $i++ }}
												 </td>
												 <td>{{ $value->schoolYear }}</td>
												 <td>{{ $value->subjectId }}</td>
												 <td>{{ $value->subjectName }}</td>
												 <td> @if ($value->subjectType == 1)
																		 <div class="badge badge-success">คอมพิวเตอร์</div>
														 @elseif ($value->subjectType == 2)
																		 <div class="badge badge-info">ภาษาไทย</div>
														 @elseif ($value->subjectType == 3)
																		 <div class="badge badge-secondary">ภาษาอังกฤษ</div>
														 @endif</td>
											 </tr>
											 <?php if (!empty($data_group[$value->id])): ?>
												 <?php foreach ($data_group[$value->id] as $key => $lesson): ?>
													 <tr>
														 <td class="text-center">
															 <div class="col-auto">
														 <label class="colorinput">
															 <input name="select_id[<?= $key; ?>]" <?php if(!empty($data_check[$lesson->id])){ echo "checked"; }; ?>  type="checkbox" value="1"  class="colorinput-input">
															 <input type="hidden" name="subject_id[<?= $key; ?>]"  value="{{ $lesson->subject_id }}">
															 <input type="hidden" name="lesson_id[<?= $key; ?>]"  value="{{ $lesson->id}}">
															 <span class="colorinput-color bg-primary"></span>
														 </label>
													 </div>
														 </td>
														 <td colspan="4">
															 บทเรียนที่: {{ $lesson->lesson }} {{ $lesson->lessonName }}
														 </td>
													 </tr>
												 <?php endforeach; ?>
											 <?php endif; ?>
										 <?php endforeach; ?>
									 </table>
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

@endsection
