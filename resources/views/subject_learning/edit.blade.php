@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>หมวดวิชาเรียน</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Event Manager</a></div>
                <div class="breadcrumb-item">Introduction</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>แบบฟอร์มแก้ไขวิชาที่สอน</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('/subject_learning/update/' . $subjectLearning->id )}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6 form-group">
                                <label>รหัสวิชา</label>
                                <input type="text" name="subjectId" class="form-control" value="{{ $subjectLearning->subjectId }}" required>
                            </div>
                            <div class="col-6 form-group">
                                <label>ชื่อวิชา</label>
                                <input type="text" name="subjectName" class="form-control" value="{{ $subjectLearning->subjectName }}" required>
                            </div>
                            <div class="col-6 form-group">
                                <label>ปีการศึกษา</label>
                                <input type="text" name="schoolYear" class="form-control" value="{{ $subjectLearning->schoolYear }}" required>
                            </div>
                            <div class="col-6 form-group">
                                <label>หมวดหมู</label>
                                <select class="custom-select" name="subjectType" required>
                                    <option selected>เลือกหมวดหมูวิชา</option>
                                    <option value="1" {{ old('type', $subjectLearning->subjectType) == 1 ? 'selected' : '' }}>คอม</option>
                                    <option value="2" {{ old('type', $subjectLearning->subjectType) == 2 ? 'selected' : '' }}>ไทย</option>
                                    <option value="3" {{ old('type', $subjectLearning->subjectType) == 3 ? 'selected' : '' }}>อังกฤษ</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary mr-1" type="submit">Submit</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
