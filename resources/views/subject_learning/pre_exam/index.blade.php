@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>ทดสอบก่อนเรียน</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">ทดสอบก่อนเรียน</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header" style="display: block;">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>ทดสอบก่อนเรียน</h4>
                        </div>
                        <div class="col-md-6" align="right">
                            <div>
                                <a href="{{ url('/pretest/exam/addIndex/' . $subject_id) }}"
                                    class="btn btn-success">เพิ่ม</a>
                            </div>
                        </div>
                    </div>
                </div>
                @php($i = 1)
                    <div class="card-body p-2">
                        <div class="row">
                            @foreach ($result as $item)
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <h4>ข้อที่: {{ $i++ }}</h4>
                                            <div class="card-header-action">
                                                <div class="dropdown">
                                                    <a href="#" data-toggle="dropdown"
                                                        class="btn btn-warning dropdown-toggle">เครื่องมือ</a>
                                                    <div class="dropdown-menu">
                                                        {{-- <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i>
                                                    View</a> --}}
                                                        <a href="{{ url('/pretest/exam/edit/' . $item->id) }}"
                                                            class="dropdown-item has-icon"><i class="far fa-edit"></i>
                                                            Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="{{ url('/pretest/exam/delete/' . $item->id) }}"
                                                            class="dropdown-item has-icon text-danger"><i
                                                                class="far fa-trash-alt"></i> Delete</a>
                                                    </div>
                                                    <a data-collapse="#mycard-collapse{{ $item->id }}"
                                                        class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse " id="mycard-collapse{{ $item->id }}">
                                            <div class="card-body">
                                                <h4>{!! $item->question !!}</h4>
                                                <p>คำตอบ 1: {{ $item->aq1 }}</p>
                                                <p>คำตอบ 2: {{ $item->aq2 }}</p>
                                                <p>คำตอบ 3: {{ $item->aq3 }}</p>
                                                <p>คำตอบ 4: {{ $item->aq4 }}</p>
                                                <p class="text-danger">เฉลยคำตอบข้อที่ถูกคือ: {{ $item->answer }}</p>
                                            </div>
                                            {{-- <div class="card-footer"></div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
