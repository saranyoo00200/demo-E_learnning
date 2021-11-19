@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">สวัสดี, {{ Auth::user()->name }}!</h2>
            <p class="section-lead">
                นี้คือข้อมูลของชื่อผู้ใช้ <u>{{ $user->name }}</u> ในหน้านี้.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{ asset('assets/backend/img/user_profile/' . $user->user_photo) }}"
                                class="rounded-circle profile-widget-picture">
                            {{-- @if ($user->user_type == 2)
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">ประสานเวลา</div>
                                        <div class="profile-widget-item-value">4</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">ไม่ประสานเวลา</div>
                                        <div class="profile-widget-item-value">6</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">ใบประกาศนียบัตร</div>
                                        <div class="profile-widget-item-value">6</div>
                                    </div>
                                </div>
                            @endif --}}
                        </div>
                        <hr>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{ $user->name }} <div
                                    class="text-muted d-inline font-weight-normal">
                                    @if ($user->user_type == 2)
                                        <div class="slash"></div> นักเรียน
                                    @elseif ($user->user_type == 3)
                                        <div class="slash"></div> อาจารย์

                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold"><b>Username</b></label>
                                            <p>{{ $user->username }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">ชื่อ-นามสกุล</label>
                                            <p>{{ $user->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">อีเมล</label>
                                            <p>{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">เบอร์โทรศัพท์</label>
                                            <p>{{ $user->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">สถานะ</label>
                                            <?php if ($user->user_status == 1): ?>
                                            <p class="text-success">ใช้งาน</p>
                                            <?php else: ?>
                                            <p class="text-danger">ไม่ใช้งาน</p>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold">ประเภทผู้ใช้</label>
                                            <p>
                                                <?php if ($user->user_type == 2): ?>
                                                นักเรียน
                                                <?php elseif($user->user_type == 3): ?>
                                                อาจารย์
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-warning float-right" onclick="goBack()">กลับ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // back
        function goBack() {
            window.history.back();
        }
        // end back
    </script>
@endsection
