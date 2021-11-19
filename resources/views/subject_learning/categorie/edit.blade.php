@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>บทนำ</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>หมวดหมู่วิชา</h4>
                </div>
                <form action="{{ url('/categorie/update/' . $SubjectCategory->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="editor">บทนำ</label>
                            <input type="text" name="category_name" class="form-control"
                                value="{{ $SubjectCategory->category_name }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ต้องการให้แสดงในคลาสหรือไม่</label>
                                    <select class="form-control" name="category_status" required>
                                        <option class="active" value="">เลือก</option>
                                        <option value="1"
                                            {{ old('category_status', $SubjectCategory->category_status) == 1 ? 'selected' : '' }}>
                                            แสดง</option>
                                        <option value="2"
                                            {{ old('category_status', $SubjectCategory->category_status) == 2 ? 'selected' : '' }}>
                                            ไม่แสดง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label>รูปภาพ</label>
                                    <input type="file" accept=".gif,.jpg,.jpeg,.png" name="image" class="form-control"
                                        value="{{ $SubjectCategory->image }}">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="old_image" value="{{ $SubjectCategory->image }}">
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
