@extends('layouts.app')
@section('content')
    <section class="section" data-id="{{ @$user->id }}">
        <div class="section-header">
            <h1>จัดการผู้ใช้งาน(User Manager)</h1>
        </div>
        <div class="section-body">
            <!-- <div class="row"> -->
            <!-- <div class="col-12"> -->
            <form class="" action="{{ url('/update_access/' . $user_id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header" style="display:block;">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>การเข้าถึงสิทธิ์</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tr>
                                        <th class="text-center"><i class="fas fa-th"></i></th>
                                        <th>ปี พ.ศ.</th>
                                        <th>รหัสวิชา</th>
                                        <th>ชื่อวิชา</th>
                                        <th>หมวดหมู่</th>
                                    </tr>
                                    <?php $i=1; foreach ($subjectLearning as $key => $value): ?>
                                    <tr>
                                        <td class="text-center" width="5%">
                                            <div class="col-auto">
                                                <label class="colorinput">
                                                    <input name="select_id[<?= $key ?>]" <?php if (!empty($data_group[$value->id])) {
    echo 'checked';
} ?> type="checkbox"
                                                        value="{{ $value->id }}" class="colorinput-input">
                                                    <span class="colorinput-color bg-primary"></span>
                                                    <input type="hidden" name="subject_id[<?= $key ?>]"
                                                        value="{{ $value->id }}">
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{ $value->schoolYear }}</td>
                                        <td>{{ $value->subjectId }}</td>
                                        <td>{{ $value->subjectName }}</td>
                                        <td>
                                            <div class="badge badge-primary">{{ $value->category_name }}</div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success" id="submit">บันทึก</button>
                        <a class="btn btn-danger text-white" onclick="goBack()">ย้อนกลับ</a>
                    </div>
                </div>
            </form>
            <!-- </div> -->
            <!-- </div> -->
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
