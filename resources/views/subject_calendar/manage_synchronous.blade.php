@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>จัดการเรียนการสอน</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if($id == 1): ?>
                            <h4>วิชาเรียนออนไลน์</h4>
                            <?php else: ?>
                            <h4>วิชาเรียนออฟไลน์</h4>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($id == 1): ?>
                    <?php if (auth()->user()->user_type == 1): ?>
                    <div class="row">
                        <div class="col-md-12" align="right">
                            <a href="{{ url('subject_calendar/manage_synchronous/create', 1) }}"
                                class="btn btn-success">เพิ่มข้อมูล</a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-hover">
                        <?php if ($id == 1): ?>
                        <table class="table table-striped mb-5" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <i class="fas fa-th"></i>
                                    </th>
                                    <th>ชื่อวิชา</th>
                                    <th>วันที่เริ่ม-วันที่สิ้นสุด</th>
                                    <th>เวลาที่เริ่ม - เวลาที่สิ้นสุด</th>
                                    <th>ผู้สอน</th>
                                    <th>เครื่องมือ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($subjectLearning as $key => $value): ?>
                                <tr>
                                    <td align="center">{{ $key + 1 }}</td>
                                    <td>{{ $value->subjectName }}</td>
                                    <td>{{ formatDateThai(date($value->start_date)) }} -
                                        {{ formatDateThai(date($value->end_date)) }}</td>
                                    <td>
                                        <?php
                                        $end = "$value->end_date $value->synch_endtime";
                                        ?>
                                        {{ date('H:i', strtotime($value->synch_starttime)) }} -
                                        {{ date('H:i', strtotime('+1 minutes', strtotime($end))) }} น.
                                    </td>
                                    <td>{{ $value->name }}</td>
                                    <td>
                                        <form class="delete-time-form_<?php echo $value->sync_id; ?>"
                                            action="{{ url('/subject_calendar/manage_synchronous/delete_subject/1/' . $value->sync_id) }}"
                                            method="post">
                                            <a class="btn btn-info"
                                                href="{{ url('/subject_calendar/manage_synchronous/manage_class/1/' . $value->sync_id) }}"><i
                                                    class="fas fa-user"></i></a>
                                            <a href="{{ url('/subject_calendar/manage_synchronous/edit/1/' . $value->sync_id) }}"
                                                class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <span class="btn btn-danger remove_sync" data-id="<?php echo $value->sync_id; ?>"><i
                                                    class="fas fa-trash"></i></span>
                                            @csrf
                                            @method('POST')
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <table class="table table-striped mb-5" id="sortable-table">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">
                                        <i class="fas fa-th"></i>
                                    </th>
                                    <th>ชื่อวิชา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($subjectLearning as $key => $value): ?>
                                <tr>
                                    <td align="center">{{ $key + 1 }}</td>
                                    <td>{{ $value->subjectName }}</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
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
        $('.remove_sync').click(function() {
            var sync_id = $(this).attr('data-id');
            swal({
                    title: "เเจ้งเตือน",
                    text: "คุณต้องการลบข้อมูลหรือไม่",
                    icon: "warning",
                    buttons: {
                        confirm: 'ตกลง',
                        cancel: 'ยกเลิก'
                    },
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('.delete-time-form_' + sync_id).submit();
                    }
                });
        });
        //   function SyncDel(id) {
        //     swal({
        //      title: "เเจ้งเตือน",
        //      text: "คุณต้องการลบข้อมูลหรือไม่",
        //      icon: "warning",
        //      buttons:{
        //        confirm: 'ตกลง',
        //        cancel: 'ยกเลิก'
        //      },
        //      dangerMode: true,
        //    }).then(function () {
        //     $.ajax({
        //       url: base_url+"/subject_calendar/manage_synchronous/delete_subject/1/"+id,
        //       type: "GET",
        //       headers: {
        //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //       },
        //       success: function (data) {
        //         location.href = base_url+"/subject_calendar/manage_synchronous/delete_subject/1/"+id;
        //       },
        //     });
        //   });
        // }
    </script>
@endsection
