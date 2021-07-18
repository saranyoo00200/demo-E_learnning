@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>เพิ่มข้อสอบ</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Event Manager</a></div>
                <div class="breadcrumb-item">Introduction</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card p-5">
                <div class="card-header">
                    <h4>แบบฟอร์มแนะนำ</h4>
                </div>
                <form action="{{ url('/pretest/exam/add/' . $subject_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="editor">คำถาม</label>
                        <textarea class="form-control" id="editor" name="question"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <div>
                                <label>ข้อที่ 1</label>
                            </div>
                            <div>
                                <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="1"
                                    required>
                                <input type="text" name="aq1" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <div>
                                <label>ข้อที่ 2</label>
                            </div>
                            <div style=" display: flex; align-items: center;">
                                <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="2"
                                    required>
                                <input type="text" name="aq2" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <div><label>ข้อที่ 3</label></div>
                            <div style=" display: flex; align-items: center;">
                                <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="3"
                                    required>
                                <input type="text" name="aq3" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <div>
                                <label>ข้อที่ 4</label>
                            </div>
                            <div style=" display: flex; align-items: center;">
                                <input class="form-check-input" name="answer" type="radio" id="defaultCheck" value="4"
                                    required>
                                <input type="text" name="aq4" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary mr-1" type="submit">Submit</button>
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