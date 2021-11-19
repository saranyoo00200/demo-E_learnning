@extends('layouts.app')

@section('content')
    <section class="section" data-id="{{ @$user->id }}">
        <div class="section-header">
            <h1>จัดการโปรไฟล์(User Profile)</h1>
        </div>
        <div class="section-body">
            <form action=" {{ route('edit_profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-header" style="display:block;">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>เเก้ข้อมูลโปรไฟล์</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ชื่อ-นามสกุล</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" id="username"
                                                value="{{ $user->username }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>อีเมล</label>
                                            <input type="text" class="form-control" name="email" id="email"
                                                value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" name="phone" id="phone"
                                                value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                value="" placeholder="********">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" name="" id="confirm_password"
                                                placeholder="********">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12" align="center" style="margin-top: -10px;">
                                        <?php if ($user->user_photo != ''): ?>
                                        <img id="output"
                                            src="{{ asset('assets/backend/img/user_profile/' . $user->user_photo) }}"
                                            class="img-profile rounded-circle" alt="" width="250px;" height="250px;">
                                        <?php else: ?>
                                        <img id="output" src="{{ asset('assets/backend/img/avatar/avatar-1.png') }}"
                                            class="img-profile rounded-circle" alt="" width="250px;" height="250px;">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <div class="form-group">
                                            <label>ไฟล์ภาพ</label>
                                            <input type="file" name="user_photo" onchange="loadFile(event)"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary mr-1" type="submit">ยืนยัน</button>
                        <a class="btn btn-warning" onclick="goBack()">กลับ</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
        // back
        function goBack() {
            window.history.back();
        }
        // end back
    </script>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/js/modules/UserManage/User.js') }}"></script>
@endsection
