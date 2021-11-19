@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>จัดการเรียนการสอน</h1>
        </div>
        <div class="section-body">
          <form class="" id="form_result" action="{{ url('subject_calendar/manage_synchronous/update/'.$type,$lesson_synch->sync_id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>ตารางเรียนออนไลน์</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">ผู้สอน</label>
                            <select class="form-control" name="teacher_id" id="teacher_id">
                              <option value="">เลือก</option>
                              <?php foreach ($User as $key => $value): ?>
                               <option <?= ($lesson_synch->teacher_id == $value->id) ? 'selected' : ''; ?>  value="{{ $value->id}}">{{ $value->name}}</option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">ชื่อวิชา<i class="icon-arrow-left"></i></label>
                            <select class="form-control" name="subject_id" id="subject_id">
                              <option value="">เลือก</option>
                                <?php foreach ($subjectLearning as $key => $value): ?>
                                 <option <?php if ($lesson_synch->subject_id  == $value->id): ?> selected <?php endif; ?> value="{{ $value->id}}">{{ $value->subjectName}}</option>
                                <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" >
                            <label for="">วันที่เริ่ม<i class="icon-arrow-left"></i></label>
                            <?php
                           if (!empty($lesson_synch->start_date)) {
                             list($y,$m,$d) = explode('-',$lesson_synch->start_date);
                             $start_date = "{$d}/{$m}/".($y+543);
                           }
                           ?>
                            <input type="text" class="form-control datepicker date" data-provide="datepicker" data-date-language="th-th" id="start_date"  name="start_date" value="{{ $start_date }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" >
                            <label for="">วันที่สิ้นสุด</label>
                            <?php
                           if (!empty($lesson_synch->end_date)) {
                             list($y,$m,$d) = explode('-',$lesson_synch->end_date);
                             $end_date = "{$d}/{$m}/".($y+543);
                           }
                           ?>
                            <input type="text" class="form-control datepicker date" data-provide="datepicker" data-date-language="th-th" id="end_date" name="end_date" value="{{ $end_date }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" >
                            <label for="">เวลาที่เริ่ม</label>
                            <input type="text" class="form-control clockpicker" name="synch_starttime" id="synch_starttime" value="{{ date('H:i',strtotime($lesson_synch->synch_starttime)) }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" >
                            <label for="">เวลาที่สิ้นสุด</label>
                            <?php
                            $end = "$lesson_synch->end_date $lesson_synch->synch_endtime";
                             ?>
                            <input type="text" class="form-control clockpicker" name="synch_endtime" id="synch_endtime" value="{{  date('H:i',strtotime('+1 minutes',strtotime($end))) }}">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">จำนวนที่เปิดรับ</label>
                            <input type="text" class="form-control" name="synch_amount" id="synch_amount" value="{{ $lesson_synch->synch_amount }}">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">ลิงค์ Url</label>
                            <input type="text" class="form-control" name="synch_url" id="synch_url" value="{{ $lesson_synch->synch_url }}">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">รหัสผ่าน</label>
                            <input type="text" class="form-control" name="synch_password" id="synch_password" value="{{ $lesson_synch->synch_password }}">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">สถานะแบบทดสอบหลังสอบ</label>
                            <select class="form-control" name="synch_openpost" id="synch_openpost">
                              <option value="">เลือก</option>
                              <option <?= ($lesson_synch->synch_openpost == 1) ? 'selected' : ''; ?> value="1">ใช้งาน</option>
                              <option <?= ($lesson_synch->synch_openpost == 2) ? 'selected' : ''; ?> value="2">ไม่ใช้งาน</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">สถานะการใช้งาน</label>
                            <select class="form-control" name="synch_status" id="synch_status">
                              <option value="">เลือก</option>
                              <option <?= ($lesson_synch->synch_status == 1) ? 'selected' : ''; ?> value="1">ใช้งาน</option>
                              <option <?= ($lesson_synch->synch_status == 2) ? 'selected' : ''; ?> value="2">ไม่ใช้งาน</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="form-label">ทำซ้ำวัน</label>
                              <div class="selectgroup selectgroup-pills">
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[1]" <?= (!empty($repeat_day[1])) ? 'checked' : '' ?> value="1" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">จันทร์</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[2]" <?= (!empty($repeat_day[2])) ? 'checked' : '' ?> value="2" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">อังคาร</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[3]" <?= (!empty($repeat_day[3])) ? 'checked' : '' ?> value="3" class="selectgroup-input select_day">
                                    <span class="selectgroup-button">พุธ</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[4]" <?= (!empty($repeat_day[4])) ? 'checked' : '' ?> value="4" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">พฤหัสบดี</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[5]" <?= (!empty($repeat_day[5])) ? 'checked' : '' ?> value="5" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">ศุกร์</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[6]" <?= (!empty($repeat_day[6])) ? 'checked' : '' ?> value="6" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">เสาร์</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[7]" <?= (!empty($repeat_day[7])) ? 'checked' : '' ?> value="7" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">อาทิตย์</span>
                                </label>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div id='calendar'></div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">

                    <span class="btn btn-success" id="submit">บันทึก</span>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">ย้อนกลับ</a>
                </div>
            </div>
            </form>
            <input type="hidden" name="sync_id" id="sync_id" value="{{ $lesson_synch->sync_id }}">
        </div>
    </section>
@endsection
@section('scripts')
<script src="{{asset('js/modules/subject_calendar/manage_subject.js')}}"></script>
<script src="{{asset('js/modules/subject_calendar/create_synch.js')}}"></script>
@endsection
