@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>จัดการเรียนการสอน</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>ตาราง การเรียนประสานเวลา (วิชา {{ $subjectLearning['subjectName']}})</h4>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12" align="right">
                        <a href="{{ url('/subject_calendar/manage_lesson/create/1/'.$subjectLearning['id'])}}" class="btn btn-success">เพิ่มข้อมูล</a>
                      </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-hover">
                        <table class="table table-striped mb-5" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>ชื่อหลักสูตร</th>
                                    <th>วันที่เริ่ม-วันที่สิ้นสุด</th>
                                    <th>เวลาที่เริ่ม - เวลาที่สิ้นสุด</th>
                                    <th>ผู้สอน</th>
                                    <th>เครื่องมือ</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i=1; foreach ($LessonSynch as $key => $value): ?>
                                <tr>
                                  <td align="center">{{ $i++ }}</td>
                                  <td>{{ $value->lessonName}}</td>

                                  <td>{{ formatDateThai( date($value->start_date)) }} - {{ formatDateThai( date($value->end_date)) }}</td>
                                  <td>{{ $value->synch_time}}</td>
                                  <td>{{ $value->name }}</td>
                                  <td>
                                    <!-- <form class="delete-sync-form_{{ $value->id }}" action="{{ route('subject_calendar.destroy',$value->id) }}" method="POST"> -->
                                    <a  class="btn btn-info" href="{{ url('/subject_calendar/manage_lesson/manage_student/'.$value->lesson_id.'',$value->sync_id)}}"><i class="fas fa-user"></i></a>
                                    <a href="{{ url('/subject_calendar/manage_lesson/edit/'.$subjectLearning['id'].'/'.$value->sync_id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <!-- @csrf
                                    @method('DELETE') -->
                                    <button onclick="SyncDel(<?php echo  $value->sync_id; ?>)" class="btn btn-danger remove_sync"><i class="fas fa-trash"></i></button>
                                    <!-- <a  class="btn btn-danger remove_sync" data-id="{{ $value->id }}"   href="{{ url('/subject_calendar/manage_lesson/delete_lesson/1/' .$value->sync_id) }}">
                                      <i class="fas fa-trash"></i>
                                    </a> -->
                                  <!-- </form> -->
                                  </td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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
    function SyncDel(id) {
      swal({
       title: "เเจ้งเตือน",
       text: "คุณต้องการลบข้อมูลหรือไม่",
       icon: "warning",
       buttons:{
         confirm: 'ตกลง',
         cancel: 'ยกเลิก'
       },
       dangerMode: true,
     }).then(function () {
      $.ajax({
        url: base_url+"/subject_calendar/manage_lesson/delete_lesson/1/"+id,
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
          location.href = base_url+"/subject_calendar/manage_lesson/delete_lesson/1/"+id;
        },
      });
    });
  }
    </script>
@endsection
