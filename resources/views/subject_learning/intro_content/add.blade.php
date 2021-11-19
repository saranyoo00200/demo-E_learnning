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
            <form action="{{ url('/introduction/content/add/'. $subject_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="editor">บทนำ</label>
                        <textarea id="title" name="title" class="form-control" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ต้องการให้แสดงในคลาสหรือไม่</label>
                                <select class="form-control" name="show_intro" required>
                                    <option class="active" value="">เลือก</option>
                                    <option value="1">แสดง</option>
                                    <option value="2">ไม่แสดง</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <input type="file" accept=".gif,.jpg,.jpeg,.png" name="image" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">ยืนยัน</button>
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
