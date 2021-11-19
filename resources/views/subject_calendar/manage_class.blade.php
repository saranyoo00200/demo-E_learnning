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
                        <div class="col-md-12">
                            <h4>ตาราง จัดการผู้เข้าเรียน แบบเรียนออนไลน์ (วิชา {{ @$subjectLearning->subjectName }} )
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">ชื่อหลักสูตร</label>
                                <p>{{ @$subjectLearning->subjectName }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">วันที่เริ่ม</label>
                                <p>{{ formatDateThai(date($subjectLearning->start_date)) }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">วันที่สิ้นสุด</label>
                                <p>{{ formatDateThai(date($subjectLearning->end_date)) }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">เวลาที่เริ่ม - เวลาที่สิ้นสุด</label>
                                <?php
                                $end = "$subjectLearning->end_date $subjectLearning->synch_endtime";
                                ?>
                                <p>{{ date('H:i', strtotime($subjectLearning->synch_starttime)) }} -
                                    {{ date('H:i', strtotime('+1 minutes', strtotime($end))) }} น.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">จำนวนที่เปิดรับ</label>
                                <p>{{ $subjectLearning->synch_amount }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">ผู้สอน</label>
                                <p>{{ $subjectLearning->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">ลิงค์ Url</label>
                                <p>{{ $subjectLearning->synch_url }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">สถานะแบบทดสอบหลังสอบ</label>
                                <?php if ($subjectLearning->synch_openpost == 1): ?>
                                <p class="text-success mb-0">ใช้งาน</p>
                                <?php else: ?>
                                <p class="text-danger mb-0">ไม่ใช้งาน</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">สถานะ</label>
                                <?php if ($subjectLearning->synch_status == 1): ?>
                                <p class="text-success mb-0">ใช้งาน</p>
                                <?php else: ?>
                                <p class="text-danger mb-0">ไม่ใช้งาน</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">ทำซ้ำวัน</label>
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="synch_repeatday[1]"
                                            <?= !empty($repeat_day[1]) ? 'checked' : '' ?> value="1"
                                            class="selectgroup-input select_day" disabled>
                                        <span class="selectgroup-button">จันทร์</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="synch_repeatday[2]"
                                            <?= !empty($repeat_day[2]) ? 'checked' : '' ?> value="2"
                                            class="selectgroup-input select_day" disabled>
                                        <span class="selectgroup-button">อังคาร</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="synch_repeatday[3]"
                                            <?= !empty($repeat_day[3]) ? 'checked' : '' ?> value="3"
                                            class="selectgroup-input select_day" disabled>
                                        <span class="selectgroup-button">พุธ</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="synch_repeatday[4]"
                                            <?= !empty($repeat_day[4]) ? 'checked' : '' ?> value="4"
                                            class="selectgroup-input select_day" disabled>
                                        <span class="selectgroup-button">พฤหัสบดี</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="synch_repeatday[5]"
                                            <?= !empty($repeat_day[5]) ? 'checked' : '' ?> value="5"
                                            class="selectgroup-input select_day" disabled>
                                        <span class="selectgroup-button">ศุกร์</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="synch_repeatday[6]"
                                            <?= !empty($repeat_day[6]) ? 'checked' : '' ?> value="6"
                                            class="selectgroup-input select_day" disabled>
                                        <span class="selectgroup-button">เสาร์</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="synch_repeatday[7]"
                                            <?= !empty($repeat_day[7]) ? 'checked' : '' ?> value="7"
                                            class="selectgroup-input select_day" disabled>
                                        <span class="selectgroup-button">อาทิตย์</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 mb-2 mr-1">
                    <div class="col-md-12" align="right">
                        <button class="btn btn-success" data-toggle="modal"
                            data-target="#exampleModal">เพิ่มนักเรียน</button>
                    </div>
                </div>
                <form class=""  action="
                    {{ url('subject_calendar/manage_synchronous/manage_class/update_class/' . $type . '/' . $subjectLearning->sync_id) }}"
                    method="post">
                    @csrf
                    <div class="card-body p-0">
                        <div class="table-responsive table-hover">
                            <table class="table table-striped mb-5" id="sortable-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <i class="fas fa-th"></i>
                                        </th>
                                        <th>Username</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>อีเมล</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>อนุมัติ</th>
                                        <th>เครื่องมือ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($classStudent  as $key => $value): ?>
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $value->username }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>
                                            <div class="col-auto">
                                                <label class="colorinput">
                                                    <input name="select_id[{{ $value->user_id }}]" <?php if ($value->student_status == 1): ?>
                                                        checked <?php endif; ?> type="checkbox" value="1"
                                                        class="colorinput-input">
                                                    <input type="hidden" name="user_id[{{ $value->user_id }}]"
                                                        value="{{ $value->user_id }}">
                                                    <span class="colorinput-color bg-primary"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <span href="#" onclick="StudentDel(<?php echo $value->class_id; ?>)"
                                                class="btn btn-danger remove_student"><i class="fas fa-trash"></i></span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success">บันทึก</button>
                        <a href="{{ url()->previous() }}" class="btn btn-danger">ย้อนกลับ</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <form class="" id=" form_result"
        action="{{ url('subject_calendar/manage_synchronous/add_student/' . $type . '/' . $subjectLearning->sync_id) }}"
        method="post">
        @csrf
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ข้อมูลนักเรียน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">ชื่อผู้ใช้บริการ</label>
                                    <div class="input-group">
                                        <select class="custom-select" name="user_id" id="user_id">
                                            <option value="">เลือก...</option>
                                            <?php foreach ($User as $key => $value): ?>
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <div class="input-group-append">
                          <span class="btn btn-primary" id="button-search"><i class="fas fa-search mt-1"></i></span>
                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">Username</label>
                                <p id="username">-</p>
                            </div>
                            <div class="col-md-12">
                                <label for="">ชื่อ-นามสกุล</label>
                                <p id="name">-</p>
                            </div>
                            <div class="col-md-12">
                                <label for="">อีเมล</label>
                                <p id="email">-</p>
                            </div>
                            <div class="col-md-12">
                                <label for="">เบอร์โทรศัพท์</label>
                                <p id="phone">-</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <input type="hidden" name="subject_id" id="subject_id"
                            value="{{ $subjectLearning->subject_id }}">
                        <input type="hidden" name="user_add" id="user_add" value="">
                        <input type="hidden" name="sync_id" value="{{ $subjectLearning->sync_id }}">
                        <span class="btn btn-success" id="add_student">ตกลง</span>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
            $('#user_id').change(function(event) {
                var user_id = $('#user_id').val();
                var sync_id = <?php echo $subjectLearning->sync_id; ?>;
                $.ajax({
                    type: 'POST',
                    url: base_url + '/get_student',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        user_id: user_id,
                        sync_id: sync_id
                    },
                    success: function(data) {
                        var result = data[0];
                        if (result.username != '') {
                            $('#username').html(result.username);
                        } else {
                            $('#username').html('-');
                        }
                        if (result.name != '') {
                            $('#name').html(result.name);
                        } else {
                            $('#name').html('-');
                        }
                        if (result.email != '') {
                            $('#email').html(result.email);
                        } else {
                            $('#email').html('-');
                        }
                        if (result.phone != '') {
                            $('#phone').html(result.phone);
                        } else {
                            $('#phone').html('-');
                        }
                        if (result.id != '') {
                            $('#user_add').val(result.id);
                        } else {
                            $('#user_add').val('');
                        }
                    }
                });
            });
            $('#add_student').click(function(event) {
                var user_id = $('#user_id').val();
                var sync_id = <?php echo $subjectLearning->sync_id; ?>;
                if (user_id == '') {
                    swal({
                        title: "แจ้งเตือน",
                        text: "กรุณาเลือก ชื่อผู้ใช้บริการ",
                        icon: "warning",
                        button: "ตกลง",
                    });
                    return false;
                } else {
                    $.ajax({
                        type: 'POST',
                        url: base_url + '/check_student',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            user_id: user_id,
                            sync_id: sync_id
                        },
                        success: function(data) {
                            if (data != 0) {
                                swal({
                                    title: "แจ้งเตือน",
                                    text: "ได้มีผู้ใช้บริการนี้อยู่ในระบบหลักสูตรแล้ว",
                                    icon: "warning",
                                    button: "ตกลง",
                                });
                                return false;
                            } else {
                                $.ajax({
                                    url: base_url + '/checkstudent_synchtime',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                            .attr('content')
                                    },
                                    type: 'POST',
                                    data: {
                                        user_id: user_id,
                                        sync_id: sync_id
                                    },
                                    success: function(data) {
                                        if (data > 0) {
                                            swal({
                                                title: "แจ้งเตือน",
                                                text: "ไม่สามารถเพิ่มผู้ใช้บริการได้เนื่องจากเวลาทับซ้อนกัน",
                                                icon: "warning",
                                                button: "ตกลง",
                                            });
                                            return false;
                                        } else {
                                            $('#form_result').submit();
                                            return true;
                                        }
                                    }
                                })
                            }
                        }
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        function StudentDel(id) {
            swal({
                title: "เเจ้งเตือน",
                text: "คุณต้องการลบข้อมูลหรือไม่",
                icon: "warning",
                buttons: {
                    confirm: 'ตกลง',
                    cancel: 'ยกเลิก'
                },
                dangerMode: true,
            }).then(function() {
                $.ajax({
                    url: base_url + "/subject_calendar/manage_synchronous/delete_student/" + id,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var type = <?php echo $type; ?>;
                        var sync_id = <?php echo $subjectLearning->sync_id; ?>;
                        location.href = base_url +
                            "/subject_calendar/manage_synchronous/manage_class/" + type + "/" + sync_id;
                    },
                });
            });
        }
    </script>
@endsection
