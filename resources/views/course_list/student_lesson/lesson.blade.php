@extends('layouts.app')
@section('css-step')

@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>ทดสอบก่อนเรียน</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body p-0 mt-4">
                    <div>
                        @php
                            $s = 1;
                        @endphp
                        <div id="pagination">
                            <ul>
                                @foreach ($lessonContent as $item)
                                    <h6>บทเเรียนที่: {{ $item->lesson }}</h6>
                                @endforeach
                            </ul>
                            <div class="mt-4 p-3">
                                @foreach ($lessonContent as $item)
                                    <div id="step-{{ $item->id }}">
                                        <div class="card">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="col-md">
                                                            <div class="row">
                                                                <div class="col-md">
                                                                    <video width="100%" height="auto" controls>
                                                                        <source src="{{ asset($item->vdo) }}"
                                                                            type="video/mp4">
                                                                    </video>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="col-md">
                                                            <div class="col-md text-center">
                                                                <img width="70%" height="215px"
                                                                    src="{{ asset($item->image) }}" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p>{!! $item->title !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                @if ($lessonContent->hasMorePages())
                    <div class="mt-3 ml-2 d-flex justify-content-center">
                        {{ $lessonContent->links('pagination::simple-bootstrap-4') }}
                    </div>
                @else
                    <div class="d-flex justify-content-end ml-2 mt-3 mr-2">
                        <div style="margin-right: 27%">
                            {{ $lessonContent->links('pagination::simple-bootstrap-4') }}
                        </div>
                        <div>
                            @if ($quizSkrip == 1)
                                <a href="{{ url('/course_list') }}" class="page-link"
                                    style="border-radius:  4px">กลับสู่บทเรียน</a>
                            @else
                                <a href="{{ url('/student_posttest/' . $subject_id) }}" class="page-link"
                                    style="border-radius:  4px">ทดสอบหลังเรียน</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
