@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>เพิ่มบทนำ</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Event Manager</a></div>
                <div class="breadcrumb-item">Introduction</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>แบบฟอร์มเพิ่มบทนำ</h4>
                </div>
                <form action="{{ url('/introduction/content/add/'. $subject_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="editor">บทนำ</label>
                            <textarea type="text" id="editor" name="title" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>รูปภาพ</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="card-footer text-right">
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