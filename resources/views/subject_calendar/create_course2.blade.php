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
                            <h4>ตาราง การเรียนประสานเวลาและไม่ประสานเวลา (วิชา ภาษาอังกฤษพื้นฐาน)</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">ชื่อหลักสูตร</label>
                        <select class="form-control" name="">
                          <option value="">เลือก</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">สถานะการใช้งาน</label>
                        <select class="form-control" name="">
                          <option value="">เลือก</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group" >
                        <label for="">ไฟล์เนื้อหา</label>
                         <input type="file" name="user_photo"  onchange="loadFile(event)" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-success" id="submit">บันทึก</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">ย้อนกลับ</a>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
 <script>
     CKEDITOR.replace( 'editor1' );
</script>
@endsection
