@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>จัดการเรียนการสอน</h1>
        </div>

        <div class="section-body">
          <form class="" id="form_result" action="{{ url('subject_calendar/manage_synchronous/store',$type)}}" method="post" enctype="multipart/form-data">
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
                               <option value="{{ $value->id}}">{{ $value->name}}</option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">ชื่อวิชา<i class="icon-arrow-left"></i></label>
                            <select class="form-control" name="subject_id" id="subject_id">
                              <option value="">เลือก</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" >
                            <label for="">วันที่เริ่ม<i class="icon-arrow-left"></i></label>
                            <input type="text" class="form-control datepicker date" data-provide="datepicker" data-date-language="th-th" id="start_date"  name="start_date" value="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" >
                            <label for="">วันที่สิ้นสุด</label>
                            <input type="text" class="form-control datepicker date" data-provide="datepicker" data-date-language="th-th" id="end_date" name="end_date" value="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" >
                            <label for="">เวลาที่เริ่ม</label>
                            <input type="text" class="form-control clockpicker" name="synch_starttime" id="synch_starttime" value="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" >
                            <label for="">เวลาที่สิ้นสุด</label>
                            <input type="text" class="form-control clockpicker" name="synch_endtime" id="synch_endtime" value="">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">จำนวนที่เปิดรับ</label>
                            <input type="text" class="form-control" name="synch_amount" id="synch_amount" value="">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">ลิงค์ Url</label>
                            <input type="text" class="form-control" name="synch_url" id="synch_url" value="">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">รหัสผ่าน</label>
                            <input type="text" class="form-control" name="synch_password" id="synch_password" value="">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">สถานะแบบทดสอบหลังสอบ</label>
                            <select class="form-control" name="synch_openpost" id="synch_openpost">
                              <option value="">เลือก</option>
                              <option value="1">ใช้งาน</option>
                              <option value="2">ไม่ใช้งาน</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <label for="">สถานะการใช้งาน</label>
                            <select class="form-control" name="synch_status" id="synch_status">
                              <option value="">เลือก</option>
                              <option value="1">ใช้งาน</option>
                              <option value="2">ไม่ใช้งาน</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="form-label">ทำซ้ำวัน</label>
                              <div class="selectgroup selectgroup-pills">
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[1]" value="1" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">จันทร์</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[2]" value="2" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">อังคาร</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[3]" value="3" class="selectgroup-input select_day">
                                    <span class="selectgroup-button">พุธ</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[4]" value="4" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">พฤหัสบดี</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[5]" value="5" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">ศุกร์</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[6]" value="6" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">เสาร์</span>
                                </label>
                                <label class="selectgroup-item">
                                  <input type="checkbox" name="synch_repeatday[7]" value="7" class="selectgroup-input select_day">
                                  <span class="selectgroup-button">อาทิตย์</span>
                                </label>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div id='calendar' style="height:100%"></div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                    <span class="btn btn-success" id="submit">บันทึก</span>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">ย้อนกลับ</a>
                </div>
            </div>
            </form>
            <input type="hidden" name="sync_id" id="sync_id" value="">
        </div>
    </section>
@endsection
@section('scripts')
<script src="{{asset('js/modules/subject_calendar/manage_subject.js')}}"></script>
<script src="{{asset('js/modules/subject_calendar/create_synch.js')}}"></script>
@endsection
