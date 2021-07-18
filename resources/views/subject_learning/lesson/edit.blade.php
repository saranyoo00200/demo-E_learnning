@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>แก้ไขบทเรียน</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Event Manager</a></div>
                <div class="breadcrumb-item">Introduction</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card p-3">
                <div class="card-header">
                    <h4>แบบฟอร์มแนะนำ</h4>
                </div>
                <form action="{{ url('/lesson/content/update/' . $lessonContent->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md form-group">
                        <label for="editor">คำบรรยาย</label>
                        <textarea class="form-control" name="title" id="editor" rows="10">{!! $lessonContent->title !!}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md form-group">
                                <label>บทเรียนที่...</label>
                                <input type="text" name="lesson" value="{{ $lessonContent->lesson }}" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md form-group">
                                <label>ต้องการให้แสดงในคลาสหรือไม่</label>
                                <select class="form-control" name="show_lesson" required>
                                    <option class="active" value="">เลือก</option>
                                    <option value="1" {{ old('show_lesson', $lessonContent->show_lesson) == 1 ? 'selected' : '' }}>แสดง</option>
                                    <option value="2" {{ old('show_lesson', $lessonContent->show_lesson) == 2 ? 'selected' : '' }}>ไม่แสดง</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md form-group">
                        <label>ชื่อบทเรียน</label>
                        <input type="text" name="lessonName" value="{{ $lessonContent->lessonName }}" class="form-control"
                            required>
                    </div>
                    <div class="col-md form-group">
                        <label>รูปภาพ</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md form-group">
                        <label>วิดิโอ</label>
                        <input type="file" name="vdo" class="form-control">
                    </div>
                    {{-- <input type="hidden" name="old_video" value="{{ $lessonContent->vdo }}""> --}}
                    {{-- <input type="hidden" name="old_image" value="{{ $lessonContent->image }}""> --}}
                    <input type="hidden" name="subject_id" value="{{ $lessonContent->subject_id }}"">
                                    <div class=" card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
            </div>
            </form>
        </div>
        </div>
    </section>
@endsection
@section('cke-editor')
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
