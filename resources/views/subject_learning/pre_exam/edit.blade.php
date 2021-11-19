@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>วิชาที่เปิดสอน</h1>
    </div>

    <div class="section-body">

        <div class="card p-5">
            <form action="{{ url('/pretest/exam/update/' . $pretestExam->id) }}" method="POST" en>
                @csrf
                <div class="form-group">
                    <label for="editor">คำถาม</label>
                    <textarea class="form-control" name="question" id="editor" required>{!! $pretestExam->question !!}</textarea>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <div>
                            <label>ข้อที่ 1</label>
                        </div>
                        <div style=" display: flex; align-items: center;">
                            <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="1" {{ $pretestExam->answer == '1' ? 'checked' : '' }} required>
                            <textarea name="aq1" id="editorAq1" class="form-control" required>{!! $pretestExam->aq1 !!}</textarea>
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <div>
                            <label>ข้อที่ 2</label>
                        </div>
                        <div style=" display: flex; align-items: center;">
                            <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="2" {{ $pretestExam->answer == '2' ? 'checked' : '' }} required>
                            <textarea name="aq2" id="editorAq2" class="form-control" required>{!! $pretestExam->aq2 !!}</textarea>
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <div><label>ข้อที่ 3</label></div>
                        <div style=" display: flex; align-items: center;">
                            <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="3" {{ $pretestExam->answer == '3' ? 'checked' : '' }} required>
                            <textarea name="aq3" id="editorAq3" class="form-control" required>{!! $pretestExam->aq3 !!}</textarea>
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <div>
                            <label>ข้อที่ 4</label>
                        </div>
                        <div style=" display: flex; align-items: center;">
                            <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="4" {{ $pretestExam->answer == '4' ? 'checked' : '' }} required>
                            <textarea name="aq4" id="editorAq4" class="form-control" required>{!! $pretestExam->aq4 !!}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="subject_id" value="{{ $pretestExam->subject_id }}">
                </div>
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
