@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>วิชาที่เปิดสอน</h1>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>บทเรียน</h4>
            </div>
            <div class="card-body">
                <div>

                    @if ($introductionContent->show_intro == 1)
                        <strong>สถานะ: <span class="text-success">แสดง</span></strong>
                    @else
                        <strong>สถานะ: <span class="text-danger">ไม่แสดง</span></strong>
                    @endif

                    <p>{!! $introductionContent->title !!}</p>
                    <div class="p-2 text-start">
                        <img width="auto" height="305px" src="{{ asset($introductionContent->image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-warning" onclick="Back()">กลับ</button>
    </section>
@endsection

@section('script')
    <script>
        function Back() {
            window.history.back();
        }
    </script>
@endsection
