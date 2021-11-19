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
                    <form action="{{ url('/subject_learning/update/' . $subjectLearning->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6 form-group">
                                <label>รหัสวิชา</label>
                                <input type="text" name="subjectId" class="form-control"
                                    value="{{ $subjectLearning->subjectId }}" maxlength="11" required>
                            </div>
                            <div class="col-6 form-group">
                                <label>ชื่อวิชา</label>
                                <input type="text" name="subjectName" class="form-control"
                                    value="{{ $subjectLearning->subjectName }}" required>
                            </div>
                            <div class="col-12 form-group">
                                <label>คำอธิบายแนะนำรายวิชา</label>
                                <textarea name="title" style="height: 150px;" class="form-control" required>{!! $subjectLearning->title !!}</textarea>
                            </div>
                            <div class="col-6 form-group">
                                <div class="row">
                                    <div class="col-md">
                                        <label>ปีการศึกษา</label>
                                        <select class="custom-select" name="schoolYear" required>
                                            <option selected>เลือก</option>
                                            @for ($year = 2564; $year <= 2580; $year++)
                                                <option value="{{ $year }}"
                                                    {{ old('type', $subjectLearning->schoolYear) == $year ? 'selected' : '' }}>
                                                    {{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md">
                                        <label>ไฟล์รูป</label>
                                        <input type="file" accept=".gif,.jpg,.jpeg,.png" name="image" class="form-control"
                                            value="{{ $subjectLearning->image }}">
                                        <input type="hidden" name="old_image" class="form-control"
                                            value="{{ $subjectLearning->image }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <div class="row">
                                    <div class="col-md">
                                        <label>หมวดหมู่</label>
                                        <select class="custom-select" name="subjectType" required>
                                            <option selected>เลือกหมวดหมู่วิชา</option>
                                            @foreach ($categories as $value)

                                                <option value="{{ $value->subjectType }}"
                                                    {{ old('type', $subjectLearning->subjectType) == $value->subjectType ? 'selected' : '' }}>
                                                    {{ $value->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md">
                                        <label>ต้องการแสดงหรือไม่</label>
                                        <select class="custom-select" name="show_subject" required>
                                            <option selected>เลือกแสดงข้อมูล</option>
                                            <option value="1"
                                                {{ old('type', $subjectLearning->show_subject) == 1 ? 'selected' : '' }}>
                                                แสดง</option>
                                            <option value="2"
                                                {{ old('type', $subjectLearning->show_subject) == 2 ? 'selected' : '' }}>
                                                ไม่แสดง</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary mr-1" type="submit">ยืนยัน</button>
                            <a class="btn btn-warning" onclick="goBack()">กลับ</a>
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
