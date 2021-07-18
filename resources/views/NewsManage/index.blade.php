@extends('layouts.app')
@section('content')
<section class="section">
	<div class="section-header">
            <h1>จัดการข่าว/กิจกรรม (News Manager)</h1>
     </div>
     <div class="section-body">
     			<div class="card">
     				<div class="card-header" style="display:block;">
							<div class="row">
								<div class="col-md-6">
									<h4>จัดการข่าว/กิจกรรม (News Manager)</h4>
								</div>
								<div class="col-md-6" align="right" style="margin-top: 31px;margin-bottom: -3px;">
										<a href="{{ route('newsManage.create') }}" class="btn btn-success">เพิ่มข้อมูล</a>
								</div>
							</div>
            </div>
                  <div class="card-body">
                  	<table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">รูปภาพ</th>
                          <th scope="col">หัวข้อ</th>
                          <th scope="col">หมวดหมู่วิชา</th>
													<th scope="col">สถานะ</th>
													<th scope="col">วันที่ลงข้อมูล</th>
													<th scope="col">เครื่องมือ</th>
                        </tr>
                      </thead>
                      <tbody>
												<?php $i=1; foreach ($news as $key => $value): ?>
												<tr>
													<td>{{ $i++ }}</td>
													<td><img src="{{ asset('image/news/'.$value->news_photo)}}" width="80px" height="80px" style="margin-top: 5px;margin-bottom: 5px;"></td>
													<td>{{ $value->news_title }}</td>
													<td>{{ $value->news_title }}</td>
													<td><?php if ($value->news_status == 1): ?>
														แสดง
													<?php elseif($value->news_status == 2): ?>
														ไม่แสดง
													<?php else: ?>
														-
													<?php endif; ?></td>
													<td>{{ formatDateThai( date($value->created_at)) }}</td>
													<td>
														<form class="delete-news-form_{{ $value->news_id }}" action="{{ route('newsManage.destroy',$value->news_id) }}" method="post">
														<a href="{{ route('newsManage.show',$value->news_id) }}" class="btn btn-info"> <i class="fas fa-eye"></i></a>
														<a href="{{ route('newsManage.edit',$value->news_id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
														<button class="btn btn-danger remove_news" data-id="{{ $value->news_id }}" onclick="return false" ><i class="fas fa-trash"></i></button>
														@csrf
														@method('DELETE')
														</form>
													</td>
												</tr>
												<?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
     			</div>
     </div>
</section>
@if (session('success'))
	<script type="text/javascript">
		swal({
			title: "Good job!",
			text: "{{ session('success') }}",
			icon: "success",
			button: "ตกลง",
		});
	</script>
@endif
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.remove_news').click(function() {
		 var news_id = $(this).attr('data-id');
		 swal({
			title: "เเจ้งเตือน",
			text: "คุณต้องการลบข้อมูลหรือไม่",
			icon: "warning",
			buttons:{
				confirm: 'ตกลง',
				cancel: 'ยกเลิก'
			},
			dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {
			$('.delete-news-form_'+news_id).submit();
		}
		});
		});
	});
</script>
@endsection
