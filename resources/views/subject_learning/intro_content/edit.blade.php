@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>วิชาที่เปิดสอน</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>บทนำ</h4>
                </div>
                <form action="{{ url('/introduction/content/update/' . $introductionContent->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="editor">บทนำ</label>
                            <textarea id="title" name="title" class="form-control"
                                required>{!! $introductionContent->title !!}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ต้องการให้แสดงในคลาสหรือไม่</label>
                                    <select class="form-control" name="show_intro" required>
                                        <option class="active" value="">เลือก</option>
                                        <option value="1"
                                            {{ old('show_intro', $introductionContent->show_intro) == 1 ? 'selected' : '' }}>
                                            แสดง</option>
                                        <option value="2"
                                            {{ old('show_intro', $introductionContent->show_intro) == 2 ? 'selected' : '' }}>
                                            ไม่แสดง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label>รูปภาพ</label>
                                    <input type="file" accept=".gif,.jpg,.jpeg,.png" name="image" class="form-control"
                                        value="{{ $introductionContent->image }}">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="old_image" value="{{ $introductionContent->image }}">
                        <input type="hidden" name="introduction_id" value="{{ $introductionContent->introduction_id }}">
                    </div>
                    <!-- <div class="form-group mb-3">
                            <img src="{{ asset($introductionContent->image) }}" width="200px" alt="">
                        </div> -->
                    <div class="card-footer text-right">
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
@endsection
@section('script')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
