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
          <form class="" action="{{ url('/subject_calendar/manage_lesson/update_lesson/1/'.$type)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>ตาราง การเรียนประสานเวลา (วิชา {{$subjectLearning['subjectName']}})</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">ชื่อหลักสูตร</label>
                        <select class="form-control" name="lesson_id" id="lesson_id">
                          <option value="">เลือก</option>
                          <?php foreach ($LessonContent as $key => $value): ?>
                            <option <?= ($LessonSynch[0]->lesson_id == $value->id) ? 'selected="selected"' : ''; ?>  value="{{ $value->id }}">{{ $value->lessonName}}</option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">วันที่เริ่ม</label>
                        <?php if (!empty($LessonSynch[0]->start_date)): ?>
                          <?php
                          if (!empty($LessonSynch[0]->start_date)) {
                            list($y,$m,$d) = explode('-',$LessonSynch[0]->start_date);
                            $start_date = "{$d}/{$m}/".($y+543);
                          }
                          ?>
                        <?php endif; ?>
                        <input type="text"  class="form-control datepicker date" id="start_date" data-provide="datepicker" data-date-language="th-th"  name="start_date" value="<?php echo @$start_date; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">วันที่สิ้นสุด</label>
                        <?php if (!empty($LessonSynch[0]->end_date)): ?>
                          <?php
                          if (!empty($LessonSynch[0]->end_date)) {
                            list($y,$m,$d) = explode('-',$LessonSynch[0]->end_date);
                            $end_date = "{$d}/{$m}/".($y+543);
                          }
                          ?>
                        <?php endif; ?>
                        <input type="text" class="form-control datepicker date" id="end_date" data-provide="datepicker" data-date-language="th-th" name="end_date" value="<?php echo @$end_date; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">เวลาที่เริ่ม - เวลาที่สิ้นสุด</label>
                        <select class="form-control" name="synch_time" id="synch_time">
                          <option value="">เลือก</option>
                          <option value="08:00-09:00 น." {{ ($LessonSynch[0]->synch_time == '08:00-09:00 น.') ?  'selected' : '' }} >08:00-09:00 น.</option>
                          <option value="09:00-10:00 น." {{ ($LessonSynch[0]->synch_time == '09:00-10:00 น.') ?  'selected' : '' }} >09:00-10:00 น.</option>
                          <option value="10:00-11:00 น." {{ ($LessonSynch[0]->synch_time == '10:00-11:00 น.') ?  'selected' : '' }} >10:00-11:00 น.</option>
                          <option value="11:00-12:00 น." {{ ($LessonSynch[0]->synch_time == '11:00-12:00 น.') ?  'selected' : '' }} >11:00-12:00 น.</option>
                          <option value="12:00-13:00 น." {{ ($LessonSynch[0]->synch_time == '12:00-13:00 น.') ?  'selected' : '' }} >12:00-13:00 น.</option>
                          <option value="13:00-14:00 น." {{ ($LessonSynch[0]->synch_time == '13:00-14:00 น.') ?  'selected' : '' }} >13:00-14:00 น.</option>
                          <option value="14:00-15:00 น." {{ ($LessonSynch[0]->synch_time == '14:00-15:00 น.') ?  'selected' : '' }} >14:00-15:00 น.</option>
                          <option value="15:00-16:00 น." {{ ($LessonSynch[0]->synch_time == '15:00-16:00 น.') ?  'selected' : '' }} >15:00-16:00 น.</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">จำนวนที่เปิดรับ</label>
                        <input type="text" class="form-control" id="synch_amount" name="synch_amount" value="{{ $LessonSynch[0]->synch_amount }}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">ผู้สอน</label>
                        <select class="form-control" name="teacher_id" id="teacher_id">
                          <option value="">เลือก</option>
                          <?php foreach ($User as $key => $value): ?>
                          <option <?= ($LessonSynch[0]->teacher_id == $value->id) ? 'selected' : ''; ?>  value="{{$value->id}}">{{$value->name}}</option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">สถานะการใช้งาน</label>
                        <select class="form-control" name="synch_status" id="synch_status">
                          <option value="">เลือก</option>
                          <option <?= ($LessonSynch[0]->synch_status == 1) ? 'selected' : ''; ?> value="1">ใช้งาน</option>
                          <option <?= ($LessonSynch[0]->synch_status == 2) ? 'selected' : ''; ?> value="2">ไม่ใช้งาน</option>
                        </select>
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
        </div>
    </section>
@endsection
@section('scripts')
 <script src="{{asset('assets/backend/js/modules/subject_calendar/manange_lesson.js')}}"></script>
@endsection
