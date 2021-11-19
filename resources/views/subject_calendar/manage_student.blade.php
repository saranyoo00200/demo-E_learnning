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
                            <h4>ตาราง จัดการผู้เข้าเรียน การเรียนประสานเวลา (วิชา  {{ $subjectLearning[0]->subjectName }} หลักสูตร {{ $subjectLearning[0]->lessonName }} )</h4>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                             <label class="font-weight-bold">ชื่อหลักสูตร</label>
                             <p>{{ $subjectLearning[0]->lessonName }}</p>
                         </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                             <label class="font-weight-bold">วันที่เริ่ม</label>
                             <p>{{ formatDateThai( date($subjectLearning[0]->start_date)) }}</p>
                         </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                             <label class="font-weight-bold">วันที่สิ้นสุด</label>
                             <p>{{ formatDateThai( date($subjectLearning[0]->end_date)) }}</p>
                         </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                             <label class="font-weight-bold">เวลาที่เริ่ม - เวลาที่สิ้นสุด</label>
                             <p>{{ date('H:i',strtotime($subjectLearning[0]->synch_starttime))}} - {{ date('H:i',strtotime($subjectLearning[0]->synch_endtime))}} น.</p>
                         </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                             <label class="font-weight-bold">จำนวนที่เปิดรับ</label>
                             <p>{{ $subjectLearning[0]->synch_amount }}</p>
                         </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                             <label class="font-weight-bold">ผู้สอน</label>
                             <p>{{ $subjectLearning[0]->name }}</p>
                         </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                             <label class="font-weight-bold">สถานะ</label>
                               <?php if ($subjectLearning[0]->synch_status == 1): ?>
                                 <p class="text-success mb-0">ใช้งาน</p>
                               <?php else: ?>
                                 <p class="text-danger mb-0">ไม่ใช้งาน</p>
                               <?php endif; ?>
                         </div>
                      </div>
                    </div>
                </div>
                <form class="" action="{{ url('/subject_calendar/manage_lesson/update_class/'.$type.'/'.$subjectLearning[0]->sync_id)}}" method="post">
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
                                  </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="text-center">1</td>
                                  <td>User1234</td>
                                  <td>ทดสอบ ทดสอบ</td>
                                  <td>user1234@gmail.com</td>
                                  <td>083-0056983</td>
                                  <td>
                                    <div class="col-auto">
                                  <label class="colorinput">
                                    <input name="select_id[]"    type="checkbox" value="1"  class="colorinput-input">
                                    <input type="hidden" name="user_id[]" value="1">
                                    <span class="colorinput-color bg-primary"></span>
                                  </label>
                                </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-center">2</td>
                                  <td>User1234</td>
                                  <td>ทดสอบ ทดสอบ</td>
                                  <td>user1234@gmail.com</td>
                                  <td>083-0056983</td>
                                  <td>
                                    <div class="col-auto">
                                  <label class="colorinput">
                                    <input name="select_id[]"    type="checkbox" value="2"  class="colorinput-input">
                                    <input type="hidden" name="user_id[]" value="2">
                                    <span class="colorinput-color bg-primary"></span>
                                  </label>
                                </div>
                                  </td>
                                </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
                <div class="card-footer text-right">
                    <button class="btn btn-success" id="submit">บันทึก</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">ย้อนกลับ</a>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('scripts')

@endsection
