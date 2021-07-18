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
          <form class="" action="{{ url('/subject_calendar/manage_lesson/store_lesson/'.$type)}}" method="post" enctype="multipart/form-data">
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
                        <label for="">ชื่อหลักสูตร<i class="icon-arrow-left"></i></label>
                        <select class="form-control" name="lesson_id" id="lesson_id">
                          <option value="">เลือก</option>
                          <?php foreach ($LessonContent as $key => $value): ?>
                            <option value="{{ $value->id }}">{{ $value->lessonName}}</option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">วันที่เริ่ม                    <i class="icon-arrow-left"></i></label>
                        <input type="text" class="form-control datepicker date" data-provide="datepicker" data-date-language="th-th" id="start_date"  name="start_date" value="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">วันที่สิ้นสุด</label>
                        <input type="text" class="form-control datepicker date" data-provide="datepicker" data-date-language="th-th" id="end_date" name="end_date" value="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">เวลาที่เริ่ม - เวลาที่สิ้นสุด</label>
                        <select class="form-control" name="synch_time" id="synch_time">
                          <option value="">เลือก</option>
                          <option value="08:00-09:00 น.">08:00-09:00 น.</option>
                          <option value="09:00-10:00 น.">09:00-10:00 น.</option>
                          <option value="10:00-11:00 น.">10:00-11:00 น.</option>
                          <option value="11:00-12:00 น.">11:00-12:00 น.</option>
                          <option value="12:00-13:00 น.">12:00-13:00 น.</option>
                          <option value="13:00-14:00 น.">13:00-14:00 น.</option>
                          <option value="14:00-15:00 น.">14:00-15:00 น.</option>
                          <option value="15:00-16:00 น.">15:00-16:00 น.</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">จำนวนที่เปิดรับ</label>
                        <input type="text" class="form-control" name="synch_amount" id="synch_amount" value="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">ผู้สอน</label>
                        <select class="form-control" name="teacher_id" id="teacher_id">
                          <option value="">เลือก</option>
                          <?php foreach ($User as $key => $value): ?>
                          <option value="{{$value->id}}">{{$value->name}}</option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">สถานะการใช้งาน</label>
                        <select class="form-control" name="synch_status" id="synch_status">
                          <option value="">เลือก</option>
                          <option value="1">ใช้งาน</option>
                          <option value="2">ไม่ใช้งาน</option>
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
