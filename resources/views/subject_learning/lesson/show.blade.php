@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>บทเรียน</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div>
                    <h6>{!! $lessonContent->title !!}</h6>
                </div>
            </div>
            <div class="card-body p-2 text-center">
                <img width="100%" height="300px" src="{{ asset($lessonContent->image) }}" alt="">
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div>
                    <h2>VIDEO!</h2>
                </div>
            </div>
            <div class="card-body p-2 text-center">
                <video width="100%" height="300px" controls>
                    <source src="{{ asset($lessonContent->vdo) }}" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="section-body">
        </div>
    </section>
@endsection
