@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>บทนำ</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">บทนำ</div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <div class="mb-3">
                            @foreach ($subject as $item)
                                <h5><b>วิชา: {{ $item->subjectName }}</b></h5>
                            @endforeach
                        </div>
                        <div>
                            @foreach ($introduction as $item)
                                <div class="text-center">
                                    <img src="{!! asset($item->image) !!}" width="60%" height="320px" alt="">
                                </div>
                                <p style="text-indent: 50px">{!! $item->title !!}</p>
                            @endforeach
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ url('/student_pretest/' . $id) }}" class="btn btn-primary">แบบทดสอบก่อนเรียน</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
