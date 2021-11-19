@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>วิชาที่เปิดสอน</h1>
        </div>

        <div class="section-body">

            <div class="card p-3">
                <div class="card-header">
                    <h4>บทเรียน</h4>
                </div>
                <form action="{{ url('/lesson/content/update/' . $lessonContent->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md form-group">
                        <label for="editor">คำบรรยาย</label>
                        <textarea class="form-control" name="title" id="title" required>{!! $lessonContent->title !!}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md form-group">
                                <label>บทเรียนที่...</label>
                                <input type="text" name="lesson" value="{{ $lessonContent->lesson }}"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md form-group">
                                <label>ต้องการให้แสดงในคลาสหรือไม่</label>
                                <select class="form-control" name="show_lesson" required>
                                    <option class="active" value="">เลือก</option>
                                    <option value="1"
                                        {{ old('show_lesson', $lessonContent->show_lesson) == 1 ? 'selected' : '' }}>แสดง
                                    </option>
                                    <option value="2"
                                        {{ old('show_lesson', $lessonContent->show_lesson) == 2 ? 'selected' : '' }}>
                                        ไม่แสดง</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md form-group">
                        <label>ชื่อบทเรียน</label>
                        <input type="text" name="lessonName" value="{{ $lessonContent->lessonName }}"
                            class="form-control" required>
                    </div>
                    <div class="col-md form-group">
                        <label>รูปภาพ</label>
                        <input type="file" accept=".gif,.jpg,.jpeg,.png" name="image" class="form-control">
                    </div>
                    <div class="col-md form-group">
                        <label>วิดิโอ</label>
                        <input type="file" accept="video/mp4,video/x-m4v,video/*"
                            name="vdo" class="form-control">
                    </div>
                    <!-- <input type="hidden" name="old_video" value="{{ $lessonContent->vdo }}"">
                                    <input type="hidden" name="old_image" value="{{ $lessonContent->image }}"">  -->
                    <input type="hidden" name="subject_id" value="{{ $lessonContent->subject_id }}"">
                                                        <div class="      card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">ยืนยัน</button>
                    <a class="btn btn-warning" onclick="goBack()">กลับ</a>
            </div>
            </form>
        </div>
        </div>
    </section>
@endsection
@section('cke-editor')
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('title');
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
