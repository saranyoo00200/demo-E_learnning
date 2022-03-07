@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>การติดต่อ</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>ข้อมูลการติดต่อ</h4>
                </div>
                @foreach ($tickets as $item)
                    <div class="card-body">
                        <div class="tickets">
                            <div class="ticket-content">
                                <div class="ticket-header">
                                    <div class="ticket-detail">
                                        <div class="ticket-title">
                                            <h4>{{ $item->name }}</h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div class="font-weight-600">{{ $item->email }}</div>
                                            <div class="bullet"></div>
                                            <div class="text-primary font-weight-600">
                                                {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ticket-description">
                                    <p>{{ $item->message }}</p>
                                    <div class="ticket-divider"></div>

                                    <div class="ticket-form">
                                        <form action="{{ url('/dashboard/' . $item->tickets_id . '/update_tickets') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group col-3">
                                                <label>ถ้าจัดการข้อมูลเสร็จ?</label>
                                                <select class="custom-select" name="check_status" required>
                                                    <option value="1"
                                                        {{ old('check_status', $item->check_status) == 1 ? 'selected' : '' }}>
                                                        เสร็จ</option>
                                                    <option value="2"
                                                        {{ old('check_status', $item->check_status) == 2 ? 'selected' : '' }}>
                                                        ไม่เสร็จ</option>
                                                </select>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-primary btn-lg">
                                                    ยืนยัน
                                                </button>
                                                <a class="btn btn-warning btn-lg" onclick="goBack()">
                                                    กลับ
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
