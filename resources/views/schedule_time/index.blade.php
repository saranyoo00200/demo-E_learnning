@extends('layouts.app')
@section('content')
<section class="section">
  <div class="section-header">
      <h1>จัดการตารางเรียน</h1>
      <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Components</a></div>
          <div class="breadcrumb-item">Table</div>
      </div>
  </div>
  <div class="section-body">
    <div class="card">
      <div class="card-header" style="display:block;">
        <div class="row">
          <div class="col-md-6">
            <h4>จัดการตารางเรียน (Schedule Time)</h4>
          </div>
          <div class="col-md-6" align="right" style="margin-top: 31px;margin-bottom: -3px;">
              <a href="{{ url('ShowTimeTable')}}" class="btn btn-info">ดูตารางเรียน</a>
              <a href="{{ route('schedule_time.create')}}" class="btn btn-success">เพิ่มข้อมูล</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">วิชา</th>
              <th scope="col">วันที่เริ่มต้น</th>
              <th scope="col">วันที่สิ้นสุด</th>
              <th scope="col">เวลาเริ่มต้น-เวลาสิ้นสุด</th>
              <th scope="col">เครื่องมือ</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1; foreach ($scheduletime as $key => $value): ?>
            <tr>
              <th scope="col">{{ $i++ }}</th>
              <th scope="col">{{ $value->subjectName }} ({{ $value->subjectId }})</th>
              <th scope="col">{{ formatDateThai( date($value->schedule_startdate)) }}</th>
              <th scope="col">{{ formatDateThai( date($value->schedule_enddate)) }}</th>
              <th scope="col">{{ date("H:i",strtotime($value->schedule_starttime)) }}-{{ date("H:i",strtotime($value->schedule_endtime)) }} น.</th>
              <th scope="col">
                <form class="delete-time-form_{{ $value->schedule_id }}" action="{{ route('schedule_time.destroy',$value->schedule_id) }}" method="post">
                <a href="{{ route('schedule_time.show',$value->schedule_id)}}" class="btn btn-info"> <i class="fas fa-eye"></i></a>
                <a href="{{ route('schedule_time.edit',$value->schedule_id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <button class="btn btn-danger remove_schedule" data-id="{{ $value->schedule_id }}" onclick="return false" ><i class="fas fa-trash"></i></button>
                @csrf
                @method('DELETE')
                </form>
              </th>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection
@section('scripts')
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
<script type="text/javascript">
$(document).ready(function() {
  $('.remove_schedule').click(function() {
   var user_id = $(this).attr('data-id');
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
    $('.delete-time-form_'+user_id).submit();
  }
  });
  });
});
</script>
@endsection
