@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>เพิ่มหมวดหมู่</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4>หมวดหมู่วิชา</h4>
                </div>
                <form action="{{ url('/categorie/create')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="editor">ชื่อหมวดหมู่</label>
                            <input name="category_name" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ต้องการให้แสดงในคลาสหรือไม่</label>
                                    <select class="form-control" name="category_status" required>
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
@section('script')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
