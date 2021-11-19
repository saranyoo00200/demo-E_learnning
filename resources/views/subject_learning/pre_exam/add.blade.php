@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>วิชาที่เปิดสอน</h1>
        </div>

        <div class="section-body">

            <div class="card p-5">
                <form action="{{ url('/pretest/exam/add/' . $subject_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="editor">คำถาม</label>
                        <textarea class="form-control" id="editor" name="question" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div>
                                <label>ข้อที่ 1</label>
                            </div>
                            <div style=" display: flex; align-items: center;">
                                <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="1"
                                    required>
                                <textarea name="aq1" id="editorAq1" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div>
                                <label>ข้อที่ 2</label>
                            </div>
                            <div style=" display: flex; align-items: center;">
                                <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="2"
                                    required>
                                <textarea name="aq2" id="editorAq2" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div><label>ข้อที่ 3</label></div>
                            <div style=" display: flex; align-items: center;">
                                <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="3"
                                    required>
                                <textarea name="aq3" id="editorAq3" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div>
                                <label>ข้อที่ 4</label>
                            </div>
                            <div style=" display: flex; align-items: center;">
                                <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="4"
                                    required>
                                <textarea name="aq4" id="editorAq4" class="form-control" required></textarea>
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
    </section>
@endsection

@section('cke-editor')
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('editor');
        CKEDITOR.replace('editorAq1');
        CKEDITOR.replace('editorAq2');
        CKEDITOR.replace('editorAq3');
        CKEDITOR.replace('editorAq4');
    </script>
@endsection
@section('script')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
