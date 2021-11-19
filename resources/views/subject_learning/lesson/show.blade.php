@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>บทเรียน</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <div>
                <h6>{!! $lessonContent->title !!}</h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-2 text-center">
                    <img width="100%" height="305px" src="{{ asset($lessonContent->image) }}" alt="">
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-body p-2 text-center">
                    <video width="100%" height="300px" controls>
                        <source src="{{ asset($lessonContent->vdo) }}" type="video/mp4">
                    </video>
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
