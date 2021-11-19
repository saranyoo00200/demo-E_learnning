@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>วิชาที่เปิดสอน</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>วิชาเรียน</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('addSubject_learning') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>รหัสวิชา</label>
                                <input type="text" name="subjectId" class="form-control" maxlength="11" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ชื่อวิชา</label>
                                <input type="text" name="subjectName" class="form-control" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>คำอธิบายแนะนำรายวิชา</label>
                                <textarea name="title" style="height: 150px;" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="row">
                                    <div class="col-md">
                                        <label>ปีการศึกษา</label>
                                        <select class="custom-select" name="schoolYear" required>
                                            <option selected>เลือก</option>
                                            @for ($year = 2564; $year <= 2580; $year++)
                                                <option value="{{ $year }}">
                                                    {{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md">
                                        <label>ไฟล์รูป</label>
                                        <input type="file" accept=".gif,.jpg,.jpeg,.png" name="image" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="row">
                                    <div class="col-md">
                                        <label>หมวดหมู่</label>
                                        <select class="custom-select" name="subjectType" required>
                                            <option selected>เลือกหมวดหมู่วิชา</option>
                                            @foreach ($categories as $value)
                                                <option value="{{ $value->subjectType }}">
                                                    {{ $value->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md">
                                        <label>ต้องการแสดงหรือไม่</label>
                                        <select class="custom-select" name="show_subject" required>
                                            <option selected>เลือกแสดงข้อมูล</option>
                                            <option value="1">แสดง</option>
                                            <option value="2">ไม่แสดง</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary mr-1" type="submit">ยืนยัน</button>
                            <button class="btn btn-warning" onclick="goBack()">กลับ</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
